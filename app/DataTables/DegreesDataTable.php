<?php

namespace App\DataTables;

use App\Models\Degree;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class DegreesDataTable extends DataTable
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
            ->eloquent($query->with(['country','degrable','accreditationBody'])->select('degrees.*'))
            ->addIndexColumn()
            ->editColumn('degrees.created_at', function($data) {
                return $data->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('degrable.name', function($data) {
                return $data->degrable->name ?? "";
            })
            ->editColumn('qualification', function($data) {
                return $data->qualification ?? "";
            })
            ->editColumn('accreditationBody.name', function($data) {
                return $data->accreditationBody->name ?? "";
            })
            ->editColumn('accreditation_status', function($data) {
                return $data->accreditation_status ?? "";
            })

            ->editColumn('country.name', function($data) {
                return $data->country->name ?? "";
            })
            ->editColumn('status', function($data) {
                $checkedStatus = ($data->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($data->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status degree_status_cb toggle_switch_chk" id="normal'.$data->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$data->id.'">
                    <label class="toggle-item" for="normal'.$data->id.'"></label>
                  </div>
                </div>';
            })       
                  
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('degrees_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.degrees.show', [request()->degreeType,$record->id]).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('degrees_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.degrees.edit", [request()->degreeType,$record->id]).'">
                    <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('degrees_delete')) {
                    $action .= '<form action="'.route('admin.degrees.destroy', [request()->degreeType,$record->id]).'" method="POST" class="d-inline deleteRecordForm">
                                    <input type="hidden" name="_method" value="DELETE"> 
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <button title="'.trans('global.delete').'" class="btn btn-danger record_delete_btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>';
                }
                return $action;
            })
            ->filterColumn('degrees.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(degrees.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Degree $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Degree $model)
    {
        if(request()->degreeType == 'issuer'){
            return $model->whereHasMorph('degrable','App\Models\Issuer')->newQuery();
        }else{
            return $model->whereHasMorph('degrable','App\Models\Receiver')->newQuery();            
        }
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId(request()->degreeType.'-degrees-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(6,'desc')
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
            Column::make('qualification')->title(trans('cruds.degrees.fields.qualification')),
            Column::make('degrable.name')->title(trans('cruds.degrees.fields.'.request()->degreeType.'_id')),
            Column::make('accreditationBody.name')->title(trans('cruds.degrees.fields.accreditation_body_id')),
            Column::make('accreditation_status')->title(trans('cruds.degrees.fields.accreditation_status')),
            Column::make('country.name')->title(trans('cruds.degrees.fields.country_id')),
            Column::make('degrees.created_at')->title(trans('cruds.degrees.fields.created_at')),
            Column::make('status')->title(trans('cruds.degrees.fields.status')),
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
        return 'degrees' . date('YmdHis');
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