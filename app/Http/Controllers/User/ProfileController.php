<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Idea;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(User $user){
        return view('app')->with(['ideas' => Idea::where('user_id', $user->id)->get(),  'auth' => Auth::user()]);
    }
    public function getData(User $user){
        return ['ideas' => Idea::where('user_id', $user->id)->get(),  'auth' => Auth::user()];
    }
    public function edit(User $user){
        return view('app');
    }
    public function update(Request $request){

    }
}
