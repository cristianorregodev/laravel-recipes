<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        //Show recetas for number of likes
        $number_likes = Receta::withCount('likes')->orderBy('likes_count', 'DESC')->take(3)->get();

        //Get the newest recetas
        $latestRecetas = Receta::latest()->take(5)->get();

        // Get all gategories
        $categories = Category::all();
        
        //Group recetas for categories
        $recetas = [];
        foreach($categories as $category){
            $recetas[Str::slug($category->name)][] = Receta::where('category_id', $category->id)->take(3)->get();
        }

        return view('inicio.index', compact('latestRecetas', 'recetas', 'number_likes'));
    }
}
