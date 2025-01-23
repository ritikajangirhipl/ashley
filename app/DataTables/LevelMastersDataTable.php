<?php

namespace App\DataTables;

use App\Models\LevelMaster;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class LevelMastersDataTable extends DataTable
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
            ->editColumn('created_at', function($level) {
                return $level->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('title', function($level) {
                return $level->title ?? "";
            })            
            ->addColumn('action', function($level) {
                $action  = '';
                if (Gate::check('level_master_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="level_master level_master_show btn btn-xs btn-primary btn-sm" href="'.route('admin.levels.show', $level->id).'"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::check('level_master_edit')) {
                    $action .= '<a class="btn btn-sm btn-info edit-record" title="'.trans('global.edit').'" data-url="'.route("admin.levels.edit", $level->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('level_master_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.levels.destroy', $level->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
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
     * @param \App\Models\LevelMaster $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(LevelMaster $model)
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
                    ->setTableId('levels-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(2,'desc')
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
            Column::make('title')->title(trans('cruds.levels.fields.title')),
            Column::make('created_at')->title(trans('cruds.levels.fields.created_at')),
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
        return 'levels' . date('YmdHis');
    }
}
