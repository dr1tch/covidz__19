<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Disease;
use Illuminate\Http\Request;
use App\Models\Idea;
use App\Models\Job;
use App\Models\Publication;
use App\Models\Wilaya;

class AppController extends Controller
{
    public function get() {
        return view('app');
      }
    public function data(){
      return [
          'ideas' => Idea::where('status', 1)->orderBy('likes', 'desc')->latest()->get(),
          'categories' => Category::all(),
          'wilayas' => Wilaya::all(),
          'jobs' => Job::all(),
          'diseases' => Disease::all(),
          'pubs' => Publication::orderBy('likes', 'desc')->latest()->get(),
      ];
    }
    public function idee(){
      return view('app');
    }

    public function news(){
      return view('app');
    }
}
