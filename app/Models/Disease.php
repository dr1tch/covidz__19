<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Publication;

class Disease extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
    	return $this->hasMany(User::class);
    }
    public function publication()
    {
    	return $this->hasMany(Publication::class);
    }
}
