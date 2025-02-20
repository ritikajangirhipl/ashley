<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    public function showRegistrationForm()
    {
        $countries = getActiveCountries();
        $clientTypes = config('constant.enums.client_type');
        return view('auth.register',compact('countries', 'clientTypes'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => 'required|string|max:255|',
            'client_type' => 'required|in:individual,organization',
            'email' => [
                'required',
                'email',
                'unique:clients,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            ],
            'phone_number' => 'required|numeric|unique:clients,phone_number',
            'country_id' => 'required|exists:countries,id',
            'contact_address' => 'required|string',
            'website_address' => 'nullable|url',
            'password' => 'required|string|min:8|confirmed',
        ],[
            'password.confirmed' => 'Password and confirm password are not same.',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Client::create([
            'name' => $data['name'],
            'client_type' => $data['client_type'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'country_id' => $data['country_id'],
            'contact_address' => $data['contact_address'],
            'website_address' => $data['website_address'],
            'status' => 1,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        event(new Registered($user));
        
        // $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
        return redirect()->route('login')->with(['message' => 'verification link has been sent to your email address.Please verify your email']);
        
    }
}
