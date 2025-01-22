<?php
namespace App\DataTables;

use App\Models\VerificationMode;
use Yajra\DataTables\Services\DataTable;

class VerificationModeDatatable extends DataTable
{
    public function dataTable($query)
    {
        return datatables($query)
            ->addIndexColumn()
            ->addColumn('action', function ($verificationMode) {
                $editButton = '<a href="' . route('verification-modes.edit', $verificationMode->id) . '" class="btn btn-warning btn-sm">Edit</a>';
                $deleteButton = '<form action="' . route('verification-modes.destroy', $verificationMode->id) . '" method="POST" style="display:inline;">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '
                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                  </form>';
                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['action']);
    }

    public function query(VerificationMode $model)
    {
        return $model->newQuery()->select(['id', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('verification-modes-table')
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
                'title' => 'Mode ID', 
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