<x-layout>

    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary ">
                <h3 class="card-header">
                    <a class="text-primary" href="{{route('materials.show', $material->id)}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
                    Changer les états du matériel
                </h3>
                <div class="card-body">
                    <form action="{{route('materials.change', $material->id)}}" method="POST">
                        @csrf
                        <div>
                            <label class="col-form-label mt-4" for="state">Nouvel état du matériel</label>
                            <select name="state" class="form-control" id="state" >
                                <option {{$material->state == 1 ? 'selected' : ''}} value="1">OK (Matériel est opérationnel)</option>
                                <option {{$material->state == -1 ? 'selected' : ''}} value="-1">En Panne </option>
                                <option {{$material->state == -2 ? 'selected' : ''}} value="-2">En Casse</option>
                            </select>
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="is_deployed">Nouvel état du déploiement </label>
                            <select name="is_deployed" class="form-control" id="is_deployed" >
                                <option {{!$material->is_deployed ? 'selected' : '' }} value="0">NON (Matériel pas encore déployé) </option>
                                <option {{$material->is_deployed ? 'selected' : ''}} value="1">OK (Matériel est déployé)</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-6">
            <div class="card border-primary mb-3">
                <h3 class="card-header">

                    {{$material->serial}}
                </h3>
                <div class="card-body">
                    <div class="row col-12" >
                        <div class="col-4 align-content-center">
                            <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="64" height="64" >
                            <span class="badge bg-light">{{$material->delivery_material->model_material->title}}</span>
                        </div>
                        <div class="col-4 align-content-center">
                            <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->brand_material->logo_data) }}" width="64" height="64">
                            <span class="badge bg-light">{{$material->delivery_material->model_material->brand_material->title}}</span>
                        </div>
                        <div class="col-4 align-content-center">
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
                            <span class="badge bg-warning">En Panne</span>
                    @elseif($material->state == -2)
                        <span class="badge bg-dark">En Casse</span>
                        @endif
                        </li>
                        <li class="list-group-item border-primary">
                            Déployé :
                            @if ($material->is_deployed)
                                <span class="badge bg-success">OUI</span>
                            @else
                                <span class="badge bg-danger">NON</span>
                        @endif
                        </li>
                </ul>

            </div>
        </div>
    </div>




</x-layout>
