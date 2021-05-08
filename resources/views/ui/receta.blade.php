<div class="col-md-4">
    <div class="card shadow">
        <img src="/storage/{{$receta->image}}" alt="Imagen de receta" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{$receta->title}}</h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha =$receta->created_at
                @endphp
                <p class="text-primary font-weight-bold">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>
                <p>{{count($receta->likes)}} Me gusta</p>
            </div>
            <p>{{Str::words(strip_tags($receta->preparation), 20)}}</p>

            <a href="{{route('recetas.show', ['receta' => $receta->id])}}" 
                class="btn btn-primary d-block font-weight-bold">
                Ver Receta
            </a>
        </div>
    </div>
</div>