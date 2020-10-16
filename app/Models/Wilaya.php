<?php

namespace App\Models;
use App\Models\Reports;
use App\Models\User;
use App\Models\Idea;
use App\Models\Publication;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report(){
        return $this->hasMany(Reports::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function idea(){
        return $this->hasMany(Idea::class);
    }
    public function publications()
    {
        return $this->belongsToMany(Publication::class);
    }
}
