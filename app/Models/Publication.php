<?php

namespace App\Models;

use App\Models\User;
use App\Models\Wilaya;
use App\Models\Job;
use App\Models\Disease;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function wilayas(){
        return $this->belongsToMany(Wilaya::class)->withTimestamps();
    }

    public function jobs(){
        return $this->belongsToMany(Job::class)->withTimestamps();
    }

    public function diseases(){
        return $this->belongsToMany(Disease::class)->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class)->latest();

    }

    public function addLike(User $user){
        return $this->users()->attach($user->id);
      }
  
      public function removeLike(User $user){
        return $this->users()->attach($user->id);
      }
  
      public function toggleLikes(User $user){
        return $this->users()->toggle($user);
      } 
  
    public function users(){
        return $this->belongsToMany(User::class, 'publications_likes', 'publication_id', 'user_id')->withTimeStamps();
    }

}
