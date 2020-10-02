<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Idea;
class IdeasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idea::factory()->count(40)->create();
    }
}
