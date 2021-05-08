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

    <article class="contenido-receta mb-5">
        <h1 class="text-center mb-3">{{$receta->title}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{$receta->image}}" alt="{{$receta->title}}" class="w-100">
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrito en:</span>
                {{$receta->category->name}}
            </p>

            <p>
                <span class="font-weight-bold text-primary">Autor:</span>
                {{$receta->autor->name}}
            </p>

            <p>
                <span class="font-weight-bold text-primary">Fecha:</span>
                
                @php
                    $fecha =$receta->created_at
                @endphp
                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </p>
            

            <div class="ingredientes">
                <h2 class="my-3 text-primary">Preparación</h2>

                {!!$receta->preparation!!}
            </div>

            <div class="preparacion">
                <h2 class="my-3 text-primary">Ingredientes</h2>

                {!!$receta->ingredients!!}
            </div>

            <div class="justify-content-center row text-center">
                <like-button 
                    receta-id="{{$receta->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}">
                </like-button>
            </div>
            
        </div>
    </article>

@endsection