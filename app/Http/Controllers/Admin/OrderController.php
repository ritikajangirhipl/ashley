<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;

class OrderController extends Controller
{
    protected $status;
    protected $currencies;
    protected $processing_status;
    protected $payment_status;

    public function __construct()
    {
        $this->status = config('constant.enums.status');
    }

    public function index(OrderDataTable $dataTable)
    {
        $pageTitle = trans('panel.page_title.order.list');
        return $dataTable->render('admin.orders.index', compact('pageTitle'));
    }

    public function create()
    {
        try {
            $pageTitle = trans('panel.page_title.order.add');
            $clients = getClients();
            $services = getServices();
            $countries = getActiveCountries();
            return view('admin.orders.create', compact('pageTitle', 'clients', 'services', 'countries'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $order = Order::create($request->validated());
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.order')]), ['redirect_url' => route('admin.orders.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function show(Order $order)
    {
        try {
            $pageTitle = trans('panel.page_title.order.show');
            return view('admin.orders.show', compact('order', 'pageTitle'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function edit(Order $order)
    {
        try {
            $pageTitle = trans('panel.page_title.order.edit');
            $clients = getClients();
            $services = getServices();
            $countries = getActiveCountries();
            return view('admin.orders.edit', compact('order', 'pageTitle', 'clients', 'services', 'countries'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Order $order)
    {
        try {
            $order->update($request->validated());
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.order')]), ['redirect_url' => route('admin.orders.index')]);
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function destroy(Order $order)
    {
        try {
            $order->delete();
            return jsonResponseWithMessage(200, __('messages.delete_success_message', ['attribute' => __('attribute.order')]));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }
}
