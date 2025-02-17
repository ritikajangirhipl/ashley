<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('client.name', function ($order) {
                return $order->client ? $order->client->name : __('global.N/A');
            })
            ->editColumn('service.name', function ($order) {
                return $order->service ? $order->service->name : __('global.N/A');
            })
            // ->editColumn('payment_status', function ($order) {
            //     return $order->paymentStatus ? $order->paymentStatus->name : __('global.N/A');
            // })
            // ->editColumn('processing_status', function ($order) {
            //     return $order->processingStatus ? $order->processingStatus->name : __('global.N/A');
            // })
            ->editColumn('reason', function ($order) {
                return ucfirst($order->reason);
            })
            ->addColumn('action', function ($order) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.orders.show', $order->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(Order $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(0)
                    ->language([
                        'emptyTable' => 'No records found',
                    ]);
    }

    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('ID')
                  ->orderable(false)
                  ->searchable(false)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('client_name')->title('Client'),
            Column::make('service_name')->title('Service'),
            Column::make('subject_name')->title('Subject'),
            Column::make('reason')->title('Reason'),
            Column::computed('action')
                  ->title('Action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Order_' . date('YmdHis');
    }
}

