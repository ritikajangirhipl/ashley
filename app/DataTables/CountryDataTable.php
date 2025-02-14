<?php
namespace App\DataTables;

use App\Models\Country;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
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
            ->addColumn('flag', function ($country) {
                return $country->flag ? '<img src="' . asset('storage/' . $country->flag) . '" width="50" height="30">' : 'No Flag';
            })
            ->addColumn('action', function ($country) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.countries.show', encrypt($country->id)).'" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.countries.edit', encrypt($country->id)).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.countries.destroy', $country->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['flag', 'action']);
    }

    public function query(Country $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('countries-table')
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
            Column::make('DT_RowIndex')->title('ID')->orderable(false)->searchable(false)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('name')->title(trans('cruds.country.fields.name')),
            Column::make('flag')->title(trans('cruds.country.fields.flag')),
            Column::make('currency_name')->title(trans('cruds.country.fields.currency_name')),
            Column::make('currency_symbol')->title(trans('cruds.country.fields.currency_symbol')),
            Column::make('status')->title(trans('cruds.country.fields.status')),
            Column::make('created_at')->title(trans('cruds.country.fields.created_at')),
            Column::computed('action')->title(trans('cruds.country.fields.action'))
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Country_' . date('YmdHis');
    }
}