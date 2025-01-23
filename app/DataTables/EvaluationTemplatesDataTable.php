<?php

namespace App\DataTables;

use App\Models\EvaluationTemplate;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class EvaluationTemplatesDataTable extends DataTable
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
            ->eloquent($query->with('issuerCurriculum', 'receiverCurriculum', 'issuers', 'receivers')->select('evaluation_templates.*'))
            ->addIndexColumn()
            ->editColumn('evaluation_templates.created_at', function($evaluationTemplate) {
                return $evaluationTemplate->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($evaluationTemplate) {
                return $evaluationTemplate->name ?? "";
            })
            ->editColumn('issuers.name', function($evaluationTemplate) {
                return $evaluationTemplate->issuers->name ?? "";
            })
            ->editColumn('receivers.name', function($evaluationTemplate) {
                return $evaluationTemplate->receivers->name ?? "";
            })
            ->editColumn('issuerCurriculum.name', function($evaluationTemplate) {
                return $evaluationTemplate->issuerCurriculum->name ?? "";
            })
            ->editColumn('receiverCurriculum.name', function($evaluationTemplate) {
                return $evaluationTemplate->receiverCurriculum->name ?? "";
            })
            ->editColumn('status', function($evaluationTemplate) {
                $checkedStatus = ($evaluationTemplate->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($evaluationTemplate->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status evaluation_template_status_cb toggle_switch_chk" id="normal'.$evaluationTemplate->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$evaluationTemplate->id.'">
                    <label class="toggle-item" for="normal'.$evaluationTemplate->id.'"></label>
                  </div>
                </div>';
            })            
            ->addColumn('action', function($evaluationTemplate) {
                $action  = '';
                if (Gate::check('evaluation_templates_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="btn btn-xs btn-primary btn-sm" href="'.route('admin.evaluation-templates.show', $evaluationTemplate->id).'"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::check('evaluation_templates_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="btn btn-info btn-sm" href="'.route("admin.evaluation-templates.edit", $evaluationTemplate->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('evaluation_templates_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.evaluation-templates.destroy', $evaluationTemplate->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('evaluation_templates.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(evaluation_templates.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'issuerCurriculum.name', 'receiverCurriculum.name','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\EvaluationTemplate $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(EvaluationTemplate $model)
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
                    ->setTableId('evaluation-template-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(7,'desc')
                    ->buttons(
                        Button::make('export'),
                        Button::make('reset'),
                        Button::make('reload')
                    )
                    ->parameters([
                        'stateSave'   => true,
                        'buttons'     => ['pageLength'],
                        'lengthMenu'  => config('datatables-buttons.parameters.lengthMenu'),
                        'responsive'  => true,
                        'autoWidth'   => false,
                        'width'       => '100%',
                        'language'    => [
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
            Column::make('name')->title(trans('cruds.evaluation_templates.fields.name')),
            Column::make('issuers.name')->title(trans('cruds.evaluation_templates.fields.issuer_id')),
            Column::make('issuerCurriculum.name')->title(trans('cruds.evaluation_templates.fields.issuer_curriculum_id')),
            Column::make('receivers.name')->title(trans('cruds.evaluation_templates.fields.receiver_id')),
            Column::make('receiverCurriculum.name')->title(trans('cruds.evaluation_templates.fields.receiver_curriculum_id')),            
            Column::make('status')->title(trans('cruds.evaluation_templates.fields.status')),
            Column::make('evaluation_templates.created_at')->title(trans('cruds.evaluation_templates.fields.created_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width('130')
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
        return 'evaluationTemplates' . date('YmdHis');
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
