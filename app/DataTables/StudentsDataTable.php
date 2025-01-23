<?php

namespace App\DataTables;

use App\Models\Student;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

use Yajra\DataTables\Services\DataTable;
use Gate;

class StudentsDataTable extends DataTable
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
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('created_at', function($student) {
                return $student->created_at->format(config('app.date_time_format'));
            })
            ->editColumn('name', function($student) {
                return $student->name ?? "";
            })
            ->editColumn('email', function($student) {
                return $student->email ?? "";
            })
            ->editColumn('phone_number', function($student) {
                return $student->phone_number ?? "";
            })
            ->editColumn('dob', function($student) {
                $studentDob = \Carbon\Carbon::parse($student->dob)->format('d-F-Y');
                return $studentDob ?? '';
            })
            ->editColumn('status', function($student) {
                $checkedStatus = ($student->status == 'active') ? 'checked' : '';
                $status = 'active';
                if($student->status == 'active'){
                    $status = 'inactive';
                }
                return '<div class="toggle-wrapper">
                  <div class="toggle normal">
                    <input class="show_bar_status student_status_cb toggle_switch_chk" id="normal'.$student->id.'" type="checkbox" value="'.$status.'" '.$checkedStatus.' data-id="'.$student->id.'">
                    <label class="toggle-item" for="normal'.$student->id.'"></label>
                  </div>
                </div>';
            })            
            ->addColumn('action', function($student) {
                $action  = '';
                if (Gate::check('student_show')) {
                    $action .= '<a title="'.trans('global.view').'" class="student student_show btn btn-xs btn-primary btn-sm" href="'.route('admin.students.show', $student->id).'"><i class="fas fa-eye"></i></a>';
                }
                if (Gate::check('student_edit')) {
                    $action .= '<a title="'.trans('global.edit').'" class="student student_edit btn btn-info btn-sm" href="'.route("admin.students.edit", $student->id).'"><i class="fas fa-pencil-alt"></i></a>';
                }
                if (Gate::check('student_delete')) {
                    $action .= '<a title="'.trans('global.delete').'" class="btn btn-danger btn-sm delete-record" href="javascript:void(0)" data-href="'.route('admin.students.destroy', $student->id).'">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';
                }
                return $action;
            })
            ->filterColumn('created_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(created_at,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            ->filterColumn('dob', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(dob,'%d-%M-%Y') like ?", ["%$keyword%"]); //date_format when searching using date
            })
            
            ->rawColumns(['action', 'status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Student $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Student $model)
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
                    ->setTableId('students-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('lfrtip')
                    ->orderBy(6,'desc')
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
            Column::make('name')->title(trans('cruds.students.fields.name')),
            Column::make('email')->title(trans('cruds.students.fields.email')),
            Column::make('phone_number')->title(trans('cruds.students.fields.phone_number')),
            Column::make('dob')->title(trans('cruds.students.fields.dob')),
            Column::make('status')->title(trans('cruds.students.fields.status')),
            Column::make('created_at')->title(trans('cruds.students.fields.created_at')),
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
        return 'students' . date('YmdHis');
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
