<?php

namespace App\DataTables;

use App\Models\CurriculumDetail;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Gate;

class CurriculumDetailsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query->with('levelMaster', 'curriculum', 'curriculum.curriculumable', 'curriculum.degree')->select('curriculum_details.*'))
            ->addIndexColumn()
            ->editColumn('curriculum.curriculumable.name', function($curriculumDetail) {
                return $curriculumDetail->curriculum->curriculumable->name ?? "";
            })
            ->editColumn('curriculum.degree.qualification', function($curriculumDetail) {
                return $curriculumDetail->curriculum->degree->qualification ?? "";
            })
            ->editColumn('curriculum.name', function($curriculumDetail) {
                return $curriculumDetail->curriculum->name ?? "";
            })
            ->editColumn('curriculum_details.created_at', function($curriculumDetail) {
                return $curriculumDetail->created_at->format(config('app.date_time_format'));
            })      
            ->editColumn('levelMaster.title', function($curriculumDetail) {
                return $curriculumDetail->levelMaster->title ?? "";
            })
            ->editColumn('course_code', function($curriculumDetail) {
                return $curriculumDetail->course_code ?? "";
            })
            ->editColumn('course_name', function($curriculumDetail) {
                return $curriculumDetail->course_name ?? "";
            })      
            ->editColumn('status', function($curriculumDetail) {
                $checkedStatus = ($curriculumDetail->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($curriculumDetail->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status curriculum_detail_status_cb toggle_switch_chk" id="normal'.$curriculumDetail->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$curriculumDetail->id.'">
                    <label class="toggle-item" for="normal'.$curriculumDetail->id.'"></label>
                  </div>
                </div>';
            })      
            ->addColumn('action', function($curriculumDetail) {
                $action = '';
                if (Gate::check('curriculum_detail_show')) {
                    $action .= '<a class="btn btn-sm btn-primary view-record" title="'.trans('global.view').'" href="javascript:void(0)" data-url="'.route('admin.curriculum-details.show', [request()->type, $curriculumDetail->id]).'">
                                    <i class="fas fa-eye"></i>
                                </a>';
                }
                if (Gate::check('curriculum_detail_delete')) {
                    $action .= '<a class="btn btn-sm btn-info edit-record" href="javascript:void(0)" title="'.trans('global.edit').'" data-url="'.route("admin.curriculum-details.edit", [request()->type, $curriculumDetail->id]).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('curriculums_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record d-inline" href="javascript:void(0)" data-href="'.route('admin.curriculum-details.destroy', [request()->type, $curriculumDetail->id]).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('curriculum_details.created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(curriculum_details.created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CurriculumDetail $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CurriculumDetail $model)
    {
      if(request()->type == 'issuer'){
        $modelType = 'App\Models\Issuer';          
      }else{
        $modelType = 'App\Models\Receiver';                  
      }
      return $model->whereHas('curriculum', function($query) use($modelType){
          $query->where('curriculumable_type', '=', $modelType);
      })->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId(request()->type.'-curriculum-details-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(0,'desc')
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
            Column::make('id')->title('#'),
            Column::make('curriculum.curriculumable.name')->title(trans('cruds.'.request()->type.'.title_singular')." ".trans('cruds.curriculum_details.fields.name')),
            Column::make('curriculum.degree.qualification')->title(trans('cruds.'.request()->type.'.title_singular')." ".trans('cruds.curriculum_details.fields.degree')),
            Column::make('curriculum.name')->title(trans('cruds.'.request()->type.'.title_singular')." ".trans('cruds.curriculum_details.fields.curriculum')),
            Column::make('levelMaster.title')->title(trans('cruds.curriculum_details.fields.level_master_id')),
            Column::make('course_code')->title(trans('cruds.curriculum_details.fields.course_code')),
            Column::make('course_name')->title(trans('cruds.curriculum_details.fields.course_name')),
            Column::make('status')->title(trans('cruds.curriculum_details.fields.status')),
            Column::make('curriculum_details.created_at')->title(trans('cruds.curriculum_details.fields.created_at')),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width('130')
                  ->addClass('datatable_action no-gutters row'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'curriculumDetails' . date('YmdHis');
    }
}