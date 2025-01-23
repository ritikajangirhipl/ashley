<?php

namespace App\DataTables;

use App\Models\User;
use App\Models\Role;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class UsersDataTable extends DataTable
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
            ->editColumn('created_at', function($user) {
                return $user->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($user) {
                return $user->name ?? "";
            })
            ->editColumn('email', function($user) {
                return $user->email ?? "";
            })        
            ->addColumn('role',function($user){
                //dd($user->roles);
                $roles = $user->roles;
                $roleLabel ='';
                foreach($roles as $role){
                    $roleLabel = $roleLabel .'<label style="float:left" class="badge badge-success mr-1">'.$role->title.'</label>';
                }
                return $roleLabel;
            })            
            ->addColumn('action', function($user) {
                $action  = '';
                if (Gate::check('user_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.users.show', $user->id).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('user_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.users.edit", $user->id).'">
                    <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('user_delete')) {
                    $action .= '<form action="'.route('admin.users.destroy', $user->id).'" method="POST">
                                    <input type="hidden" name="_method" value="DELETE"> 
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <button title="'.trans('global.delete').'" class="btn btn-danger record_delete_btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>';
                }
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'role']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
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
                    ->setTableId('users-table')
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
            Column::make('name')->title(trans('cruds.user.fields.name')),
            Column::make('email')->title(trans('cruds.user.fields.email')),
            Column::make('role')->title(trans('cruds.user.fields.role')),
            Column::make('created_at')->title(trans('cruds.user.fields.created_at')),
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
        return 'users' . date('YmdHis');
    }
}
