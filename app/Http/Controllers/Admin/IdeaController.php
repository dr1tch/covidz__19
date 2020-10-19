<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use App\User;
use App\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index()
    {
        return view('app');
    }

    // public function store(Request $request){
    //     $attributes = request()->validate([
    //         'title' => 'required|max:255',
    //         'body' => 'required',
    //         'categorie' => 'integer',
    //         'image' => 'required|mimes:jpeg,jpg,png|max:2048',
    //         'video' => 'file'
    //       ]);
  
          
          
          
  
    //        $idea = Idea::create([
    //         'user_id' => auth()->id(),
    //         'title' => $attributes['title'],
    //         'body' => $attributes['body'],
    //         'status' => 0
    //       ]);
  
    //       if(request('image')){
    //         $attributes['image'] = request('image')->store('avatars');
    //         $idea->image = $attributes['image'];
    //     }
    //     if(request('video')){
    //       $attributes['video'] = request('video')->store('avatars');
    //       $idea->video = $attributes['video'];
    //   }
           
  
    //     $idea->categorie()->associate($request->categorie);
    //       return redirect('/ideas');
  
    //       return auth()->id();
    //     }
}
