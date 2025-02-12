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
                return $order->client ? $order->client->name : 'N/A';
            })
            ->editColumn('service.name', function ($order) {
                return $order->service ? $order->service->name : 'N/A';
            })
            ->editColumn('location.name', function ($order) {
                return $order->location ? $order->location->name : 'N/A';
            })
            ->editColumn('order_payment_status', function ($order) {
                return config('constant.enums.payment_status.' . $order->order_payment_status);
            })
            ->editColumn('order_processing_status', function ($order) {
                return config('constant.enums.processing_status.' . $order->order_processing_status);
            })
            ->addColumn('action', function ($order) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.orders.show', $order->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.orders.edit', $order->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.orders.destroy', $order->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']); 
    }

    public function query(Order $model)
    {
        return $model->newQuery()->with(['client', 'service', 'location']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('orders-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1, 'asc')
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
            Column::make('id')->title('Order ID'),
            Column::make('client.name')->title('Client'),
            Column::make('service.name')->title('Service'),
            Column::make('name_of_subject')->title('Subject Name'),
            Column::make('reason_for_request')->title('Reason for Request'),
            Column::make('name_of_reference_provider')->title('Reference Provider'),
            Column::make('address_information')->title('Address Info'),
            Column::make('location.name')->title('Location'),
            Column::make('gender')->title('Gender'),
            Column::make('marital_status')->title('Marital Status'),
            Column::make('registration_number')->title('Registration Number'),
            Column::make('preferred_currency')->title('Preferred Currency'),
            Column::make('order_amount')->title('Order Amount'),
            Column::make('order_payment_status')->title('Payment Status'),
            Column::make('order_processing_status')->title('Processing Status'),
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
