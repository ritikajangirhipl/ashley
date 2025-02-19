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
            ->editColumn('name', function ($client) {
                return $client->name ?? __('global.N/A');
            })
            ->editColumn('country.name', function ($client) {
                return $client->country ? $client->country->name : __('global.N/A');
            })
            ->editColumn('client_type', function ($client) {
                return $client->client_type == 'individual' ? 'Individual' : 'Organization';
            })
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');
            })  
            ->addColumn('action', function ($client) {
                return '<div class="group-button d-flex">
                            <a href="' . route('admin.clients.show', encrypt($client->id)) . '" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="' . route('admin.clients.edit', encrypt($client->id)) . '" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="' . route('admin.clients.destroy', $client->id) . '" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->filterColumn('country_name', function ($query, $keyword) {
                $query->whereHas('country', function ($q) use ($keyword) {
                    $q->where('countries.name', 'LIKE', "%{$keyword}%"); 
                });
            })
            ->rawColumns(['action']); 
    }

    public function query(Client $model)
    {
        return $model->newQuery()
                    ->select('clients.*', 'countries.name as country_name')
                    ->leftJoin('countries', 'countries.id', '=', 'clients.country_id');
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('clients-table')
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
            Column::make('DT_RowIndex')->title('ID') 
                  ->orderable(false) 
                  ->searchable(false) 
                  ->width(50)
                  ->addClass('text-center'),    
            Column::make('name')->title(trans('cruds.client.fields.name')), 
            Column::make('client_type')->title(trans('cruds.client.fields.client_type')), 
            Column::make('email')->title(trans('cruds.client.fields.email')),
            Column::make('phone_number')->title(trans('cruds.client.fields.phone_number')), 
            Column::make('status')->title(trans('cruds.client.fields.status')), 
            Column::make('country_name')->title(trans('cruds.client.fields.country')),  
            Column::make('created_at')->title(trans('cruds.client.fields.created_at')),
            Column::computed('action') 
                  ->title(trans('cruds.client.fields.action'))
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
