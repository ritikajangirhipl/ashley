<?php
namespace App\DataTables;

use App\Models\VerificationMode;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VerificationModeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('row_number', function ($verificationMode) {
                static $rowNumber = 0;
                return ++$rowNumber;
            })
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.'.$record->status);
            }) 
            ->addColumn('action', function ($verificationMode) {
                return '<a href="'.route('admin.verification-modes.show', $verificationMode->ModeID).'" class="btn btn-warning btn-sm" title="View">
                    <i class="fas fa-eye"></i>
                </a>
                        <a href="'.route('admin.verification-modes.edit', $verificationMode->ModeID).'" class="btn btn-warning btn-sm" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.verification-modes.destroy', $verificationMode->ModeID).'" title="Delete">
                            <i class="fas fa-trash"></i>
                        </button>';
            })
            ->rawColumns(['action']);
    }

    public function query(VerificationMode $model)
    {
        return $model->newQuery()->select(['ModeID', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('verification-modes-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(1)
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
            Column::computed('action')->title('Action')
                ->exportable(false)
                ->printable(false)
                ->width(150)
                ->addClass('text-center'),
        ];
    }
    protected function filename(): string
    {
        return 'VerificationMode_' . date('YmdHis');
    }
}