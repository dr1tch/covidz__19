<?php

namespace Database\Seeders;

use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Publication::truncate();
        for($i = 0; $i < 30; $i++){
            $pub = Publication::factory()->create();
            $wilayas = array();
            // for($i = 1; $i<49; $i++){
            //     $wilayas.array_push($i);
            // }

            $jobs = array();
            // for($i = 1; $i<16; $i++){
            //     $jobs.array_push($i);
            // }

            $diseases = array();
            // for($i = 1; $i<20; $i++){
            //     $diseases.array_push($i);
            // }

            // for($i = 1; $i<random_int(1,5); $i++){
            //     $wilayas.array_push(random_int(1,48));
            //     $jobs.array_push(random_int(1, 15));
            //     $diseases.array_push(random_int(1, 19));
            // }

            $pub->wilayas()->attach([1,5,13,9,11]);
            $pub->jobs()->attach([1, 4, 12, 5,6]);
            $pub->diseases()->attach([5,8,3,7]);
        }   
    }
}
