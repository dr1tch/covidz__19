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

  // public function bookmarkCategoryOrder(Request $request){
  //   $bookmarks = collect(Auth::user()->bookmarks);
  //   dd($bookmarks);
  //   // $send = array();
  //   foreach ($bookmarks as $bookmark) {
  //     if($bookmark->category_id != $request['category_id']){
  //       $bookmarks->pull($bookmark);
  //     }
  //   }
  //   return $bookmarks;
  // }

    public function getData()
    {
      $ideas = Idea::with(['user', 'category', 'users'])
                    ->where('status', 1)
                    ->where('user_id', '<>', 1)
                    // ->orderBy('likes', 'desc')
                    ->latest()
                    ->get();
      // foreach ($ideas as $idea) {
      //   foreach ($idea->users as $user) {
      //     if($user->id == Auth::user()->id){
      //         $idea['liked'] = 1;
      //     } else {
      //         $idea['liked'] = 0;
      //     }
      //   }
      // }
      return $ideas;
    }

    public function afterLike(){
      $ideas = Idea::with(['user', 'category', 'users'])
                    ->where('status', 1)
                    ->where('user_id', '<>', 1)
                    ->latest()
                    ->get();
      // foreach ($ideas as $idea) {
      //   foreach ($idea->users as $user) {
      //     if($user->id == Auth::user()->id){
      //         $idea['liked'] = 1;
      //     } else {
      //         $idea['liked'] = 0;
      //     }
      //   }
      // }
      return $ideas;
    }

    public function index()
    {
        return view('app');
    }

    public function bookmark(Idea $idea){
        auth()->user()->toggleBookmark($idea);
        return back();
    }

    public function like(Idea $idea){
      $idea->toggleLikes(Auth::user());
      $idea->update([
        'likes' => count($idea->users),
        'liked' => 1
      ]);
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
      // dd($request);
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'required|integer',
            'image' => 'nullable|sometimes|mimes:jpeg,jpg,png|max:2048',
            'video' => 'file'
          ]);
          if(request('image')){

            $attributes['image'] = request('image')->store('covers');
           } 
           else {
            $attributes['image'] = null;
        }
      //   if(request('video')){

      //     $attributes['video'] = request('video')->store('covers');
      //    } 
      // else {
      //     $attributes['video'] = null;
      // }
          
        $idea = Idea::create([
            'user_id' => Auth::user()->id,
            'category_id' => $attributes['category'],
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'image' => $attributes['image'],
            // 'image' => $attributes['video'],
            'status' => 0
        ]);
  
        
           
  
        // $idea->categorie()->associate($request->categorie);
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
          $idea->update([
            'user_id' => Auth::user()->id,
            'category_id' => $attributes['category_id'],
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            // 'image' => $attributes['image'],
          ]);
        }

        public function delete(Idea $idea){
          $idea->delete();
        }
}