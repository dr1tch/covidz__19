<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Wilaya;


class Statistics extends Model
{
    use HasFactory;

    protected $fillable =['wilaya_id','cas_tot','deces_tot','gueris_tot','en_cours_soin','gueris_24h','deces_24h', 'date'];

	public function wilaya(){
		return $this->belongsTo(Wilaya::class);
	}
}
