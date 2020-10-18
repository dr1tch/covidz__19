<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\type;

class PublicationController extends Controller
{
    public function index(){
        return view('app');
    }
    public function get(){
        // $data = array();
        $pubs = Publication::latest()->paginate(4);
        foreach ($pubs as $pub) {
            $jobs = $pub->jobs;
            $pub['jobs'] = $jobs;

            $wilayas = $pub->wilayas;
            $pub['wilayas'] = $wilayas;

            $diseases = $pub->diseases;
            $pub['diseases'] = $diseases;
        }
        return $pubs;
    }
    public function store(Request $request){
        // dd($request);
        $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|sometimes|mimes:jpeg,jpg,png|max:2048',
            'video' => 'nullable|file',
            'source' => 'required|string',
            'wilayas' => 'required',
            'diseases' => 'required',
            'jobs' => 'required',
        ]);
        if(request('image')){
            $attributes['image'] = request('image')->store('covers/publications');
        } else {
            $attributes['image'] = null;
        }
            
        $pub = Publication::create([
            'user_id' => Auth::user()->id,
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'image' => $attributes['image'],
            'source' => $attributes['source']
        ]);

        // return[typeOf($attributes['wilayas']), typeOf($attributes['diseases']), typeOf($attributes['jobs'])];
        $wilayas = explode(",", $attributes['wilayas']);
        $pub->wilayas()->attach($wilayas);

        $jobs = explode(',', $attributes['jobs']);
        $pub->jobs()->attach($jobs);

        $diseases = explode(',', $attributes['diseases']);
        $pub->diseases()->attach($diseases);
        return $pub;
    }


    public function update(Publication $publication, Request $request){
         // dd($request);
         $attributes = request()->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|sometimes|mimes:jpeg,jpg,png|max:2048',
            'video' => 'nullable|file',
            'source' => 'required|string',
            'wilayas' => 'required',
            'diseases' => 'required',
            'jobs' => 'required',
        ]);
        if(request('image')){
            $publication->image = request('image')->store('covers/publications');
        }
        // } else {
        //     $attributes['image'] = null;
        // }
        
       
        $wilayas = explode(",", $attributes['wilayas']);
        // $newWilayas = array_diff($wilayas, $publication->wilayas->pluck('id'));
        $publication->wilayas()->detach();
        $publication->wilayas()->attach($wilayas);

        $jobs = explode(',', $attributes['jobs']);
        // $newJobs = array_diff($jobs, $publication->jobs->pluck('id'));
        $publication->jobs()->detach();
        $publication->jobs()->attach($jobs);

        $diseases = explode(',', $attributes['diseases']);
        // $newDiseases = array_diff($diseases, $publication->diseases->pluck('id'));
        $publication->diseases()->detach();
        $publication->diseases()->attach($diseases);


        $publication->update([
            'title' => $attributes['title'],
            'body' => $attributes['body'],
            'source' => $attributes['source']
        ]);

        return 'success';
    }
    public function delete(Publication $publication){
        $publication->diseases()->detach();
        $publication->wilayas()->detach();
        $publication->jobs()->detach();
        $publication->delete();
        return 'success';
    }

  
}
