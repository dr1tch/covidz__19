<?php

namespace App\Models;
use App\Models\User;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function user(){
      return $this->belongsTo(User::class);
    }

    public function category(){
    	return $this->belongsTo(Category::class);
    }
    
    public function tags()
    {
    	return $this->hasMany(Tag::class);
    }
    // public function likes(){
    //     return $this->belongsToMany(Like::class);
    // }

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
      return $this->belongsToMany(User::class, 'idea_likes', 'idea_id', 'user_id')->withTimeStamps();
  }
}
