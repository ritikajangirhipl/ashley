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
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.'.$record->status);
            }) 
            ->addColumn('category', function ($subCategory) {
                return $subCategory->category_name;
            })
            ->addColumn('action', function ($subCategory) {
                return '<a href="'.route('admin.sub-categories.show', $subCategory->SubCategoryID).'" class="btn btn-info btn-sm" title="View">
                    <i class="fas fa-eye"></i>
                </a>
                        <a href="'.route('admin.sub-categories.edit', $subCategory->SubCategoryID).'" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.sub-categories.destroy', $subCategory->SubCategoryID).'" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>';
            })
            ->rawColumns(['action']);
    }

    public function query(SubCategory $model)
    {
        return $model->newQuery()
            ->select([
                'sub_categories.SubCategoryID',
                'sub_categories.CategoryID',
                'sub_categories.name',
                'sub_categories.description',
                'sub_categories.status',
                'categories.name as category_name', 
            ])
            ->leftJoin('categories', 'sub_categories.CategoryID', '=', 'categories.CategoryID');
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('sub-categories-table')
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
            Column::make('row_number')
                  ->title('ID')
                  ->orderable(false)
                  ->searchable(false)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('name')->title('Name'),
            Column::make('description')->title('Description'),
            Column::make('status')->title('Status'),
            Column::make('category') 
                  ->title('Category')
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
        return 'SubCategory_' . date('YmdHis');
    }
}