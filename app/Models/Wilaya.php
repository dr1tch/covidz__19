<?php

namespace App\Models;
use App\Models\Reports;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilaya extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function report(){
        return $this->belongsToMany(Reports::class);
    }
}
