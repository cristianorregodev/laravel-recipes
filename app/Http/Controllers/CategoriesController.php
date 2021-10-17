<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function show(Category $Category)
    {

        $recetas = Receta::where('category_id', $Category->id)->paginate(3);

        return view('categorias.show', compact('recetas', 'Category'));
    }
}
