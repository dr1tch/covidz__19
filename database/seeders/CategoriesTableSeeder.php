<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $cat1 = Category::create(["name" => "Economie"]);
        $cat2 = Category::create(["name" => "Sante"]);
        $cat3 = Category::create(["name" => "Web"]);
        $cat4 = Category::create(["name" => "Confinement"]);
        $cat5 = Category::create(["name" => "Etudes"]);
        $cat6 = Category::create(["name" => "Work from Home"]);
        $cat7 = Category::create(["name" => "Competences"]);
        $cat8 = Category::create(["name" => "Famille"]);
        $cat9 = Category::create(["name" => "Communication"]);
    }
}
