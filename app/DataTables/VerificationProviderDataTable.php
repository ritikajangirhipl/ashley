<?php

namespace App\DataTables;

use App\Models\VerificationProvider;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VerificationProviderDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.' . $record->status) ?? 'Unknown';
            })
            ->editColumn('name', function ($verificationProvider) {
                return $verificationProvider->name ?? 'N/A';
            })
            ->editColumn('country_name', function ($verificationProvider) {
                return $verificationProvider->country ? $verificationProvider->country->name : 'N/A';
            })
            ->editColumn('provider_type_name', function ($verificationProvider) {
                return $verificationProvider->providerType ? $verificationProvider->providerType->name : 'N/A';
            })
            ->addColumn('action', function ($record) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.verification-providers.show', $record->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.verification-providers.edit', $record->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-id="' . $record->id . '" data-url="' . route('admin.verification-providers.destroy', $record->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(VerificationProvider $model)
    {
        return $model->newQuery()
        ->select('verification_providers.*', 'countries.name as country_name', 'provider_types.name as provider_type_name')
        ->join('countries', 'countries.id', '=', 'verification_providers.country_id') 
        ->join('provider_types', 'provider_types.id', '=', 'verification_providers.provider_type_id'); 
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('verification-providers-table')
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
            Column::make('DT_RowIndex')->title('ID')->orderable(false)->searchable(false)
                  ->width(50)
                  ->addClass('text-center'),    
            Column::make('name')->title('Name'),
            Column::make('description')->title('Description'),
            Column::make('email')->title('Email'),
            Column::make('status')->title('Status'),
            Column::make('country_name')->title('Country'),
            Column::make('provider_type_name')->title('Provider Type'),
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
        return 'VerificationProvider_' . date('YmdHis');
    }
}

