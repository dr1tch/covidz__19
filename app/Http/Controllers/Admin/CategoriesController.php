<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{

    public function index()
    {
        return view('app');
    }

    public function store(Request $request)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $cat = Category::create([
            'name' => $attributes['catName'],
        ]);
        return "it's working";
    }


    public function get()
    {
        return Category::latest()->get();
    }

    public function update(Category $category)
    {
        $attributes = request()->validate([
            'catName' => 'required|max:25',
        ]);
        $category->update(['name' => $attributes["catName"]]);
        return $category;
    }


    public function delete(Category $category)
    {   

        $category->delete();
        return "done";
    }
    public function deleteAll()
    {
        Category::where('id', '>', 0)->delete();
        return "done";
    }

}
