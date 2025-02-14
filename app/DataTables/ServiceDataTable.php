<?php

namespace App\DataTables;

use App\Models\Service;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($service) {
                return config('constant.enums.status.' . $service->status);
            })
            ->addColumn('country', function ($service) {
                return $service->country ? $service->country->name : __('global.N/A');
            })
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');;
            })
            ->addColumn('action', function ($service) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.services.show', encrypt($service->id)) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.services.edit', encrypt($service->id)) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.services.destroy', $service->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']); 
    }

    public function query(Service $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');;
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('services-table')
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
            Column::make('DT_RowIndex')->title('ID') 
                  ->orderable(false) 
                  ->searchable(false) 
                  ->width(50)
                  ->addClass('text-center'),    
            Column::make('name')->title(trans('cruds.services.fields.name')), 
            Column::make('status')->title(trans('cruds.services.fields.status')), 
            Column::computed('country') 
                  ->title(trans('cruds.services.fields.country'))
                  ->orderable(true) 
                  ->searchable(true), 
            Column::make('created_at')->title(trans('cruds.services.fields.created_at')), 
            Column::computed('action') 
                  ->title(trans('cruds.services.fields.action'))
                  ->exportable(false) 
                  ->printable(false) 
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Services_' . date('YmdHis'); 
    }
}
