<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class RolesDataTable extends DataTable
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
            ->editColumn('permissions', function($record) {
                $html = '<div class="datatable-content">';                
                if($record->permissions){
                    $permissions = $record->permissions()->orderBy('title', 'ASC')->get();
                    foreach($permissions as $key => $item){
                        $html .= '<span class="badge badge-info mr-1">'.$item->title.'</span>';
                    }
                }
                $html .= '</div>';
                return $html;
            })                
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('role_show')) {
                    $action .= '<a class="btn btn-primary btn-sm" title="'.trans('global.view').'" href="'.route('admin.roles.show', $record->id).'">
                                    <i class="fas fa-eye"></i>
                                </a>';
                }
                if (Gate::check('role_edit')) {
                    $action .= '<a class="btn btn-info btn-sm" title="'.trans('global.edit').'" href="'.route("admin.roles.edit", $record->id).'">
                        <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('role_delete')) {
                    $action .= '<form action="'.route('admin.roles.destroy', $record->id).'" method="POST" class="deleteRoleForm">
                                    <input type="hidden" name="_method" value="DELETE"> 
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <button class="btn btn-danger record_delete_btn btn-sm" title="'.trans('global.delete').'"><i class="fas fa-trash-alt"></i></button></form>';
                }
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action','permissions']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
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
                    ->setTableId('roles-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(4)
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
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
            Column::make('title')->title(trans('cruds.role.fields.title')),
            Column::computed('permissions')->title(trans('cruds.role.fields.permissions')),
            Column::make('created_at')->title(trans('cruds.role.fields.created_at')),
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
        return 'roles' . date('YmdHis');
    }
}
