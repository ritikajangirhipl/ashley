<?php

namespace App\DataTables;

use App\Models\Receiver;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class ReceiversDataTable extends DataTable
{

    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
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
            ->eloquent($query->with('country')->select('receivers.*'))
            ->addIndexColumn()
            ->editColumn('receivers.created_at', function($data) {
                return $data->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('contact_name', function($data) {
                return $data->contact_name ?? "";
            })
            ->editColumn('name', function($data) {
                return $data->name ?? "";
            })
            ->editColumn('email', function($data) {
                return $data->email ?? "";
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
                    <input class="show_bar_status receiver_status_cb toggle_switch_chk" id="normal'.$data->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$data->id.'">
                    <label class="toggle-item" for="normal'.$data->id.'"></label>
                  </div>
                </div>';
            })       
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('receivers_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.receivers.show', $record->id).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('receivers_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.receivers.edit", $record->id).'">
                    <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('receivers_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.receivers.destroy', $record->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('receivers.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(receivers.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Receiver $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Receiver $model)
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
                    ->setTableId('receivers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(5)
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
            Column::make('name')->title(trans('cruds.receiver.fields.name')),
            Column::make('email')->title(trans('cruds.receiver.fields.email')),
            Column::make('country.name')->title(trans('cruds.receiver.fields.country_id')),
            Column::make('contact_name')->title(trans('cruds.receiver.fields.contact_name')),
            Column::make('receivers.created_at')->title(trans('cruds.receiver.fields.created_at')),
            Column::make('status')->title(trans('cruds.receiver.fields.status')),
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
        return 'receivers' . date('YmdHis');
    }

    /**
     * Get status.
     *
     * @return string
     */
    protected function getStatus($status)
    {
        return ($status !='')? $this->status[$status] : '';
    }

}