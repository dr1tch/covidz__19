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
   
    public function index()
    {   
        return view('app');
    }
    public function getData(){
        return [
            "pending" => Idea::with(['user', 'category', 'users'])->where('status', 0)->latest()->get(), 
            "approved" => Idea::with(['user', 'category', 'users'])->where('status', 1)->latest()->get(), 
            "refused" => Idea::with(['user', 'category', 'users'])->where('status', 2)->latest()->get(), 

        ];
        // return [ 'ideas' => Idea::with('category')->where('status', $request['status'])->latest()->paginate(4)];

    }
    public function actions(Request $request, Idea $idea){
        $idea->status = $request['status'];
        $idea->update();
    }

    public function update(Request $request, Idea $idea){
        // dd(request());
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required|integer',
            'image' => 'sometimes|nullable|mimes:jpeg,jpg,png|max:2048',
            'video' => 'file'
        ]);
        if(request('image')){
          $idea->image = request('image')->store('covers');
        }  
        if(request('video')){
            $idea->image = request('video')->store('covers');
          }            
        $idea->update([
          'user_id' => Auth::user()->id,
          'category_id' => $attributes['category_id'],
          'title' => $attributes['title'],
          'body' => $attributes['body'],
        ]);
      }
    public function delete(Idea $idea){
        $idea->delete();
    }

    // public function deleteAll(){
    //     User::where('id', '<', 6)->delete();
    // }
}
