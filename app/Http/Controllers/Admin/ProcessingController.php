<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProcessingDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Processing\StoreRequest;
use App\Http\Requests\Processing\UpdateRequest;
use App\Models\Processing;
use App\Models\Order;

class ProcessingController extends Controller
{
    protected $status;
    protected $verificationOutcomes;

    public function __construct()
    {
        $this->status = config('constant.enums.processing_status');
        $this->verificationOutcomes = config('constant.enums.verification_outcome');
    }

    public function index(ProcessingDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.processing.list');
        return $dataTable->render('admin.processings.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.processing.add');
            $status = config('constants.processing_status');
            $verificationOutcomes = config('constants.verification_outcomes');
            $orders = Order::where('payment_status', 'Successful')->get();
            return view('admin.processings.create', compact('pageTitle', 'status', 'verificationOutcomes', 'orders'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
    

    public function store(StoreRequest $request)
    {
        try {
            Processing::create($request->except('_token'));
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.processing')]), 
            ['redirect_url' => route('admin.processings.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Processing $processing)
    {
        try {
            $pageTitle = trans('panel.page_title.processing.show');
            $status = $this->status;
            return view('admin.processings.show', compact('processing', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Processing $processing)
    {
        try {
            $pageTitle = trans('panel.page_title.processing.edit');
            $status = $this->status;
            $verificationOutcomes = $this->verificationOutcomes;
            $orders = Order::where('payment_status', 'Successful')->get(); 
            return view('admin.processings.edit', compact('processing', 'pageTitle', 'status', 'verificationOutcomes', 'orders'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Processing $processing)
    {
        try {
            $processing->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.processing')]), 
            ['redirect_url' => route('admin.processings.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Processing $processing)
    {
        try {
            $processing->delete();

            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.processing')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
