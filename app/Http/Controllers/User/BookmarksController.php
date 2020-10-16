<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarksController extends Controller
{
    public function index(){
        return view('app');
    }

    public function getBookmarks(){
        $bookmarks = Auth::user()->bookmarks;
        // $likes = Idea::with('users')->where('status', 1)->get();
        foreach ($bookmarks as $bookmark) {
            //dd($bookmark->pivot->user_id);
            $bookUser = User::where('id', $bookmark->user_id)->first();
            $bookCategory = Category::where('id', $bookmark->category_id)->first();
            // dd($bookUser);
            $bookmark['user'] = $bookUser;
            $bookmark['category'] = $bookCategory;
        }
        return $bookmarks;
    }
}
