<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreRequest;
use App\Http\Requests\Order\UpdateRequest;
use App\Models\Order;
use App\Models\Client;
use App\Models\Service;
use App\Models\Country;

class OrderController extends Controller
{
    protected $statuses;
    protected $currencies;

    public function __construct()
    {
        $this->statuses = config('constant.enums.order_status');
        $this->currencies = ['Service Currency', 'USD'];
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
            $statuses = $this->statuses;
            $clients = Client::all();
            $services = Service::all();
            $countries = Country::all();
            $currencies = $this->currencies;
            
            return view('admin.orders.create', compact('pageTitle', 'statuses', 'clients', 'services', 'countries', 'currencies'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            Order::create($request->except('_token'));
            return jsonResponseWithMessage(200, __('messages.add_success_message', ['attribute' => __('attribute.order')]), 
            ['redirect_url' => route('admin.orders.index')]);
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
            $statuses = $this->statuses;
            $clients = Client::all();
            $services = Service::all();
            $countries = Country::all();
            $currencies = $this->currencies;
            
            return view('admin.orders.edit', compact('order', 'pageTitle', 'statuses', 'clients', 'services', 'countries', 'currencies'));
        } catch (\Exception $e) {
            return jsonResponseWithException($e);
        }
    }

    public function update(UpdateRequest $request, Order $order)
    {
        try {
            $order->update($request->except('_token', '_method'));
            return jsonResponseWithMessage(200, __('messages.update_success_message', ['attribute' => __('attribute.order')]), 
            ['redirect_url' => route('admin.orders.index')]);
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
