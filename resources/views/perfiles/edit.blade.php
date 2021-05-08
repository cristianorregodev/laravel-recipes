@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" integrity="sha512-CWdvnJD7uGtuypLLe5rLU3eUAkbzBR3Bm1SFPEaRfvXXI2v2H5Y0057EMTzNuGGRIznt8+128QIDQ8RqmHbAdg==" crossorigin="anonymous" />
@endsection

@section('buttons')
    <a href="{{route('recetas.index')}}" class="btn btn-outline-primary mr-2 font-weight-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
        </svg>
        Volver
    </a>
@endsection

@section('content')
    <h1 class="text-center">Editar Perfil</h1>
    <div class="row justify-content-center m-5">
        <div class="col-md-10 bg-white">
            <form action="{{route('perfiles.update', ['profile' => $profile->id])}}"
                method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" 
                        name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        placeholder="Tu nombre" 
                        value="{{$profile->user->name}}"> 

                        @error('name')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror    
                </div>

                 <div class="form-group">
                    <label for="webpage">Sitio Web</label>
                    <input type="text" 
                        name="webpage" 
                        class="form-control @error('webpage') is-invalid @enderror" 
                        id="webpage" 
                        placeholder="Tu página web" 
                        value="{{$profile->user->webpage}}"> 

                        @error('webpage')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror    
                </div>

                <div class="form-group">
                    <label for="biography">Biografía</label>
                    <input type="hidden" name="biography" id="biography" value="{{$profile->biography}}">
                    <trix-editor input="biography" class="form-control @error('biography') is-invalid @enderror"></trix-editor>
                    @error('biography')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Tu imagen</label>
                    <input type="file" id="image" class="form-control  @error('image') is-invalid @enderror" name="image">
                    
                    @if($profile->image)
                        <div class="mt-4">
                            <p>Imagen actual:</p>
                            <img src="/storage/{{$profile->image}}" width="150px">
                        </div>

                        @error('image')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    @endif
                    
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Actualizar Perfil">
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.js" integrity="sha512-/1nVu72YEESEbcmhE/EvjH/RxTg62EKvYWLG3NdeZibTCuEtW5M4z3aypcvsoZw03FAopi94y04GhuqRU9p+CQ==" crossorigin="anonymous"defer></script>
@endsection