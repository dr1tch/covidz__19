<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {   
        $users = User::all();
        return view('app', ['users' => json_decode($users, true)]);
    }
}
