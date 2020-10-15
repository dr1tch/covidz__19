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

    public function wilaya(){
        return $this->belongsTo(Wilaya::class);
    }

    public function job(){
        return $this->belongsTo(Job::class);
    }

    public function disease(){
        return $this->belongsTo(Disease::class);
    }

    public function user(){
        return $this->belongsTo(User::class)->latest();

    }

}
