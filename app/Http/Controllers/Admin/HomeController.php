<?php

namespace App\Http\Controllers\Admin;

use Auth;

class HomeController
{
    public function index()
    {
    	return view('admin.dashboard');
    }

    public function notifications(){
    	return view('admin.test');
    }
}
