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
      return [Idea::with('user')->orderBy('likes', 'desc')->get()];
    }

    public function index()
    {
        return view('app');
    }

    // public function like(Idea $idea, Request $request)
    // {
    //     $value = $post->like;
    //     $post->like = $value+1;
    //     $post->save();
    //     return response()->json([
    //         'message'=>'Thanks',
    //     ]);
    // }



    public function store(Request $request){
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'categorie' => '',
            // 'image' => 'file',
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