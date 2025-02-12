<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Payment\StoreRequest;
use App\Http\Requests\Payment\UpdateRequest;
use App\Models\Payment;
use App\Models\Order;

class PaymentController extends Controller
{
    protected $status;

    public function __construct()
    {
        $this->status = config('constant.enums.payment_status');
    }

    public function index(PaymentDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.payment.list');
        return $dataTable->render('admin.payments.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.payment.add');
            $status = $this->status;
            $orders = Order::all();

            return view('admin.payments.create', compact('pageTitle', 'status', 'orders'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Payment::create($request->except('_token'));
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.payment')]), 
            ['redirect_url' => route('admin.payments.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Payment $payment)
    {
        try {
            $pageTitle = trans('panel.page_title.payment.show');
            $status = $this->status;
            return view('admin.payments.show', compact('payment', 'pageTitle', 'status'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Payment $payment)
    {
        try {
            $pageTitle = trans('panel.page_title.payment.edit');
            $status = $this->status;
            $orders = Order::all();
            
            return view('admin.payments.edit', compact('payment', 'pageTitle', 'status', 'orders'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Payment $payment)
    {
        try {
            $payment->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.payment')]), 
            ['redirect_url' => route('admin.payments.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Payment $payment)
    {
        try {
            $payment->delete();
            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.payment')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
