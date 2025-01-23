<?php

namespace App\DataTables;

use App\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class PermissionsDataTable extends DataTable
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
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('title', function($record) {
                return $record->title ?? "";
            })                
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('permission_show')) {
                    $action .= '<a class="btn btn-primary btn-sm" title="'.trans('global.view').'" href="'.route('admin.permissions.show', $record->id).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('permission_edit')) {
                    $action .= '<a class="btn btn-info btn-sm" title="'.trans('global.edit').'" href="'.route("admin.permissions.edit", $record->id).'">
                        <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('permission_delete')) {
                    $action .= '<form action="'.route('admin.permissions.destroy', $record->id).'" method="POST" class="deletePermissionForm">
                                    <input type="hidden" name="_method" value="DELETE"> 
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <button class="btn btn-danger btn-sm record_delete_btn" title="'.trans('global.delete').'"><i class="fas fa-trash-alt"></i></button>
                                </form>';
                }
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Permission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Permission $model)
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
                    ->setTableId('permissions-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'stateSave' => true,
                        'buttons' => ['pageLength'],
                        'lengthMenu' => config('datatables-buttons.parameters.lengthMenu'),
                        'responsive' => true,
                        'autoWidth' => false,
                        'width' => '100%',
                        'language' => [
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
            Column::make('title')->title(trans('cruds.permission.fields.title')),
            Column::make('created_at')->title(trans('cruds.permission.fields.created_at')),
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
        return 'permissions' . date('YmdHis');
    }
}
