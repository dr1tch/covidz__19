<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function getData(){
        return User::where('username',"<>" , '4dm1n')->paginate(4);
    }

    public function index()
    {   
        return view('app');
    }

    

    public function edit(User $user){
        $roles = Role::all();
        return view('app')->with(['user' => $user, "roles" => $roles]);
    }

    public function update(Request $request, User $user){
        $request->validate([
            'role' => 'required|boolean',
        ]);
        $user->update([
            'role' => $request['role']
        ]);
    }

    public function delete(User $user){
        $user->delete();
    }

    public function deleteAll(){
        User::where('id', '>', 1)->delete();
    }
}
