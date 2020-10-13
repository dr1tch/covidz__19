<?php

namespace App\Models;
use App\Models\User;
use App\Models\Idea;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function idea(){
        return $this->belongsToMany(Idea::class);
    }
}
