<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Country\StoreRequest;
use App\Http\Requests\Country\UpdateRequest;
use App\Models\Country;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use Validator;

use App\DataTables\CountriesDataTable;

class CountriesController extends Controller
{

    public function index(CountriesDataTable $dataTable)
    {
        abort_if(Gate::denies('country_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.master.country.list_of_country');
        return $dataTable->render('admin.master.countries.index', compact('pageTitle'));
    }

    public function create()
    {
        abort_if(Gate::denies('country_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html = view('admin.master.countries.create')->render();
        return response()->json(['html' => $html]);
    }

    public function store(StoreRequest $request)
    {
        $country = Country::create($request->all());  
        return response()->json(['success' => true, 'message' => trans('cruds.country.title_singular').' '.trans('messages.add_success_message')], 200);    
    }

    public function edit(Country $country)
    {
        abort_if(Gate::denies('country_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $html = view('admin.master.countries.edit', compact('country'))->render();
        return response()->json(['html' => $html]);
    }

    public function update(UpdateRequest $request, Country $country)
    {
        $country->update($request->all());
        return response()->json(['success' => true, 'message' => trans('cruds.country.title_singular').' '.trans('messages.edit_success_message')], 200);
    }

    public function show(Country $country)
    {
        abort_if(Gate::denies('country_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.master.country.show_country');
        return view('admin.master.countries.show', compact('country', 'pageTitle'));
    }

    public function destroy(Country $country)
    {
        abort_if(Gate::denies('country_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $country->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.country.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeCountryStatus(Request $request){
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'country_id'     => [
                    'required',
                    'numeric',
                    'exists:countries,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $country = Country::where('id', $request->country_id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.country.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }

}
