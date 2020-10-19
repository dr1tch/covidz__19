<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

use App\Models\Role;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users', 'alpha_dash'],
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birth_date' => ['date'],
            // 'bio' => ['string', 'max:500'],
            'gender' => ['boolean'],
            'avatar' => ['mimes:jpeg,jpg,png|max:2048'],
            'wilaya' => ['integer'],
            'job' => ['integer'],
            'disease' => ['integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // return $data;
        $user = User::create([
            'username' => $data['username'],
            'lname' => $data['lname'],
            'fname' => $data['fname'],
            'email' => $data['email'],
            // 'bio' => $data['bio'],
            'password' => Hash::make($data['password']),
            'avatar' => '/images/default.jpg',
            'gender' => $data['gender'],
            'wilaya_id' => $data['wilaya'],
            'job_id' => $data['job'],
            'disease_id' => $data['disease'],
        ]);

        
        // $role = Role::select('id')->where('name', 'user')->first();

        // $user->role()->attach($role);

        return $user;
    }

    public function showRegistrationForm()
    {
        return view('app');
    }

    public function redirectTo(){
        if(Auth::user()->role){
            $this->redirectTo = '/admin/home';
            return $this->redirectTo;
        } else {
        $this->redirectTo = '/publications';
            return $this->redirectTo;
        }
    }
}
