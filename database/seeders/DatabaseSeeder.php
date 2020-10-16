<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        
        //disable foreign key check for this connection before running seeders
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    	// $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(IdeasTableSeeder::class);
        $this->call(WilayasTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(DiseaseTableSeeder::class);
        $this->call(JobTableSeeder::class);
        $this->call(PublicationsTableSeeder::class);
        $this->call(ReportsTableSeeder::class);
        // supposed to only apply to a single connection and reset it's self
        // but I like to explicitly undo what I've done for clarity
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
