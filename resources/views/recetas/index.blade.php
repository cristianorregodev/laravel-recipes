@extends('layouts.app')

@section('buttons')
  
    @include('ui.nav')

@endsection

@section('content')
    <h2 class="text-center mt-5">Administra tus recetas</h2>

    <div class="col-md-10 mx-auto bg-white p-3 mb-5">
        <table class="table table-hover">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Nombre Receta</th>
                    <th scole="col">Categoría</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>{{$receta->title}}</td>
                        <td>{{$receta->category->name}}</td>
                        <td>
                            <eliminar-receta receta-id="{{$receta->id}}">
                                
                            </eliminar-receta>
                            <a href="{{route('recetas.edit', ['receta' => $receta->id])}}" class="btn btn-dark btn-sm d-block mt-1">
                                Editar
                            </a>
                            <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-success btn-sm d-block mt-1">
                                Ver
                            </a>
                        </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="col-12 mt-3 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>
        <div class="col-md-10 mx-auto bg-white p-3">
            @if(count($user->meGusta) > 0)
                <ul class="list-group">
                    @foreach($user->meGusta as $receta)
                        <li class="list-group-item d-flex justify-content-between align-item-center">
                            <p>{{$receta->title}}</p>
                            <a class="btn btn-outline-primary" href="{{route('recetas.show', ['receta' => $receta->id])}}">Ver Receta</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-center">Aún no le has dado Me Gusta a alguna receta.</p>
            @endif
        </div>
    </div>
@endsection