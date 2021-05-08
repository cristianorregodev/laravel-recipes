@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection
@section('buttons')

    <a href="{{route('recetas.index')}}" class="btn btn-primary mr-2 text-white">Volver</a>

@endsection

@section('content')
    <h2 class="text-center">Crear Nueva Receta</h2>

    <div class="row justify-content-center my-5">
        <div class="col-md-8">
            <form action="{{route('recetas.store')}}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="form-group">
                    <label for="title">Nombre Receta</label>

                    <input type="text" 
                    name="title" 
                    class="form-control @error('title') is-invalid @enderror" 
                    id="title" 
                    placeholder="Nombre de receta"
                    value="{{old('title')}}">
                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category">Categoría</label>
                    <select name="category" 
                    id="category" 
                    class="form-control @error('category') is-invalid @enderror">
                        <option value="">-- Selecione una Categoría --</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="preparation">Preparación</label>
                    <input type="hidden" name="preparation" id="preparation" value="{{old('preparation')}}">
                    <trix-editor input="preparation" class="form-control @error('preparation') is-invalid @enderror"></trix-editor>
                    @error('preparation')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ingredients">Ingredientes</label>
                    <input type="hidden" name="ingredients" id="ingredients" value="{{old('ingredients')}}">
                    <trix-editor input="ingredients" class="form-control @error('ingredients') is-invalid @enderror"></trix-editor>
                    @error('ingredients')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Elige una Imagen</label>
                    <input type="file" id="image" class="form-control  @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Editar Receta">
                </div>
            </form>
        </div>
    </div>
   
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"defer></script>
@endsection