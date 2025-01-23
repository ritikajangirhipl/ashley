<?php

namespace App\DataTables;

use App\Models\AccreditationBody;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class AccreditationBodiesDataTable extends DataTable
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
            ->eloquent($query->with('country'))
            ->addIndexColumn()
            ->editColumn('accreditation_bodies.created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('accreditation_bodies.name', function($record) {
                return ucfirst($record->name) ?? "";
            })      
            ->editColumn('country.name', function($record) {
                return $record->country->name ?? "";
            })      
            ->editColumn('accreditation_bodies.status', function($record) {
                $checkedStatus = ($record->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($record->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status accreditation_status_cb toggle_switch_chk" id="normal'.$record->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$record->id.'">
                    <label class="toggle-item" for="normal'.$record->id.'"></label>
                  </div>
                </div>';
            })      
            ->addColumn('action', function($record) {
                $action = '';
                if (Gate::check('accreditation_body_show')) {
                    $action .= '<a class="btn btn-sm btn-primary" title="'.trans('global.view').'"  href="'.route('admin.accreditation-bodies.show', $record->id).'">
                                    <i class="fas fa-eye"></i>
                                </a>';
                }
                if (Gate::check('accreditation_body_edit')) {
                    $action .= '<a class="btn btn-sm btn-info edit-record" href="javascript:void(0)" title="'.trans('global.edit').'" data-url="'.route("admin.accreditation-bodies.edit", $record->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('accreditation_body_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.accreditation-bodies.destroy', $record->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })            
            
            ->rawColumns(['action','accreditation_bodies.status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AccreditationBody $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AccreditationBody $model)
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
                    ->setTableId('accreditation-body-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(4,'desc')
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
            Column::make('accreditation_bodies.name')->title(trans('cruds.accreditation_bodies.fields.name')),
            Column::make('country.name')->title(trans('cruds.accreditation_bodies.fields.country_id')),
            Column::make('accreditation_bodies.status')->title(trans('cruds.accreditation_bodies.fields.status')),
            Column::make('accreditation_bodies.created_at')->title(trans('cruds.accreditation_bodies.fields.created_at')),
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
        return 'accreditation-bodies' . date('YmdHis');
    }
}