<?php

namespace App\DataTables;

use App\Models\ProviderType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProviderTypeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('row_number', function ($providerType) {
                static $rowNumber = 0;
                return ++$rowNumber;
            })
            ->addColumn('action', function ($providerType) {
                return '<a href="'.route('admin.provider-types.show', $providerType->ProviderTypeID).'" class="btn btn-warning btn-sm">View</a>
                        <a href="'.route('admin.provider-types.edit', $providerType->ProviderTypeID).'" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.provider-types.destroy', $providerType->ProviderTypeID).'">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
            })
            ->rawColumns(['action']);
    }

    public function query(ProviderType $model)
    {
        return $model->newQuery()->select(['ProviderTypeID', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('provider-types-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
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
        return 'ProviderType_' . date('YmdHis');
    }
}