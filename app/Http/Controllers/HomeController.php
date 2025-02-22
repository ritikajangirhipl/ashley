<?php

namespace App\Http\Controllers;

use App\DataTables\VerificationServiceDataTable;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\VerificationProvider;
use App\Models\Service;
use Illuminate\Contracts\Encryption\DecryptException;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        $categories = Category::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        $verificationProviders = VerificationProvider::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        return view('home', compact('countries','categories','verificationProviders'));
    }

    public function catalogue(VerificationServiceDataTable $dataTable)
    {
        // return view('catalogue');
        return $dataTable->render('catalogue');
    }

    public function country()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->paginate(1);
        return view('country', compact('countries'));
    }
    
    public function category()
    {
        $categories = Category::where(['status' => 1])->orderBy('name', 'asc')->get();
        return view('category', compact('categories'));
    }
    public function verificationProvider()
    {
        $verificationProviders = VerificationProvider::where(['status' => 1])->orderBy('name', 'asc')->get();
        return view('verification_provider', compact('verificationProviders'));
    }

    public function subCategory($slug)
    {
        $category = Category::where(['slug' => $slug])->first();
        if(!$category){
            abort(404);
        }
        $subcategories = SubCategory::where(['category_id' => $category->id])->get();
        return view('sub_category', compact('subcategories','category'));
    }

    public function serviceDetail($id){
        try {
            $service = Service::with(['country','category','subCategory','verificationMode', 'verificationProvider', 'evidenceType'])->where('id', decrypt($id))->firstOrFail();
            $otherServices = Service::where(['verification_provider_id' => $service->verification_provider_id])->where('id', '!=', $service->id)->orderBy('name', 'asc')->limit(5)->get();
            if(!$service){
                abort(404);
            }
            // dd($service->toArray());
            return view('service-detail', compact('service','otherServices'));
        } catch (DecryptException) {
            abort(404);
        } 
    }
   

}
