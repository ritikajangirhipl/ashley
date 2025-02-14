<?php

namespace App\DataTables;

use App\Models\ProviderType;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProviderTypeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.'.$record->status);
            }) 
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');;
            })
            ->addColumn('action', function ($providerType) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.provider-types.show', $providerType->id).'" class="btn btn-warning btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.provider-types.edit', $providerType->id).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.provider-types.destroy', $providerType->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(ProviderType $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('provider-types-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(4)
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
            Column::make('status')->title(trans('cruds.verification_provider.fields.status')),
            Column::make('created_at')->title(trans('cruds.verification_provider.fields.created_at')),
            Column::computed('action')->title(trans('cruds.verification_provider.fields.action'))
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