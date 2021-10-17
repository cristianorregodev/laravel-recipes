@extends('layouts.app')


@section('content')

    <article class="contenido-receta mb-5 bg-white p-5 shadow">
        <h1 class="text-center mb-5">{{$receta->title}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{$receta->image}}" alt="{{$receta->title}}" class="w-100">
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
                <a class="text-dark" href="{{route('categorias.show', ['Category' => $receta->category->id])}}"> {{$receta->category->name}}</a>
               
            </p>

            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                <a class="text-dark" href="{{route('perfiles.show', ['profile' => $receta->autor])}}">{{$receta->autor->name}}</a>
            </p>

            <p>
                <span class="font-weight-bold text-primary">Fecha:</span>
                
                @php
                    $fecha =$receta->created_at
                @endphp
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </p>
            

            <div class="ingredientes">
                <h2 class="my-3 text-primary">Ingredientes</h2>

                {!!$receta->ingredients!!}
            </div>

            <div class="preparacion">
                <h2 class="my-3 text-primary">Preparación</h2>

                {!!$receta->preparation!!}
            </div>

            

            <div class="justify-content-center row text-center mt-3">
                <like-button 
                    receta-id="{{$receta->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}">
                </like-button>
            </div>
            
        </div>
    </article>

@endsection