<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Category;
use App\Models\VerificationProvider;

class HomeController extends Controller
{
    public function index()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        $categories = Category::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        $verificationProviders = VerificationProvider::where(['status' => 1])->orderBy('name', 'asc')->limit(12)->get();
        return view('home', compact('countries','categories','verificationProviders'));
    }

    public function catalogue()
    {
        return view('catalogue');
    }

    public function country()
    {
        $countries = Country::where(['status' => 1])->orderBy('name', 'asc')->get();
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
   

}
