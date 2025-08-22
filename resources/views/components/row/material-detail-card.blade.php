
@props(['material'])

<div class="card border-primary mb-3">
    <h3 class="card-header">
        <a class="text-primary" href="{{route('materials.index')}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
        {{$material->serial}}
    </h3>
    <div class="card-body">
        <div class="row col-12" >
            <div class="col-6 align-content-center">
                <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="256" height="256" >
                <span class="badge bg-light">{{$material->delivery_material->model_material->title}}</span>
            </div>
            <div class="col-6 align-content-center">
                <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->brand_material->logo_data) }}" width="128" height="128">
                <span class="badge bg-light">{{$material->delivery_material->model_material->brand_material->title}}</span>

                <span class="badge bg-light">{{$material->delivery_material->model_material->type_material->title}}</span>
            </div>
        </div>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item border-primary"> N° d'inventaire : <span class="badge bg-light">{{$material->inventory_number}}</span></li>
        <li class="list-group-item border-primary"> Adresse IP : <span class="badge bg-light">{{$material->ip}}</span></li>
        <li class="list-group-item border-primary">
            Réformé :
            @if ($material->is_reform)
                <span class="badge bg-danger">OUI</span>
            @else
                <span class="badge bg-success">NON</span></li>
        @endif
        <li class="list-group-item border-primary">
            Etats :
            @if ($material->state == 1)
                <span class="badge bg-success">OK</span>
            @elseif($material->state == -1)
                <span class="badge bg-warning">En Panne</span></li>
        @elseif($material->state == -2)
            <span class="badge bg-dark">En Casse</span></li>
            @endif
            </li>
            <li class="list-group-item border-primary">
                Déployé :
                @if ($material->is_deployed)
                    <span class="badge bg-success">OUI</span>
                @else
                    <span class="badge bg-danger">NON</span></li>
            @endif
            </li>
    </ul>
    <div class="card-body border-primary">
        <a href="#" class="card-link text-dark"><i class="bi bi-file-word"></i> Les documents du matériels </a>
        <a href="{{route('materials.situation', $material->id)}}" class="card-link text-dark"><i class="bi bi-lock"></i> Changer la situation du matériel </a>
    </div>
    <div class="card-footer text-muted border-primary">
        <a href="{{route('observations.create', $material->id)}}" ><i class="bi bi-plus-square"></i></a>
        <a href="#" class="card-link text-dark"> Les obsérvations du matériels </a>
        <br>
        @if(count($material->observations_material) != 0)
            <ul>
                @foreach($material->observations_material as $observation)
                    <li class="text-info">
                            <span class="badge bg-info" >
                                <a class="text-decoration-none" href="#" >{{$observation->title}}</a>
                            </span>
                        <span class="badge bg-secondary">{{$observation->object}}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
