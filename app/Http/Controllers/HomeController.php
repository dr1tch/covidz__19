<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {            
        return view('app');
    }

    public function getData(){
       
        $users = User::latest()->get();
        $user = Auth::user();
        $role = $user->role();
        if($user->hasRole('admin')){
            $role = 'admin';
        }
        if($user->hasRole('user')){
            $role = 'user';
        }
        $authCheck = Auth::check();
        return ["user" => $user,
                "role" => $role,
                 "auth" =>  $authCheck,
                 "users" => $users];
        }

    
}
