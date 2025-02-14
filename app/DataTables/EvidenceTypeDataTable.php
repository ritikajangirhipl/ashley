<?php
namespace App\DataTables;

use App\Models\EvidenceType;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class EvidenceTypeDataTable extends DataTable
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
            ->addColumn('action', function ($evidenceType) {
                return '<div class="group-button d-flex">
                            <a href="'.route('admin.evidence-types.show', $evidenceType->id).'" class="btn btn-warning btn-sm" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="'.route('admin.evidence-types.edit', $evidenceType->id).'" class="btn btn-warning btn-sm" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="btn btn-danger btn-sm delete-record" data-href="'.route('admin.evidence-types.destroy', $evidenceType->id).'" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>';
            })
            ->rawColumns(['action']);
    }

    public function query(EvidenceType $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('evidence-types-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('frtip')
                    ->orderBy(4)
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
            Column::make('name')->title(trans('cruds.evidence_type.fields.name')),
            Column::make('description')->title(trans('cruds.evidence_type.fields.description')),
            Column::make('status')->title(trans('cruds.evidence_type.fields.status')),
            Column::make('created_at')->title(trans('cruds.evidence_type.fields.created_at')),
            Column::computed('action')->title(trans('cruds.evidence_type.fields.action'))
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