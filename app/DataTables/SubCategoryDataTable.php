<?php
namespace App\DataTables;

use App\Models\SubCategory;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('row_number', function ($subCategory) {
                static $rowNumber = 0;
                return ++$rowNumber;
            })
            ->addColumn('category', function ($subCategory) {
                return $subCategory->category->name; 
            })
            ->addColumn('action', function ($subCategory) {
                return '<a href="'.route('admin.sub-categories.show', $subCategory->SubCategoryID).'" class="btn btn-info btn-sm">View</a>
                        <a href="'.route('admin.sub-categories.edit', $subCategory->SubCategoryID).'" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.sub-categories.destroy', $subCategory->SubCategoryID).'">
                            <i class="fas fa-trash"></i> Delete
                        </button>';
            })
            ->rawColumns(['action']);
    }

    public function query(SubCategory $model)
    {
        return $model->newQuery()->with('category')->select(['SubCategoryID', 'CategoryID', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('sub-categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    protected function getColumns()
    {
        return [
            Column::make('SubCategoryID') // Replace 'row_number' with 'SubCategoryID'
                  ->title('ID') // Change the title to 'ID'
                  ->orderable(true)
                  ->searchable(true)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('category')->title('Category'),
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
        return 'SubCategory_' . date('YmdHis');
    }
}