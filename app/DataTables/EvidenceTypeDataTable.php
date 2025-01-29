<?php
namespace App\DataTables;

use App\Models\EvidenceType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EvidenceTypeDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('row_number', function ($evidenceType) {
                static $rowNumber = 0;
                return ++$rowNumber;
            })
            ->editColumn('status', function ($record) {
                return config('constant.enums.status.'.$record->status);
            })            
            ->addColumn('action', function ($evidenceType) {
                return '<div style="display: flex; gap: 5px;">
                            <a href="'.route('admin.evidence-types.show', $evidenceType->EvidenceTypeID).'" class="btn btn-warning btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.evidence-types.edit', $evidenceType->EvidenceTypeID).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.evidence-types.destroy', $evidenceType->EvidenceTypeID).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(EvidenceType $model)
    {
        return $model->newQuery()->select(['EvidenceTypeID', 'name', 'description', 'status']);
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('evidence-types-table')
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
        return 'EvidenceType_' . date('YmdHis');
    }
}