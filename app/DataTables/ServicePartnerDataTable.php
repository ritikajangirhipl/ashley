<?php

namespace App\DataTables;

use App\Models\ServicePartner;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ServicePartnerDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($servicePartner) {
                return config('constant.enums.status.' . $servicePartner->status);
            })
            ->addColumn('country', function ($servicePartner) {
                return $servicePartner->country ? $servicePartner->country->name : 'N/A';
            })
            
            ->addColumn('action', function ($servicePartner) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.service-partners.show', $servicePartner->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.service-partners.edit', $servicePartner->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.service-partners.destroy', $servicePartner->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']); 
    }

    public function query(ServicePartner $model)
    {
        return $model->newQuery()->orderBy('created_at', 'desc');;
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('service-partners-table')
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
            Column::make('name')->title('Name'), 
            Column::make('email_address')->title('Email'),
            Column::make('website_address')->title('Website'),
            Column::make('status')->title('Status'), 
            Column::computed('country') 
                  ->title('Country')
                  ->orderable(true) 
                  ->searchable(true), 
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
        return 'ServicePartner_' . date('YmdHis'); 
    }
}
