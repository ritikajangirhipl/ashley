<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Hash;
use Gate;
use Validator;
use App\Models\User;

class ProfileController extends Controller
{

    public function profile()
    {
        $loggedUser         = Auth::user();
        $pageTitle          = trans('panel.page_title.profile');
        return view('admin.profile', compact('loggedUser','pageTitle'));
    }
    
    public function updateProfile(Request $request, $id)
    {
        $rules = [];
        $rules['email']     = 'required|email|unique:users,email,' . Auth::user()->id;
        $rules['password']  = 'nullable|min:8';
        $rules['name']      = 'required';
        $request->validate($rules);

        $saveData = array();
        $email = $request->email;
        $saveData['email'] = $email;
        $saveData['name'] = $request->name;
        if($request->password!=""){
            $password = Hash::make($request->password);
            $saveData['password'] = $password;
        }
        $updateData = User::whereId($id)->update($saveData);

        return redirect()->back()->with(['message' => 'Profile updated successfully!']);
    }

    public function showChangePasswordForm(Request $request) {
        $pageTitle   = trans('panel.page_title.change_password');
        return view('admin.change-password', compact('pageTitle'));
    }

    public function changePassword(Request $request) {
        $rules = [];
        $rules['password']  = 'required|min:8|confirmed';
        $request->validate($rules);
            
        if (Hash::check($request->password, auth()->user()->password)) {
            Auth::user()->update(['password' => Hash::make($request->password)]);
            $notification = ['message' => "Password changed successfully",'alert-type' =>  trans('panel.alert-type.success')];
        } else {
            $notification = ['message' => "New password can not be the old password!",'alert-type' =>  trans('panel.alert-type.error')];
        }
        return redirect()->back()->with($notification);
    }
}
