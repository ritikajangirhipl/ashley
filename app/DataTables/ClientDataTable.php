<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ClientDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($client) {
                return config('constant.enums.status.' . $client->status);
            })
            ->addColumn('country', function ($client) {
                return $client->country ? $client->country->name : 'N/A';
            })
            ->addColumn('client_type', function ($client) {
                return $client->client_type == 'individual' ? 'Individual' : 'Organization';
            })
            ->addColumn('action', function ($client) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.clients.show', $client->id) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.clients.edit', $client->id) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.clients.destroy', $client->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']); 
    }

    public function query(Client $model)
    {
        return $model->newQuery()->with(['country']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('clients-table')
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
            Column::make('DT_RowIndex')->title('Client ID') 
                  ->orderable(false) 
                  ->searchable(false) 
                  ->width(50)
                  ->addClass('text-center'),    
            Column::make('name')->title('Client Name'), 
            Column::make('client_type')->title('Client Type'), 
            Column::make('email_address')->title('Email Address'),
            Column::make('phone_number')->title('Phone Number'), 
            Column::make('website_address')->title('Website Address')->optional(),
            Column::make('contact_address')->title('Contact Address'),
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
        return 'Client_' . date('YmdHis'); 
    }
}
