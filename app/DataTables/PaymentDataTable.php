<?php

namespace App\DataTables;

use App\Models\Payment;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PaymentDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($payment) {
                return $payment->status == 'successful' ? 'Successful' : 'Failed';
            })
            ->editColumn('order.currency', function ($payment) {
                return $payment->order ? $payment->order->currency : __('global.N/A');
            })
            ->editColumn('order.amount', function ($payment) {
                return $payment->order ? $payment->order->amount : __('global.N/A');
            })
            ->addColumn('action', function ($payment) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.payments.show', $payment->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.payments.edit', $payment->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.payments.destroy', $payment->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(Payment $model)
    {
        return $model->newQuery()->with(['order']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('payments-table')
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
            Column::make('order.id')->title('Order ID'),
            Column::make('order.currency')->title('Currency'), 
            Column::make('order.amount')->title('Amount'),
            Column::make('reference_number')->title('Reference Number'),
            Column::make('evidence')->title('Evidence')
                  ->render(function ($data) {
                      return $data ? '<a href="' . asset('storage/' . $data) . '" target="_blank">View PDF</a>' : 'No evidence';
                  }),
            Column::make('status')->title('Status'), 
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
        return 'Payment_' . date('YmdHis');
    }
}
