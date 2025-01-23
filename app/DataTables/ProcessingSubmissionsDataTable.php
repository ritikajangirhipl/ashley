<?php

namespace App\DataTables;

use App\Models\HolderSubmission;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class ProcessingSubmissionsDataTable extends DataTable
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
            ->eloquent($query->with('students', 'issuer', 'receiver'))
            ->addIndexColumn()
            ->editColumn('created_at', function($holderSubmission) {
                return $holderSubmission->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('submission_date', function($holderSubmission) {
                return $holderSubmission->submission_date;
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
              return ucwords($holderSubmission->status);
            })            
            ->editColumn('current_stage', function($holderSubmission) {
                return $holderSubmission->current_stage ? config('constant.holderSubmissionStages.titles.'.$holderSubmission->current_stage) : "";
            })            
            /*->editColumn('next_stage', function($holderSubmission) {
                return $holderSubmission->next_stage ? config('constant.holderSubmissionStages.titles.'.$holderSubmission->next_stage) : "";
            })*/
            ->addColumn('action', function($holderSubmission) {
                $action  = '';
                if (Gate::check('processing_submission_show')) {
                    $action .= '<a title="'.trans('global.process').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.processing-submissions.show', $holderSubmission->id).'">'.trans('global.process').'</a>';
                }
                return $action;
            })
            ->filterColumn('submission_date', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(submission_date,'%d-%m-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            /*->filterColumn('next_stage', function($query, $keyword) {
                $sql = $this->stagesNameQuery('next_stage');
                $query->whereRaw($sql. " like ?", ["%{$keyword}%"]);
            })*/
            ->filterColumn('current_stage', function($query, $keyword) {
                $sql = $this->stagesNameQuery('current_stage');
                $query->whereRaw($sql. " like ?", ["%{$keyword}%"]);
            })
            
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\HolderSubmission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(HolderSubmission $model)
    {
        return $model->select("holder_submissions.*")->newQuery();
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
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('processing-submissions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(8,'desc')
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'stateSave'     => true,
                        'buttons'       => ['pageLength'],
                        'lengthMenu'    => config('datatables-buttons.parameters.lengthMenu'),
                        'responsive'    => true,
                        'autoWidth'     => false,
                        'width'         => '100%',
                        'language'      => [
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
            Column::make('submission_date')->title(trans('cruds.holder_submissions.fields.submission_date')),
            Column::make('submission_ref')->title(trans('cruds.holder_submissions.fields.submission_ref')),
            Column::make('students.name')->title(trans('cruds.holder_submissions.fields.student_id')),
            Column::make('issuer.name')->title(trans('cruds.holder_submissions.fields.issuer_id')),
            Column::make('receiver.name')->title(trans('cruds.holder_submissions.fields.receiver_id')),
            Column::make('status')->title(trans('cruds.holder_submissions.fields.status')),
            Column::make('current_stage')->title(trans('cruds.holder_submissions.fields.current_stage')),
            // Column::make('next_stage')->title(trans('cruds.holder_submissions.fields.next_stage')),
            Column::make('created_at')->title(trans('cruds.holder_submissions.fields.created_at'))->visible(false),            
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
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
        return 'processingSubmissions' . date('YmdHis');
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
