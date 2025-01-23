<?php

namespace App\DataTables;

use App\Models\HolderSubmission;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class HolderSubmissionsDataTable extends DataTable
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('students', 'issuer', 'receiver')->select('holder_submissions.*'))
            ->addIndexColumn()
            ->editColumn('holder_submissions.created_at', function($holderSubmission) {
                return $holderSubmission->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('students.name', function($holderSubmission) {
                return $holderSubmission->students->name ?? "";
            })
            ->editColumn('submission_ref', function($holderSubmission) {
                return $holderSubmission->submission_ref ?? "";
            })
            ->editColumn('school_name', function($holderSubmission) {
                return $holderSubmission->school_name ?? "";
            })
            ->editColumn('issuer.name', function($holderSubmission) {
                return $holderSubmission->issuer->name ?? "";
            })
            ->editColumn('receiver.name', function($holderSubmission) {
                return $holderSubmission->receiver->name ?? "";
            })
            ->editColumn('status', function($holderSubmission) {
                $checkedStatus = ($holderSubmission->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($holderSubmission->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status holder_submission_status_cb toggle_switch_chk" id="normal'.$holderSubmission->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$holderSubmission->id.'">
                    <label class="toggle-item" for="normal'.$holderSubmission->id.'"></label>
                  </div>
                </div>';
            })            
            ->editColumn('current_stage', function($holderSubmission) {
                return $holderSubmission->current_stage ? config('constant.holderSubmissionStages.titles.'.$holderSubmission->current_stage) : "";
            })            
            ->editColumn('next_stage', function($holderSubmission) {
                return $holderSubmission->next_stage ? config('constant.holderSubmissionStages.titles.'.$holderSubmission->next_stage) : "";
            })
            ->addColumn('action', function($holderSubmission) {
                $action  = '';
                if (Gate::check('holder_submission_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.holder-submissions.show', $holderSubmission->id).'"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::check('holder_submission_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.holder-submissions.edit", $holderSubmission->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('holder_submission_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.holder-submissions.destroy', $holderSubmission->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                if (Gate::check('holder_submission_access')) {
                    // $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.holderSubmissions.generatePDF').'"><i class="fa-solid fa-file-pdf"></i></a>';
                }
                return $action;
            })
            ->filterColumn('holder_submissions.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(holder_submissions.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            ->filterColumn('next_stage', function($query, $keyword) {
                $sql = $this->stagesNameQuery('next_stage');
                $query->whereRaw($sql. " like ?", ["%{$keyword}%"]);
            })
            ->filterColumn('current_stage', function($query, $keyword) {
                $sql = $this->stagesNameQuery('current_stage');
                $query->whereRaw($sql. " like ?", ["%{$keyword}%"]);
            })
            
            ->rawColumns(['action', 'status']);
    }

    public function stagesNameQuery($columnName){
        $stages = config('constant.holderSubmissionStages.titles');

        $stagesQuery = 'CASE';
        if(!empty($stages)){
            foreach ($stages as $key => $value) {
                $stagesQuery .= " WHEN ".$columnName."='".$key."' THEN '".$value."'";
            }
            $stagesQuery .= "ELSE '' ";    
        }
        $stagesQuery .= 'END';
        return $stagesQuery;
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HolderSubmission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HolderSubmission $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('holder-submissions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(9,'desc')
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'stateSave'   => true,
                        'buttons'     => ['pageLength'],
                        'lengthMenu'  => config('datatables-buttons.parameters.lengthMenu'),
                        'responsive'  => true,
                        'autoWidth'   => false,
                        'width'       => '100%',
                        'language'    => [
                            'emptyTable' => trans('global.no_entries_in_table'),
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('#')->orderable(false)->searchable(false),
            Column::make('students.name')->title(trans('cruds.holder_submissions.fields.student_id')),
            Column::make('submission_ref')->title(trans('cruds.holder_submissions.fields.submission_ref')),
            Column::make('school_name')->title(trans('cruds.holder_submissions.fields.school_name')),
            Column::make('issuer.name')->title(trans('cruds.holder_submissions.fields.issuer_id')),
            Column::make('receiver.name')->title(trans('cruds.holder_submissions.fields.receiver_id')),
            Column::make('status')->title(trans('cruds.holder_submissions.fields.status')),
            Column::make('current_stage')->title(trans('cruds.holder_submissions.fields.current_stage')),
            Column::make('next_stage')->title(trans('cruds.holder_submissions.fields.next_stage')),
            Column::make('holder_submissions.created_at')->title(trans('cruds.holder_submissions.fields.created_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width('130')
                  ->addClass('datatable_action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'holderSubmissions' . date('YmdHis');
    }

    /**
     * Get status type.
     *
     * @return string
     */
    protected function getStatus($type)
    {
        return ($type !='')? $this->status[$type] : '';
    }
}
