<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\User;

class IdeasController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function getData(){
        return [
            "pending" => Idea::where('status', 0)->latest()->paginate(4), 
            "approved" => Idea::where('status', 1)->latest()->paginate(4), 
        ];
    }
    public function index()
    {   
        return view('app');
    }

    public function update(Request $request, Idea $idea)
    {
        $idea->status = 1;
        $idea->update();
    }
    public function delete(Idea $idea){
        $idea->delete();
    }

    public function deleteAll(){
        User::where('id', '<', 6)->delete();
    }
}
