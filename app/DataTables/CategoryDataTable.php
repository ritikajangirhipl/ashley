<?php
namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
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
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');
            })
            ->addColumn('image', function ($category) {
                return $category->image ? '<img src="' . asset('storage/' . $category->image) . '" width="50">' : 'No image';
            })
            ->addColumn('action', function ($category) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.categories.show', encrypt($category->id)).'" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.categories.edit', encrypt($category->id)).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.categories.destroy', $category->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button> 
                        </div>';
            })
            ->rawColumns(['action','image']); 
    }

    public function query(Category $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(5)
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
            Column::make('name')->title(trans('cruds.category.fields.name')),
            Column::make('image')->title(trans('cruds.category.fields.image')),
            Column::make('description')->title(trans('cruds.category.fields.description')),
            Column::make('status')->title(trans('cruds.category.fields.status')),
            Column::make('created_at')->title(trans('cruds.category.fields.created_at')),
            Column::computed('action')->title(trans('cruds.category.fields.action'))
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}