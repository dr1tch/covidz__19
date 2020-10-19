<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;

class DiseasesController extends Controller
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
        $cat = Disease::create([
            'name' => $attributes['catName'],
        ]);
        return "it's working";
    }


    public function get()
    {
        return Disease::latest()->get();
    }

    public function update(Disease $disease)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $disease->update(['name' => $attributes["catName"]]);
        return $disease;
    }


    public function delete(Disease $disease)
    {
        $disease->delete();
        return "done";
    }
    public function deleteAll()
    {
        Disease::where('id', '>', 0)->delete();
        return "done";
    }

}
