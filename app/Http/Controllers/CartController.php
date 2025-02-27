<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Service;

class CartController extends Controller
{

    public function __construct()
    {
        
    }

    public function index(Request $request){
        
        // dd(Cart::instance('shopping')->content());
        return view('cart');
    }

    public function addToCart(Request $request)
    {
        try {
            $service = Service::where('id', decrypt($request->service_id))->first();
            if($service){
                $options = $request->except('_token','service_id');
                if (!Auth::check()) {
                    $cart['id'] = $service->id;
                    $cart['name'] = $service->name;
                    $cart['price'] = $service->usd_service_price;
                    $cart['qty'] = 1;
                    if($request->hasFile('copy_of_document_to_verify')){
                        $filePath = $request->file('copy_of_document_to_verify')->store('tmp'); 
                        $options['copy_of_document_to_verify'] = $filePath;
                    }
                    if($request->hasFile('subject_consent_requirement')){
                        $filePath1 = $request->file('subject_consent_requirement')->store('tmp');
                        $options['subject_consent_requirement'] = $filePath1; 
                    }
                    $cart['options'] = $options;
                    Session::put('cart_product', $cart);

                    return jsonResponseWithMessage(200, "Please log in to continue.", 
                    ['redirect_url' => route('login'),'status' => 'error']);
                }

                $filePath = $filePath1 = null;
                if($request->hasFile('copy_of_document_to_verify')){
                    $filePath = $request->file('copy_of_document_to_verify')->store('order_images'); 
                    $options['copy_of_document_to_verify'] = $filePath;
                }
                if($request->hasFile('subject_consent_requirement')){
                    $filePath1 = $request->file('subject_consent_requirement')->store('order_images');
                    $options['subject_consent_requirement'] = $filePath1; 
                }

                Cart::instance('shopping')->add([
                    'id' => $service->id,
                    'name' => $service->name,
                    'qty' => 1,
                    'price' => $service->usd_service_price,
                    'options' => $options,
                ])->associate('App\Models\Service');

                updateCartWithDb(auth()->user()->id, 'shoppingcart');

                return jsonResponseWithMessage(200, "Item added in cart successfully", 
                ['redirect_url' => route('cart.get'),'status' => 'success']);
            }else{
                return jsonResponseWithException($e);
            }
            
        } catch (Exception $e) {
            return jsonResponseWithException($e);
        }

    }

}