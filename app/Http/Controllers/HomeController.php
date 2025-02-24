<?php

namespace App\Http\Controllers;

use App\DataTables\VerificationServiceDataTable;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\VerificationProvider;
use App\Models\Service;
use App\Models\ProviderType;
use App\Models\VerificationMode;
use App\Models\EvidenceType;
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

    public function catalogue(VerificationServiceDataTable $dataTable, $slug=null)
    {
        $dataArr = [];
        if(!empty($slug)){
            $data = Country::where(['slug' => $slug])->first();
            $type ='country';
            if(!$data){
                $data = SubCategory::with(['category'])->where(['slug' => $slug])->first();
                $type ='category';
            }
            if(!$data){
                $data = VerificationProvider::where(['slug' => $slug])->first();
                $type ='providers';
            }
            if(!$data){
                abort(404);
            }
            $dataArr['type'] = $type;
            $dataArr['id'] = $data->id;
            $dataArr['name'] = $data->name;

            if($type == 'category'){
                $dataArr['category_id'] = $data->category->id;
                $dataArr['category_name'] = $data->category->name;
                $dataArr['category_slug'] = $data->category->slug;
            }
        }
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();
        $categories = Category::where(['status' => 1])->orderBy('name', 'asc')->get();
        $verificationProviders = VerificationProvider::where(['status' => 1])->orderBy('name', 'asc')->get();
        $providerTypes = ProviderType::where(['status' => 1])->orderBy('name', 'asc')->get();
        $verificationModes = VerificationMode::where(['status' => 1])->orderBy('name', 'asc')->get();
        $evidenceTypes = EvidenceType::where(['status' => 1])->orderBy('name', 'asc')->get();
        //$subcategories = SubCategory::where(['status' => 1])->get();
        return $dataTable->render('catalogue',compact('countries','categories','verificationProviders','providerTypes','verificationModes','evidenceTypes','dataArr'));
    }

    public function country()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->paginate(40);
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
            $service = Service::with(['country','category','subCategory','verificationMode', 'verificationProvider', 'evidenceType','additionalFields'])->where('id', decrypt($id))->firstOrFail();

            $fields = config('constant.enums.input_details_fields');

            $otherServices = Service::where(['verification_provider_id' => $service->verification_provider_id])->where('id', '!=', $service->id)->orderBy('name', 'asc')->limit(5)->get();
            
            if(!$service){
                abort(404);
            }
            // dd($service->toArray());
            return view('service-detail', compact('service','otherServices','fields'));
        } catch (DecryptException) {
            abort(404);
        } 
    }

    public function getSubCategories(Request $request)
    {
        $subCategories = getActiveSubCategories($request->category_id);
        if($subCategories){

            return response()->json([
                'status' => 400,
                'message' => __('attribute.sub_category'),
                'sub_categories' => $subCategories,
            ], 200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => __('messages.record_not_found',['record' => __('attribute.country')])
            ], 400);
        }

    }

    public function catalogueCountry(VerificationServiceDataTable $dataTable, $slug)
    {
        $country = Country::where(['slug' => $slug])->first();
        if(!$country){
            abort(404);
        }
        $countryId = $country->id;
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();
        $categories = Category::where(['status' => 1])->orderBy('name', 'asc')->get();
        $verificationProviders = VerificationProvider::where(['status' => 1])->orderBy('name', 'asc')->get();
        $providerTypes = ProviderType::where(['status' => 1])->orderBy('name', 'asc')->get();
        $verificationModes = VerificationMode::where(['status' => 1])->orderBy('name', 'asc')->get();
        $evidenceTypes = EvidenceType::where(['status' => 1])->orderBy('name', 'asc')->get();
        return $dataTable->render('catalogue_country',compact('countries','categories','verificationProviders','providerTypes','verificationModes','evidenceTypes','countryId','slug'));
    }
   

}
