<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function index(){
        return view('app');
    }

    public function store(Request $request){
        // dd($request);
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category' => 'required|integer',
            'image' => 'nullable|sometimes|mimes:jpeg,jpg,png|max:2048',
            'video' => 'nullable|file',
            'source' => ,
            'wilaya' => 'required|integer',
            'disease' => 'required|integer',
            'job' => 'required|integer',
        ]);
        if(request('image')){
            $attributes['image'] = request('image')->store('covers');
        } else {
            $attributes['image'] = null;
        }
            
        $pub = Publication::create([
            'user_id' => Auth::user()->id,
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'image' => $attributes['image'],
            
            'status' => 0
        ]);
    }
}
