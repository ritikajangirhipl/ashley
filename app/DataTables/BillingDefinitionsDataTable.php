<?php

namespace App\DataTables;

use App\Models\BillingDefinition;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class BillingDefinitionsDataTable extends DataTable
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
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($data) {
                return $data->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('billable_id', function($data) {
                return $data->billable->name ?? "";
            })
            ->editColumn('other_fees', function($data) {
                return $data->other_fees ?? "";
            })
            ->editColumn('total_fees', function($data) {
                return $data->total_fees ?? "";
            })
            ->editColumn('degree_id', function($data) {
                return $data->degree->qualification ?? "";
            })   
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('billing_definitions_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.billing-definitions.show', [request()->billingType,$record->id]).'">
                    <i class="fas fa-eye"></i>
                                    </a>';
                }
                if (Gate::check('billing_definitions_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.billing-definitions.edit", [request()->billingType,$record->id]).'">
                    <i class="fas fa-pencil-alt"></i>
                    </a>';
                }
                if (Gate::check('billing_definitions_delete')) {
                    $action .= '<form action="'.route('admin.billing-definitions.destroy', [request()->billingType,$record->id]).'" method="POST" class="d-inline deleteRecordForm">
                                    <input type="hidden" name="_method" value="DELETE"> 
                                    <input type="hidden" name="_token" value="'.csrf_token().'">
                                    <button title="'.trans('global.delete').'" class="btn btn-danger record_delete_btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                                </form>';
                }
                return $action;
            })
            ->editColumn('status', function($data) {
                $checkedStatus = ($data->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($data->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status billing_definition_status_cb toggle_switch_chk" id="normal'.$data->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$data->id.'">
                    <label class="toggle-item" for="normal'.$data->id.'"></label>
                  </div>
                </div>';
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\BillingDefinition $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BillingDefinition $model)
    {
        if(request()->billingType == 'issuer'){
            return $model->whereHasMorph('billable','App\Models\Issuer')->newQuery();
        }else{
            return $model->whereHasMorph('billable','App\Models\Receiver')->newQuery();            
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
                    ->setTableId(request()->billingType.'-billing-informations-table')
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
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('billable_id')->title(trans('cruds.billing_definitions.fields.'.request()->billingType.'_id')),
            Column::make('degree_id')->title(trans('cruds.billing_definitions.fields.degree_id')),
            Column::make('receiver_fees')->title(trans('cruds.billing_definitions.fields.receiver_fees'))->visible(request()->billingType == "receiver"),
            Column::make('other_fees')->title(trans('cruds.billing_definitions.fields.other_fees')),
            Column::make('total_fees')->title(trans('cruds.billing_definitions.fields.total_fees')),
            Column::make('created_at')->title(trans('cruds.billing_definitions.fields.created_at')),
            Column::make('status')->title(trans('cruds.billing_definitions.fields.status')),
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
        return 'billingInformations' . date('YmdHis');
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