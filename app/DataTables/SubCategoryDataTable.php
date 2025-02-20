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
            ->editColumn('name', function ($subCategory) {
                return $subCategory->name ?? __('global.N/A');
            })
            ->editColumn('category_name', function ($subCategory) {
                return $subCategory->category_name ? $subCategory->category_name : __('global.N/A');
            })
            
            ->editColumn('image', function ($subCategory) {
                return $subCategory->image ? '<img src="' . asset('storage/' . $subCategory->image) . '" width="50">' : 'No image';
            })
            ->editColumn('created_at', function ($record) {
                return date("Y-m-d", strtotime($record['created_at'])) ?? __('global.N/A');;
            })
            ->addColumn('action', function ($subCategory) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.sub-categories.show', encrypt($subCategory->id)).'" class="btn btn-info btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.sub-categories.edit', encrypt($subCategory->id)).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.sub-categories.destroy', $subCategory->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->filterColumn('category_name', function ($query, $keyword) {
                $query->whereHas('category', function ($q) use ($keyword) {
                    $q->where('categories.name', 'LIKE', "%{$keyword}%"); 
                });
            })
            ->rawColumns(['action', 'image']);
    }

    public function query(SubCategory $model)
    {
        return $model->newQuery()
                 ->select('sub_categories.*', 'categories.name as category_name') 
                 ->join('categories', 'categories.id', '=', 'sub_categories.category_id');
                   
    }
    
    public function html()
    {
        return $this->builder()
                    ->setTableId('sub-categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(6, 'desc')
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
            Column::make('name')->title(trans('cruds.sub_category.fields.name')),
            Column::make('image')->title(trans('cruds.sub_category.fields.image')),
            Column::make('description')->title(trans('cruds.sub_category.fields.description')),
            Column::make('category_name')->title(trans('cruds.sub_category.fields.category'))
                  ->searchable(true)
                  ->orderable(true),
            Column::make('status')->title(trans('cruds.sub_category.fields.status')),
            Column::make('created_at')->title(trans('cruds.sub_category.fields.created_at')),
            Column::computed('action')
                  ->title(trans('cruds.sub_category.fields.action'))
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
