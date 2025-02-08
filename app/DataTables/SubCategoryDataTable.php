<?php
namespace App\DataTables;

use App\Models\SubCategory;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.'.$record->status);
            })
            ->addColumn('category', function ($subCategory) {
                return $subCategory->category ? $subCategory->category->name : 'N/A';
            })
            ->addColumn('image', function ($subCategory) {
                return $subCategory->image ? '<img src="' . asset('storage/' . $subCategory->image) . '" width="50">' : 'No image';
            })
            ->addColumn('action', function ($subCategory) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.sub-categories.show', $subCategory->id).'" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.sub-categories.edit', $subCategory->id).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.sub-categories.destroy', $subCategory->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(SubCategory $model)
    {
        return $model->newQuery(); 
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
            Column::make('DT_RowIndex')->title('ID')->orderable(false)->searchable(false)
                  ->width(50)
                  ->addClass('text-center'),
            Column::make('name')->title('Name'),
            Column::make('image')->title('Image'),
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
