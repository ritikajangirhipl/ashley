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
                return $verificationProvider->name ?? __('global.N/A');
            })
            ->editColumn('country_name', function ($verificationProvider) {
                return $verificationProvider->country ? $verificationProvider->country->name : __('global.N/A');
            })
            ->editColumn('provider_type_name', function ($verificationProvider) {
                return $verificationProvider->providerType ? $verificationProvider->providerType->name : __('global.N/A');
            })
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');;
            })
            ->addColumn('action', function ($record) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.verification-providers.show', encrypt($record->id)) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.verification-providers.edit', encrypt($record->id)) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-id="' . $record->id . '" data-url="' . route('admin.verification-providers.destroy', $record->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->filterColumn('country_name', function ($query, $keyword) {
                $query->whereHas('country', function ($q) use ($keyword) {
                    $q->where('countries.name', 'LIKE', "%{$keyword}%");
                });
            })
            ->filterColumn('provider_type_name', function ($query, $keyword) {
                $query->whereHas('providerType', function ($q) use ($keyword) {
                    $q->where('provider_types.name', 'LIKE', "%{$keyword}%");
                });
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
                    ->orderBy(7)
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
            Column::make('name')->title(trans('cruds.verification_provider.fields.name')),
            Column::make('description')->title(trans('cruds.verification_provider.fields.description')),
            Column::make('email')->title(trans('cruds.verification_provider.fields.email')),
            Column::make('country_name')->title(trans('cruds.verification_provider.fields.country')),
            Column::make('provider_type_name')->title(trans('cruds.verification_provider.fields.provider_type')),
            Column::make('status')->title(trans('cruds.verification_provider.fields.status')),
            Column::make('created_at')->title(trans('cruds.verification_provider.fields.created_at')),
            Column::computed('action')
                  ->title(trans('cruds.verification_provider.fields.action'))
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

