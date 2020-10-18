<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class PublicationController extends Controller
{
    public function index(){
        return view('app');
    }

    public function data(){

        $pubs = Publication::with('wilayas')
                            ->with('jobs')
                            ->with('diseases')
                            ->with('users')
                            ->whereHas('wilayas', function($q){
                                $q->where('wilaya_id',Auth::user()->wilaya_id);
                            })
                            ->orWhereHas('jobs', function($q){
                                $q->where('job_id',Auth::user()->job_id);
                            })
                            ->orWhereHas('diseases', function($q){
                                $q->where('disease_id',Auth::user()->disease_id);
                            })
                            ->latest()
                            ->get();
        // return [ "pubs" => ,
        //         'user' => Auth::user()
        //     ];
            foreach ($pubs as $idea) {
                foreach ($idea->users as $user) {
                  if($user->id == Auth::user()->id){
                      $idea['liked'] = 1;
                  } else {
                      $idea['liked'] = 0;
                  }
                }
              }
        return [ "pubs" => $pubs,
                'user' => Auth::user()
            ];
    }

    public function afterLike(){

        $pubs = Publication::with('wilayas')
                            ->with('jobs')
                            ->with('diseases')
                            ->with('users')
                            ->whereHas('wilayas', function($q){
                                $q->where('wilaya_id',Auth::user()->wilaya_id);
                            })
                            ->orWhereHas('jobs', function($q){
                                $q->where('job_id',Auth::user()->job_id);
                            })
                            ->orWhereHas('diseases', function($q){
                                $q->where('disease_id',Auth::user()->disease_id);
                            })
                            ->latest()->get();
        // return [ "pubs" => ,
        //         'user' => Auth::user()
        //     ];
            foreach ($pubs as $idea) {
                foreach ($idea->users as $user) {
                  if($user->id == Auth::user()->id){
                      $idea['liked'] = 1;
                  } else {
                      $idea['liked'] = 0;
                  }
                }
              }
        return [ "pubs" => $pubs,
                'user' => Auth::user()
            ];
    }

    public function getOrder(Request $request){
        request()->validate([
            'wilaya' => 'nullable|integer',
            'disease' => 'nullable|integer',
            'job' => 'nullable|integer',
        ]);
        return Publication::with('wilayas')
                            ->with('jobs')
                            ->with('diseases')
                            ->with('users')
                            ->whereHas('wilayas', function($q){
                                $q->where('wilaya_id', request('wilaya'));
                            })
                            ->orWhereHas('jobs', function($q){
                                $q->where('job_id', request('job'));
                            })
                            ->orWhereHas('diseases', function($q){
                                $q->where('disease_id', request('disease'));
                            })
                            ->latest()->get();
    }

    public function bookmark(Publication $publication){
        auth()->user()->togglePubBookmark($publication);
        return back();
    }

    public function like(Publication $publication){
      $publication->toggleLikes(Auth::user());
      $publication->update([
        'likes' => count($publication->users),
        'liked' => 1
      ]);
        return back();
    }

    public function getPubsBookmarks(){
        return Auth::user()->pubBookmarks;
      }


    public function getGuest(){
            return Publication::with('wilayas')
                                ->with('jobs')
                                ->with('diseases')
                                ->with('users')
                                ->latest()
                                ->get();
    }
  

}
