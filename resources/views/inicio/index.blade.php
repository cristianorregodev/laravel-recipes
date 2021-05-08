@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" 
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" 
    crossorigin="anonymous" />
@endsection

@section('content')
    
    <div class="container nuevas-recetas">
        <h2 class="titulo-categoria text-uppercase mt-3 mb-4">Últimas recetas</h2>
        <div class="owl-carousel owl-them">
            @foreach($latestRecetas as $receta)
            
                <div class="card">
                    <img class="car-img-top" src="/storage/{{$receta->image}}" alt="Imagen de receta">
                    <div class="card-body">
                        <h3>{{$receta->title}}</h3>

                        <p>{{Str::words(strip_tags($receta->preparation), 15)}}</p>

                        <a href="{{route('recetas.show', ['receta' => $receta->id])}}" 
                            class="btn btn-primary d-block font-weight-bold">
                            Ver Receta
                        </a>
                    </div>
                </div>
            
            @endforeach
        </div>
    </div>

        <div class="container mb-5">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">Recetas más votadas</h2>

            <div class="row">

                    @foreach($number_likes as $receta)
                        @include('ui.receta')
                    @endforeach

            </div>
        </div>

    @foreach($recetas as $key => $group)
        <div class="container mb-5">
            <h2 class="titulo-categoria text-uppercase mt-5 mb-4">{{str_replace('-', ' ', $key)}}</h2>

            <div class="row">
                @foreach($group as $recetas)
                    @foreach($recetas as $receta)
                        @include('ui.receta')
                    @endforeach
                @endforeach
            </div>
        </div>
    @endforeach
@endsection