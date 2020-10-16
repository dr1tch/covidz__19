<?php

namespace App\Models;
use App\Models\User;
use App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function user(){
        return $this->hasMany(User::class);
    }

    public function publications()
    {
        return $this->belongsToMany(Publication::class);
    }
}
