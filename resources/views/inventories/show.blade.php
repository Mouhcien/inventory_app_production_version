<x-layout>

    <div class="row col-12">
        <div class="col-6">
            <div class="card mb-3 border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <a href="{{route('inventories.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-pc"></i>
                        <i class="bi bi-printer"></i>
                        <i class="bi bi-laptop"></i>
                        <span class="badge bg-info"> Série :</span>
                        @if($inventory->material->state == 1)
                            <span class="badge bg-success shadow">{{$inventory->material->serial}}</span>
                        @endif
                        @if($inventory->material->state == -1)
                            <span class="badge bg-warning shadow">{{$inventory->material->serial}}</span>
                        @endif
                        @if($inventory->material->state == -2)
                            <span class="badge bg-danger shadow"> {{$inventory->material->serial}}</span>
                        @endif
                    </h5>
                </div>
                <div class="card-body border-primary text-center align-content-center">
                    <div class="row col-12 mt-2">
                        <div class="col-4 align-content-center"> <img src="data:image/png;base64,{{ base64_encode($inventory->material->delivery_material->model_material->brand_material->logo_data) }}" width="64" height="64"> </div>
                        <div class="col-8 align-content-center">
                            <img src="data:image/png;base64,{{ base64_encode($inventory->material->delivery_material->model_material->image_data) }}" width="128" height="128">
                        </div>
                    </div>

                </div>
                <div class="card-footer border-primary">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-primary">
                        <span class="badge bg-info">Modèle :</span>
                        <span class="badge bg-light shadow ">{{ $inventory->material->delivery_material->model_material->title }} </span>
                        </li>
                        <li class="list-group-item border-primary">
                        <span class="badge bg-info">Type :</span>
                        <span class="badge bg-light shadow ">{{ $inventory->material->delivery_material->model_material->type_material->title }} </span>
                        </li>
                        <li class="list-group-item border-primary">
                        <span class="badge bg-info">Marque :</span>
                        <span class="badge bg-light shadow">{{ $inventory->material->delivery_material->model_material->brand_material->title }} </span>
                        </li>
                        <li class="list-group-item border-primary">
                        <span class="badge bg-info">Marché :</span>
                        <span class="badge bg-light shadow"> {{ $inventory->material->delivery_material->march_material->title }}</span>
                        </li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info"> N° d'inventaire : </span>
                            <span class="badge bg-light">{{$inventory->material->inventory_number}}</span></li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Adresse IP : </span>
                            <span class="badge bg-light">{{$inventory->material->ip}}</span></li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Réformé : </span>
                            @if ($inventory->material->is_reform)
                                <span class="badge bg-danger">OUI</span>
                            @else
                                <span class="badge bg-success">NON</span>
                        </li>
                        @endif
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Etats : </span>
                            @if ($inventory->material->state == 1)
                                <span class="badge bg-success">OK</span>
                            @elseif($inventory->material->state == -1)
                                <span class="badge bg-warning">En Panne</span></li>
                            @elseif($inventory->material->state == -2)
                                <span class="badge bg-dark">En Casse</span></li>
                            @endif
                        </li>
                        <li class="list-group-item border-primary">
                                <span class="badge bg-info">Déployé : </span>
                                @if ($inventory->material->is_deployed)
                                    <span class="badge bg-success">OUI</span>
                                @else
                                    <span class="badge bg-danger">NON</span></li>
                               @endif
                        </li>
                        <li class="list-group-item border-primary">
                            @if(count($inventory->material->observations_material) != 0)
                                <ul>
                                    @foreach($inventory->material->observations_material as $observation)
                                        <li class="text-info">
                                            <span class="badge bg-info" >
                                                <a class="text-decoration-none" href="#" >{{$observation->title}}</a>
                                            </span>
                                            <span class="badge bg-secondary">{{$observation->object}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                Pas des observations !!!
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <i class="bi bi-people"></i>
                        <span class="badge bg-info">Employé : </span>
                        <span class="badge bg-success"> {{$inventory->employee->firstname}} </span> <span class="badge bg-success"> {{$inventory->employee->lastname}} </span>
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-primary">
                            @if($inventory->employee->secter_entity)
                                <span class="badge bg-info">Secteur : </span> <span class="badge bg-light">{{$inventory->employee->secter_entity->title}}</span> <br>
                            @endif
                            @if($inventory->employee->section_entity)
                                <span class="badge bg-info">Section : </span> <span class="badge bg-light">{{ $inventory->employee->section_entity->title }} </span><br>
                            @endif
                            @if($inventory->employee->entity)
                                <span class="badge bg-info">Entité : </span> <span class="badge bg-light">{{ $inventory->employee->entity->title }} </span><br>
                            @endif
                            <span class="badge bg-info">Service : </span> <span class="badge bg-light"> {{ $inventory->employee->service_entity->title }} </span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-primary">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">PPR :</span> <span class="badge bg-light"> {{ $inventory->employee->ppr }}</span>
                        </li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Email :</span> <span class="badge bg-light"> {{ $inventory->employee->email }}</span>
                        </li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Téléphone :</span> <span class="badge bg-light"> {{ $inventory->employee->tel }}</span>
                        </li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info">Local :</span> <span class="badge bg-light">{{ $inventory->employee->local->title ?? '' }} </span><br>
                        </li>
                        <li class="list-group-item border-primary">
                            <span class="badge bg-info"> Ville : </span> <span class="badge bg-light">{{ $inventory->employee->local->city->title ?? '' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-layout>
