<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Idea;
class Tag extends Model
{
    use HasFactory;
    public function ideas()
    {
    	return $this->belongsToMany(Idea::class);
    }
}
