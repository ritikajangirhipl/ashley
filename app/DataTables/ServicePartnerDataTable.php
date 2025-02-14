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
            ->editColumn('name', function ($servicePartner) {
                return $servicePartner->name ?? 'N/A';
            })
            ->editColumn('country_name', function ($servicePartner) {
                return $servicePartner->country ? $servicePartner->country->name : 'N/A';
            })
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');;
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
        return $model->newQuery()
                    ->select('service_partners.*', 'countries.name as country_name')
                    ->leftJoin('countries', 'countries.id', '=', 'service_partners.country_id');
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('service-partners-table')
                    ->columns($this->getColumns()) 
                    ->minifiedAjax()
                    ->dom('frtip') 
                    ->orderBy(6) 
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
            Column::make('name')->title(trans('cruds.service_partners.fields.name')), 
            Column::make('email_address')->title('Email'),
            Column::make('website_address')->title('Website'),
            Column::make('country_name')->title('Country'),
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
        return 'ServicePartner_' . date('YmdHis'); 
    }
}
