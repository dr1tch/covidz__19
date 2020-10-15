<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
// use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Http\Controllers\Auth;
use App\Models\Reports;
use App\Models\Wilaya;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    // use HasApiTokens, Notifiable, HasFactory;
    use HasFactory, Notifiable;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bio', 'username', 'fname','lname', 'email', 'avatar', 'password','gender', 'birth_date', 'role', 'profession', 'wilaya'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ideas(){
        return $this->hasMany(Idea::class)->latest();
    }

    public function reports(){
        return $this->hasMany(Reports::class)->latest();
    }

    public function wilaya(){
        return $this->belongsTo(Wilaya::class);
    }

    public function disease(){
        return $this->belongsTo(Disease::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function addBookmark(Idea $idea){
        return $this->bookmarks()->attach($idea->id);
      }
  
      public function removeBookmark(Idea $idea){
        return $this->bookmarks()->attach($idea->id);
      }
  
      public function toggleBookmark(Idea $idea){
        return $this->bookmarks()->toggle($idea);
      } 

    public function bookmarks(){
        return $this->belongsToMany(Idea::class, 'ideas_bookmarks', 'user_id', 'idea_id')->withTimeStamps();
    }

    // public function addLike(Idea $idea){
    //     return $this->likes()->attach($idea->id);
    //   }
  
    //   public function removeLike(Idea $idea){
    //     return $this->likes()->attach($idea->id);
    //   }
  
    //   public function toggleLikes(Idea $idea){
    //     return $this->likes()->toggle($idea);
    //   } 

    // public function likes(){
    //     return $this->belongsToMany(Idea::class, 'idea_likes', 'user_id', 'idea_id')->withTimeStamps();
    // }
}
