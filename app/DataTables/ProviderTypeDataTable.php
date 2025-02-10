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
        return $model->newQuery()->orderBy('created_at', 'desc');;
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('provider-types-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
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