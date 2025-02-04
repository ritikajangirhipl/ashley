<?php

namespace App\DataTables;

use App\Models\VerificationProvider;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VerificationProviderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('row_number', function ($verificationprovider) {
                static $rowNumber = 0;
                return ++$rowNumber;
            })
            ->addColumn('action', function ($verificationprovider) {
                return '<a href="' . route('admin.verification-providers.show', $verificationprovider->ProviderID) . '" class="btn btn-warning btn-sm">View</a>
                        <a href="' . route('admin.verification-providers.edit', $verificationprovider->ProviderID) . '" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.verification-providers.destroy', $verificationprovider->ProviderID) . '">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
            })
            ->rawColumns(['action']);
    }

    public function query(VerificationProvider $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('verification-provider-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1);
    }

    protected function getColumns()
    {
        return [
            Column::make('row_number')
                ->title('ID')
                ->orderable(false)
                ->searchable(false)
                ->width(50)
                ->addClass('text-center'),
            Column::make('name')->title('Name'),
            Column::make('description')->title('Description'),
            Column::make('status')->title('Status'),
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'VerificationProvider_' . date('YmdHis');
    }
}
