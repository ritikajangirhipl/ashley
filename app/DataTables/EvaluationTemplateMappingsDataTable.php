<?php

namespace App\DataTables;

use App\Models\EvaluationTemplateMapping;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class EvaluationTemplateMappingsDataTable extends DataTable
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('evaluationTemplates', 'issuerCurriculumDetail.curriculum', 'receiverCurriculumDetail.curriculum')->select('evaluation_template_mappings.*'))
            ->addIndexColumn()
            ->editColumn('evaluation_template_mappings.created_at', function($record) {
                return $record->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('evaluationTemplates.name', function($record) {
                return $record->evaluationTemplates->name ?? "";
            })
            ->editColumn('issuerCurriculumDetail.school_ref', function($record) {
                // return $record->issuerCurriculumDetail->curriculum->name ?? "";
                return $record->issuerCurriculumDetail->school_ref ?? "";
            })
            ->editColumn('receiverCurriculumDetail.school_ref', function($record) {
                // return $record->receiverCurriculumDetail->curriculum->name ?? "";
                return $record->receiverCurriculumDetail->school_ref ?? "";
            })
            ->editColumn('status', function($record) {
                $checkedStatus = ($record->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($record->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status evaluation_template_mapping_status_cb toggle_switch_chk" id="normal'.$record->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$record->id.'">
                    <label class="toggle-item" for="normal'.$record->id.'"></label>
                  </div>
                </div>';
            })            
            ->addColumn('action', function($record) {
                $action  = '';
                if (Gate::check('evaluation_template_mapping_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.evaluation-template-mappings.show', $record->id).'"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::check('evaluation_template_mapping_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm edit-record" href="'.route("admin.evaluation-template-mappings.edit", $record->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('evaluation_template_mapping_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.evaluation-template-mappings.destroy', $record->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('evaluation_template_mappings.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(evaluation_template_mappings.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EvaluationTemplateMapping $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EvaluationTemplateMapping $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('evaluation-template-mapping-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(5,'desc')
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'stateSave'     => true,
                        'buttons'       => ['pageLength'],
                        'lengthMenu'    => config('datatables-buttons.parameters.lengthMenu'),
                        'responsive'    => true,
                        'autoWidth'     => false,
                        'width'         => '100%',
                        'language'      => [
                            'emptyTable' => trans('global.no_entries_in_table'),
                        ],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->title('#')->orderable(false)->searchable(false),
            Column::make('evaluationTemplates.name')->title(trans('cruds.evaluation_template_mapping.fields.evaluation_template_id')),
            Column::make('issuerCurriculumDetail.school_ref')->title(trans('cruds.evaluation_template_mapping.fields.issuer_curriculum_details_id')),
            Column::make('receiverCurriculumDetail.school_ref')->title(trans('cruds.evaluation_template_mapping.fields.receiver_curriculum_details_id')),            
            Column::make('status')->title(trans('cruds.evaluation_template_mapping.fields.status')),
            Column::make('evaluation_template_mappings.created_at')->title(trans('cruds.evaluation_template_mapping.fields.created_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->addClass('datatable_action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'evaluationTemplateMappings' . date('YmdHis');
    }

    /**
     * Get status type.
     *
     * @return string
     */
    protected function getStatus($type)
    {
        return ($type !='')? $this->status[$type] : '';
    }
}
