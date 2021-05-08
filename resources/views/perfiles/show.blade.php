@extends('layouts.app')

@section('buttons')

    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 font-weight-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
        </svg>
        Volver
    </a>

@endsection

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