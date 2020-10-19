<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    
    public function index()
    {
        return view('app');
    }
    
    
    public function store(Request $request)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $cat = Job::create([
            'name' => $attributes['catName'],
        ]);
        return "it's working";
    }


    public function get()
    {
        return Job::latest()->get();
    }

    public function update(Job $job)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $job->update(['name' => $attributes["catName"]]);
        return $job;
    }


    public function delete(Job $job)
    {
        $job->delete();
        return "done";
    }
    public function deleteAll()
    {
        Job::where('id', '>', 0)->delete();
        return "done";
    }

}
