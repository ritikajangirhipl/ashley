<?php

namespace App\DataTables;

use App\Models\Service;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\DB;

class VerificationServiceDataTable extends DataTable
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
            ->eloquent($query)
            ->addIndexColumn()
            ->editColumn('provider_name', function ($service) {
                return $service->verificationProvider->name ?? __('global.N/A'); 
            })
            ->editColumn('country_name', function ($service) {
                return $service->country_name ?? __('global.N/A'); 
            })
            ->editColumn('verification_duration', function ($service) {
                return $service->verification_duration ?? __('global.N/A');
            })
            ->editColumn('local_service_price', function ($service) {
                return $service->local_service_price ? $service->currency_name. ' : '. number_format($service->local_service_price, 2, '.', ',') : __('global.N/A');
            })
            ->editColumn('usd_service_price', function ($service) {
                return $service->usd_service_price ? trans('global.usd').' : ' .number_format($service->usd_service_price, 2, '.', ',') : __('global.N/A');
            })
            ->editColumn('price', function ($service) {
                return $service->price;
            })
            
            ->addColumn('action', function ($service) {
                return '<div class="group-button text-center">
                            <a href="' . route('services.view', encrypt($service->id)) . '" class="infobtn" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>';
            })
            ->filterColumn('price', function ($query, $keyword) {
                $query->whereRaw("
                    (CASE 
                        WHEN services.country_id = ? 
                        THEN ROUND(services.local_service_price, 2) 
                        ELSE ROUND(services.usd_service_price, 2) 
                    END) LIKE ?", 
                    [auth()->check() ? auth()->user()->country_id : 0, "%{$keyword}%"]
                );
            })
            ->filterColumn('country_name', function ($query, $keyword) {
                $query->whereHas('country', function ($q) use ($keyword) {
                    $q->where('countries.name', 'LIKE', "%{$keyword}%");
                });
            }) 
            ->filterColumn('provider_name', function ($query, $keyword) {
                $query->whereHas('verificationProvider', function ($q) use ($keyword) {
                    $q->where('verification_providers.name', 'LIKE', "%{$keyword}%");
                });
            }) 
            ->rawColumns(['action']); 
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\VerificationServiceDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model)
    {
        if (request()->has('free_text_search') && request('free_text_search') != '') {
            $search = request()->input('search', []);
            $search['value'] = request('free_text_search'); 
            request()->merge(['search' => $search]); 
        }
        
        $query = $model->newQuery()
        ->select('services.*', 'countries.name as country_name','verification_providers.name as provider_name', 'countries.currency_name as currency_name', DB::raw("(CASE 
            WHEN services.country_id = " . (auth()->check() ? auth()->user()->country_id : 0) . " 
            THEN CONCAT(countries.currency_name, ' : ', FORMAT(services.local_service_price, 2)) 
            ELSE CONCAT('USD : ', FORMAT(services.usd_service_price, 2)) 
        END) AS price"))
        ->leftJoin('countries', 'countries.id', '=', 'services.country_id')
        ->leftJoin('verification_providers', 'verification_providers.id', '=', 'services.verification_provider_id');

        if (request()->has('verification_country') && request('verification_country') != '') {
            $query->where('countries.id', request('verification_country'));
        }
        if (request()->has('verification_provider_type') && request('verification_provider_type') != '') {
            $query->where('verification_providers.provider_type_id', request('verification_provider_type'));
        }

        if (request()->has('verification_provider') && request('verification_provider') != '') {
            $query->where('verification_providers.id', request('verification_provider'));
        }

        if (request()->has('verification_subject') && request('verification_subject') != '') {
            $query->where('services.subject', request('verification_subject'));
        }
        if (request()->has('verification_category') && request('verification_category') != '') {
            $query->where('services.category_id', request('verification_category'));
        }

        if (request()->has('verification_subcategory') && request('verification_subcategory') != '') {
            $query->where('services.sub_category_id', request('verification_subcategory'));
        }
        if (request()->has('evidence_type') && request('evidence_type') != '') {
            $query->where('services.evidence_type_id', request('evidence_type'));
        }
        if (request()->has('verification_mode') && request('verification_mode') != '') {
            $query->where('services.verification_mode_id', request('verification_mode'));
        }
        
        return $query;
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('services-table')
                    ->columns($this->getColumns()) 
                    ->minifiedAjax()
                    ->dom('lfrtip') 
                    ->pageLength(10)
                    ->orderBy(1) 
                    ->language([
                        'emptyTable' => 'No records found', 
                    ])
                    ->parameters([
                        'stateSave' => false,
                        'buttons' => ['pageLength'],
                        'responsive' => true,
                        'searching' => false,
                        'initComplete' => "function () {  
                            $(document).on('submit', '#searchService', function(e){
                                e.preventDefault();
                                updateDataTable();
                            });
                           
                        }"
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        $columns = [];
        $columns[] = Column::make('DT_RowIndex')->title('Service ID')->orderable(false)->searchable(false)->width(50)->addClass('text-center');
        $columns[] = Column::make('name')->title(trans('cruds.services.title_singular'). ' ' .trans('cruds.services.fields.name'));
        $columns[] = Column::make('provider_name')->title(trans('cruds.services.fields.verification_provider'))->orderable(true)->searchable(true);
        $columns[] = Column::make('country_name') ->title(trans('cruds.services.fields.country'))->orderable(true)->searchable(true);
        $columns[] = Column::make('verification_duration')->title(trans('cruds.services.fields.duration'))->orderable(true)->searchable(true);
        if (!auth()->check()) {
            $columns[] = Column::make('local_service_price')->title(trans('cruds.services.fields.local_price')) ->orderable(true);
            $columns[] = Column::make('usd_service_price')->title(trans('cruds.services.fields.usd_price'))->orderable(true);
        } else {
            $columns[] = Column::make('price')->title(trans('global.price'))->orderable(true)->searchable(true);
        }
        $columns[] = Column::computed('action')->title(trans('cruds.services.fields.action'))->exportable(false)->printable(false)->width(150)->addClass('text-center');
        return $columns;
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'VerificationService_' . date('YmdHis');
    }
}
