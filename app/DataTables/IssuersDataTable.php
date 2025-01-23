<?php

namespace App\DataTables;

use App\Models\Issuer;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class IssuersDataTable extends DataTable
{

    private $status;
    private $issuerType;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status               = config('constant.enums.status');
        $this->issuerType           = config('constant.enums.issuerType');
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
            ->eloquent($query->with('country')->select('issuers.*'))
            ->addIndexColumn()
            ->editColumn('issuers.created_at', function($data) {
                return $data->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('contact_name', function($data) {
                return $data->contact_name ?? "";
            })
            ->editColumn('name', function($data) {
                return $data->name ?? "";
            })
            ->editColumn('initial', function($data) {
                return $data->initial ?? "";
            })
            ->editColumn('type', function($data) {
                return $this->getIssuerType($data->type);
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
                    <input class="show_bar_status issuer_status_cb toggle_switch_chk" id="normal'.$data->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$data->id.'">
                    <label class="toggle-item" for="normal'.$data->id.'"></label>
                  </div>
                </div>';
            })       
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('issuer_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.issuers.show', $record->id).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('issuer_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.issuers.edit", $record->id).'">
                    <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('issuer_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.issuers.destroy', $record->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('issuers.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(issuers.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Issuer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Issuer $model)
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
                    ->setTableId('issuers-table')
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
            Column::make('name')->title(trans('cruds.issuer.fields.name')),
            Column::make('initial')->title(trans('cruds.issuer.fields.initial')),
            Column::make('type')->title(trans('cruds.issuer.fields.type')),
            Column::make('country.name')->title(trans('cruds.issuer.fields.country_id')),
            Column::make('issuers.created_at')->title(trans('cruds.issuer.fields.created_at')),
            Column::make('contact_name')->title(trans('cruds.issuer.fields.contact_name')),
            Column::make('status')->title(trans('cruds.issuer.fields.status')),
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
        return 'issuers' . date('YmdHis');
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

    /**
     * Get Issuer type.
     *
     * @return string
     */
    protected function getIssuerType($type)
    {
        return ($type !='')? $this->issuerType[$type] : '';
    }
}