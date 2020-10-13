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
  public function categoryOrder(Request $request){
    return [
        "pending" => Idea::with(['user', 'category'])
                            ->where('status', 0)
                            ->where('category_id', $request['category_id'])
                            ->where('user_id', '!=', 1)
                            ->latest()->paginate(4), 

        "approved" => Idea::with(['user', 'category'])
                            ->where('status', 1)
                            ->where('category_id', $request['category_id'])
                            ->where('user_id', '<>', 1)
                            ->latest()->paginate(4), 
    ];
}

    public function getData()
    {
      return [Idea::with(['user', 'category'])
                    ->where('status', 1)
                    ->where('user_id', '<>', 1)
                    ->orderBy('likes', 'desc')
                    ->get()];
    }

    public function index()
    {
        return view('app');
    }

    public function add(Idea $idea){
        auth()->user()->toggleBookmark($idea);
        return back();
    }

    // public function view(){
    //   return view('app');
    // }


    public function getIdeasBookmarks(){
      return Auth::user()->bookmarks;
    }

    // public function addBookmark(Idea $idea){
    //   Auth::user()->bookmarks()->attach($idea->id);
    // }

    // public function removeBookmark(Idea $idea){
    //   Auth::user()->bookmarks()->attach($idea->id);
    // }

    // public function toggleBookmark(Idea $idea){
    //   Auth::user()->bookmarks()->toggle($idea);
    // }

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
            'category' => 'required|integer',
            'image' => 'file',
            'video' => 'file'
          ]);
          if(request('image')){

            $attributes['image'] = request('image')->store('covers');
          } else {
            $attributes['image'] = null;
        }
          
        $idea = Idea::create([
            'user_id' => Auth::user()->id,
            'category_id' => $attributes['category'],
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'image' => $attributes['image'],
            'status' => 0
        ]);
  
        
           
  
        // $idea->categorie()->associate($request->categorie);
        }
}