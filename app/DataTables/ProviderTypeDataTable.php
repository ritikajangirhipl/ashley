<?php
namespace App\DataTables;

use App\Models\ProviderType;
use Yajra\DataTables\Services\DataTable;

class ProviderTypeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($providerType) {
                $editButton = '<a href="' . route('provider-types.edit', $providerType->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                $deleteButton = '<form action="' . route('provider-types.destroy', $providerType->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                  </form>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action']);
    }

    public function query(ProviderType $model)
    {
        return $model->newQuery()->select(['id', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('provider-types-table')
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
                'data' => 'DT_RowIndex',
                'name' => 'DT_RowIndex',
                'title' => 'Provider Type ID', 
                'orderable' => false,
                'searchable' => false,
            ],
            [
                'data' => 'name',
                'name' => 'name',
                'title' => 'Name',
            ],
            [
                'data' => 'description',
                'name' => 'description',
                'title' => 'Description',
            ],
            [
                'data' => 'status',
                'name' => 'status',
                'title' => 'Status',
            ],
            [
                'data' => 'action',
                'name' => 'action',
                'title' => 'Actions',
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    protected function filename(): string
    {
        return 'ProviderType_' . date('YmdHis');
    }
}