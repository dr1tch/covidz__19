<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {   
        return view('app');
    }

    public function indexAPI(){

        $users = User::all();
        $user = Auth::user();
        $authCheck = Auth::check();
        $data = [$user, $authCheck, $users];
        return response()->json($data);
    }
}
