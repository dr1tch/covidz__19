<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Disease;
use App\Models\Job;
use App\Models\Idea;
use App\Models\Wilaya;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {            
        return view('app');
    }

    public function getData(){
        
        $users = User::where('username',"<>" , '4dm1n')->get();
        $users =  $users->except(6);
        $user = Auth::user();
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
        $role = $user->role;
        if($user->role){
            $role = 'admin';
        }
        if(!$user->role){
            $role = 'user';
        }
        $authCheck = Auth::check();
        $data =  [
            "user" => $user,
            "role" => $role,
            "auth" =>  $authCheck,
            "users" => $users,
            "categories" => Category::all(),
            'jobs' => Job::all(),
            // 'likes' => $likes,
            'diseases' => Disease::all(),
            "wilayas" => Wilaya::all(),
            "bookmarks" => $bookmarks,
        ];
        return $data;
        }
    
}
