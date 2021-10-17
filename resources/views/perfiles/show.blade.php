@extends('layouts.app')


@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-5">
                @if($profile->image)
                    <img src="/storage/{{$profile->image}}" class="w-75 rounded-circle" alt="Imagen de perfil">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center text-primary">{{$profile->user->name}}</h2>
                <a href="{{$profile->user->url}}">Visitar Sitio Web</a>
                <div class="biography">
                    {!!$profile->biography!!}
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recetas creadas por: <span class="text-primary">{{$profile->user->name}}</span></h2>
    <div class="container">
        <div class="row mx-auto bg-white">
            @if(count($recetas) > 0)
                @foreach($recetas as $receta)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{$receta->image}}" alt="Imagen receta" class="card-img-top">
                            <div class="card-body">
                                <h3>{{$receta->title}}</h3>
                                <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-primary d-block font-weight-bold mt-4">Ver Receta</a>
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            @else
            <p class="text-center w-100">
                Este usuario aún no tiene recetas...
            </p>
            @endif
        </div>
        <div class="col-12 mt-3 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>
    </div>
@endsection