<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::truncate();
        Disease::create(["name" => "Autre"]);
        Disease::create(["name" => "angine de poitrine"]);
        Disease::create(["name" => "insuffisance cardiaque"]);
        Disease::create(["name" => "insuffisance veineuse chronique"]);
        Disease::create(["name" => "Cancer"]);
        Disease::create(["name" => "acromégalie"]);
        Disease::create(["name" => "diabète"]);
        Disease::create(["name" => "maladie de Basedow"]);
        Disease::create(["name" => "mucoviscidose"]);
        Disease::create(["name" => "apnée du sommeil"]);
        Disease::create(["name" => "asthme"]);
        Disease::create(["name" => "sinusite chronique"]);
        Disease::create(["name" => " dermatite séborrhéique"]);
        Disease::create(["name" => "décollement de rétine"]);
        Disease::create(["name" => "drépanocytose"]);
        Disease::create(["name" => "tuberculose"]);
        Disease::create(["name" => "arthrose"]);
        Disease::create(["name" => "Troubles du rythme cardiaque"]);
        Disease::create(["name" => "Trouble de la vision (myopie, presbytie, astigmatisme)"]);
    }
}
