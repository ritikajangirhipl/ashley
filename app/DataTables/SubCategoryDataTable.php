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
            ->addColumn('action', function ($subCategory) {
                return '<a href="'.route('subcategories.edit', $subCategory->SubCategoryID).'" class="btn btn-sm btn-primary">Edit</a>
                        <a href="'.route('subcategories.destroy', $subCategory->SubCategoryID).'" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</a>';
            })
            ->rawColumns(['action']);
    }

    public function query(SubCategory $model)
    {
        return $model->newQuery()->with('category'); 
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('subcategories-table')
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
            Column::make('SubCategoryID')->title('ID'),
            Column::make('category.Name')->title('Category')->data('category.name'),
            Column::make('Name')->title('SubCategory Name'),
            Column::make('Description')->title('Description'),
            Column::make('Status')->title('Status'),
            Column::computed('action')->title('Action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
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
