<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' =>[ 'show', 'search']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$recetas = Auth::user()->recetas;
        $user = auth()->user();
        //Get recetas with model to paginate
        $recetas = Receta::where('user_id', $user->id)->paginate(10);
        return view('recetas.index', compact('recetas', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all(['id', 'name']);
        return view('recetas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validación
        $data = request()->validate([
            'title' => 'required|min:6',
            'preparation' => 'required',
            'ingredients' => 'required',
            'image' => 'required|image',
            'category' => 'required',
        ]);
        //Obtener ruta de imagen
        $image_route = $request['image']->store('uploads', 'public');

        //Image resize
        // $img = Image::make(public_path("storage/{$image_route}"))->fit(1000,550);
        // $img->save();

        //Guardar en DB con metodo DB sin modelo
        // DB::table('recetas')->insert([
        //     'title' => $data['title'],
        //     'preparation' => $data['preparation'],
        //     'ingredients' => $data['ingredients'],
        //     'image' => $image_route,
        //     'user_id' => Auth::user()->id,
        //     'category_id' => $data['category'],
        // ]);

        //Guardar en DB con metodo DB con modelo
        auth()->user()->recetas()->create([
            'title' => $data['title'],
            'preparation' => $data['preparation'],
            'ingredients' => $data['ingredients'],
            'image' => $image_route,
            'category_id' => $data['category'],
        ]);
        //Redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Gets the like if the running user has already liked
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Show the number of likes to view
        $likes = $receta->likes->count();


        return view('recetas.show', compact('receta', 'like', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit(Receta $receta)
    {
        //Cacth the policy
        $this->authorize('view', $receta);

        $categories = Category::all(['id', 'name']);
        return view('recetas.edit', compact('categories', 'receta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receta $receta)
    {
        //Agregar policy
        $this->authorize('update', $receta);

        //validación
        $data = $request->validate([
            'title' => 'required|min:6',
            'preparation' => 'required',
            'ingredients' => 'required',
            'category' => 'required',
        ]);

        $receta->title = $data['title'];
        $receta->preparation = $data['preparation'];
        $receta->ingredients = $data['ingredients'];
        $receta->category_id = $data['category'];

        //Imagen nueva
        if(request('image'))
        {
            //Obtener ruta de imagen
            $image_route = $request['image']->store('uploads', 'public');

            //Image resize
            $img = Image::make(public_path("storage/{$image_route}"))->fit(1000,550);
            $img->save();

            //Asignar al objeto

            $receta->image = $image_route;
        }
        $receta->save();

        //Redireccionar
        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receta $receta)
    {
        //Agregar policy
        $this->authorize('delete', $receta);

        //Eliminar receta
        $receta->delete();

        //Redireccionar
        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request)
    {
        $search = $request['search'];
        $recetas = Receta::where('title', 'like', '%' . $search . '%')->paginate(10);
        $recetas->appends(['search' => $search]);

        return view('busquedas.show', compact('recetas', 'search'));
    }
}
