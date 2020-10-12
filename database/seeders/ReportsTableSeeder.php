<?php

namespace Database\Seeders;

use App\Models\Reports;
use Illuminate\Database\Seeder;

class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reports::factory()->count(40)->create();
    }
}
