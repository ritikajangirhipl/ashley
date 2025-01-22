<?php
namespace App\DataTables;

use App\Models\Country;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn() 
            ->addColumn('action', function ($country) {
                $editButton = '<a href="' . route('countries.edit', $country->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                $deleteButton = '<form action="' . route('countries.destroy', $country->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                </form>';
                return $editButton . ' ' . $deleteButton;
            })
            ->addColumn('flag', function ($country) {
                return '<img src="' . asset('storage/' . $country->flag) . '" alt="Flag" width="50">';
            })
            ->rawColumns(['flag', 'action']); 
    }


    public function query(Country $model)
    {
        return $model->newQuery()->select([
            'id', 
            'name', 
            'flag', 
            'description', 
            'currency_name', 
            'currency_symbol', 
            'status'
        ]);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('countries-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1) 
                    ->parameters([
                        'dom' => 'Bfrtip',
                        'buttons' => ['excel', 'pdf', 'print'],
                    ]);
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'DT_RowIndex', 'name' => 'DT_RowIndex','title' => '#','orderable' => false,'searchable' => false,
            ],
            [
                'data' => 'name','name' => 'name','title' => 'Name',
            ],
            [
                'data' => 'flag','name' => 'flag','title' => 'Flag','orderable' => false,'searchable' => false,
            ],
            [
                'data' => 'description','name' => 'description','title' => 'Description',
            ],
            [
                'data' => 'currency_name','name' => 'currency_name','title' => 'Currency Name',
            ],
            [
                'data' => 'currency_symbol','name' => 'currency_symbol','title' => 'Currency Symbol',
            ],
            [
                'data' => 'status','name' => 'status','title' => 'Status',
            ],
            [
                'data' => 'action','name' => 'action','title' => 'Actions','orderable' => false,'searchable' => false,
            ],
        ];
    }

/**
     * Get the filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Country_' . date('YmdHis');
    }
}

