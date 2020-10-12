<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Wilaya;
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
        
        $users = User::all();
        $users =  $users->except(6);
        $user = Auth::user();
        $role = $user->role;
        if($user->role){
            $role = 'admin';
        }
        if(!$user->role){
            $role = 'user';
        }
        $authCheck = Auth::check();
        $data =  [
            "user" => $user,
            "role" => $role,
            "auth" =>  $authCheck,
            "users" => $users,
            "categories" => Category::all(),
            "wilayas" => Wilaya::all(),
        ];
        return $data;
        }

    
}
