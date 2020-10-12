<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Idea;
use App\Models\Reports;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function report(){
        return $this->hasMany(Reports::class);
    }

    public function idea()
    {
    	return $this->hasMany(Idea::class);
    }
}
