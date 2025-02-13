<?php

namespace App\DataTables;
use App\Models\Processing;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProcessingDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($processing) {
                return $processing->status == 'Not Started' ? 'Not Started' : ($processing->status == 'Processing' ? 'Processing' : ($processing->status == 'Complete' ? 'Complete' : 'Cancelled'));
            })
            ->editColumn('verification_outcome', function ($processing) {
                // Show outcome based on status
                return $processing->status == 'Complete' ? ($processing->verification_outcome ?: 'N/A') : 'N/A';
            })
            ->editColumn('outcome_evidence', function ($processing) {
                // Show evidence link or 'N/A' based on status
                return $processing->status == 'Complete' ? ($processing->outcome_evidence ?: 'N/A') : 'N/A';
            })
            ->addColumn('action', function ($processing) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.processings.show', $processing->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.processings.edit', $processing->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.processings.destroy', $processing->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']); 
    }

    public function query(Processing $model)
    {
        return $model->newQuery()
                    ->select('processings.*', 'orders.id as order_id')
                    ->leftJoin('orders', 'orders.id', '=', 'processings.order_id')
                    ->where('orders.payment_status', 'Successful'); // Filter orders with successful payment
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('processings-table')
                    ->columns($this->getColumns()) 
                    ->minifiedAjax()
                    ->dom('frtip') 
                    ->orderBy(10, 'desc')
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
            Column::make('order_id')->title('Processing ID'), 
            Column::make('status')->title('Processing Status'), 
            Column::make('verification_outcome')->title('Verification Outcome'),
            Column::make('outcome_evidence')->title('Outcome Evidence'), 
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
        return 'Processing_' . date('YmdHis'); 
    }
}
