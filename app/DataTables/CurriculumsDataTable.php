<?php

namespace App\DataTables;

use App\Models\Curriculum;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class CurriculumsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with(['degree','curriculumable'])->select('curriculums.*'))
            ->addIndexColumn()
            ->editColumn('curriculumable.name', function($record) {
              return $record->curriculumable->name ?? "";
            })
            ->editColumn('curriculums.created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($record) {
                return ucfirst($record->name) ?? "";
            })      
            ->editColumn('degree.qualification', function($record) {
                return $record->degree->qualification ?? "";
            })      
            ->editColumn('status', function($data) {
                $checkedStatus = ($data->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($data->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status curriculum_status_cb toggle_switch_chk" id="normal'.$data->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$data->id.'">
                    <label class="toggle-item" for="normal'.$data->id.'"></label>
                  </div>
                </div>';
            })      
            ->addColumn('action', function($record) {
                $action = '';
                if (Gate::check('curriculums_show')) {
                    $action .= '<a class="btn btn-sm btn-primary view-record" title="'.trans('global.view').'" href="javascript:void(0)" data-url="'.route('admin.curriculums.show', [request()->type, $record->id]).'">
                                    <i class="fas fa-eye"></i>
                                </a>';
                }
                if (Gate::check('curriculums_edit')) {
                    $action .= '<a class="btn btn-sm btn-info edit-record" href="javascript:void(0)" title="'.trans('global.edit').'" data-url="'.route("admin.curriculums.edit", [request()->type, $record->id]).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('curriculums_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.curriculums.destroy', [request()->type, $record->id]).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('curriculums.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(curriculums.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })            
            
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Curriculum $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Curriculum $model)
    {
        if(request()->type == 'issuer'){
            return $model->whereHasMorph('curriculumable','App\Models\Issuer')->newQuery();
        }else{
            return $model->whereHasMorph('curriculumable','App\Models\Receiver')->newQuery();            
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
                    ->setTableId(request()->type.'-curriculums-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(5,'desc')
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
            Column::make('name')->title(trans('cruds.curriculums.fields.name')),
            Column::make('curriculumable.name')->title(trans('cruds.degrees.fields.'.request()->type.'_id')),
            Column::make('degree.qualification')->title(trans('cruds.curriculums.fields.qualification')),
            Column::make('status')->title(trans('cruds.curriculums.fields.status')),
            Column::make('curriculums.created_at')->title(trans('cruds.curriculums.fields.created_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action no-gutters row'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'curriculums' . date('YmdHis');
    }
}