<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Auth;

class PublicationController extends Controller
{
    public function index(){
        return view('app');
    }

    public function data(){
        return Publication::with('wilayas')
                            ->with('jobs')
                            ->with('diseases')
                            ->latest()->get();
    }
    public function bookmark(Publication $publication){
        auth()->user()->togglePubBookmark($publication);
        return back();
    }

    public function like(Publication $publication){
      $publication->toggleLikes(Auth::user());
      // $idea->update([
      //   'likes' => count($idea->users),
      // ]);
        return back();
    }

    public function getPubsBookmarks(){
        return Auth::user()->pubBookmarks;
      }
  

}
