<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch all countries, ordered by name (ascending)
        $countries = Country::orderBy('name', 'asc')->get();

        // Pass the countries data to the home view
        return view('home', compact('countries'));
    }

}
