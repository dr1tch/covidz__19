<?php

namespace App\Http\Controllers\User;

use App\Models\Idea;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;


class IdeaController extends Controller
{
    public function getData()
    {
      // dd(Idea::all());
      return Idea::all();
    }

    public function index()
    {
        return view('app')->with(["ideas" => Idea::all()]);
    }

    public function store(Request $request){
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categorie' => '',
            'image' => 'mimes:jpeg,jpg,png|max:2048',
            'video' => 'file'
          ]);
          if(request('image')){
            $attributes['image'] = request('image')->store('covers');
          } else {
            $attributes['image'] = null;
        }
          
        $idea = Idea::create([
            'user_id' => Auth::user()->id,
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'image' => $attributes['image'],
            'status' => 0
        ]);
  
        
           
  
        // $idea->categorie()->associate($request->categorie);
        }
}