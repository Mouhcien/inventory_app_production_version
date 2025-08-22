<x-layout>
    <div class="row col-12">
        <div class="card border-primary shadow">
            <h3 class="card-header">
                <a class="text-primary" href="{{route('materials.index')}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
                Filtrage Avancée
            </h3>
            <div class="card-body">
                <div class="row col-12">
                    <div class="col-3">
                        <div class="card border-primary mb-3 shadow">
                            <div class="card-header">
                                Type
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="adv_type_material_id" name="adv_type_material_id">
                                    <option value="0"  > ------ Séléctionnez le type du matériel</option>
                                    @foreach($types as $type)
                                        <option {{$type_id == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-primary mb-3 shadow">
                            <div class="card-header">
                                Marque
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="adv_brand_material_id" name="adv_brand_material_id">
                                    <option value="0"  > ------ Séléctionnez la marque du matériel</option>
                                    @foreach($brands as $brand)
                                        <option {{$brand_id == $brand->id ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-primary mb-3 shadow">
                            <div class="card-header">
                                Modèle
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="adv_model_material_id" name="adv_model_material_id">
                                    <option value="0"  > ------ Séléctionnez le modèle du matériel</option>
                                    @foreach($models as $model)
                                        <option {{$model_id == $model->id ? 'selected' : ''}} value="{{$model->id}}">{{$model->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card border-primary mb-3 shadow">
                            <div class="card-header">
                                Marché
                            </div>
                            <div class="card-body">
                                <select class="form-control" id="adv_march_material_id" name="adv_march_material_id">
                                    <option value="0"  > ------ Séléctionnez le marché du matériel</option>
                                    @foreach($marchs as $march)
                                        <option {{$march_id == $march->id ? 'selected' : ''}} value="{{$march->id}}">{{$march->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="row col-12">
                        <div class="col-6">
                            <form action="{{route('materials.advance')}}" method="GET">
                                @csrf
                                <div>
                                    <x-input-text
                                        label="Série"
                                        name="sr"
                                        class="form-control"
                                        placeholder="Série du matériel informatique"
                                        id="serial"
                                        value="{{$searchedSerial ?? ''}}"
                                    />
                                </div>
                                <div class="mt-2">
                                    <x-button type="submit" class="btn btn-sm btn-primary" text="Trouver" />
                                    <a href="{{route('materials.advance')}}" class="btn btn-sm btn-light" title="Actualiser" ><i class="bi bi-repeat"></i></a>
                                </div>
                            </form>
                        </div>
                        <div class="col-6">
                            <div class="card border-primary mb-3 shadow">
                                <div class="card-header">
                                    Etats d'équipement
                                </div>
                                <div class="card-body">
                                    <select class="form-control" id="adv_state_material_id" name="adv_state_material_id">
                                        <option value="0"  > ------ Séléctionnez les matériels</option>
                                        <option {{$stateValue == 1 ? 'selected' : ''}} value="1"  > Opérationnel </option>
                                        <option {{$stateValue == -1 ? 'selected' : ''}} value="-1"  > En Panne </option>
                                        <option {{$stateValue == -2 ? 'selected' : ''}} value="-2"  > En casse </option>
                                        <option {{$stateValue == 3 ? 'selected' : '' }} value="3" >Vacants</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="card border-primary mb-3 shadow">
            @if (!is_null($materials))
                <div class="card-header">
                    <div class="row col-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <i class="bi bi-clipboard-check me-1"></i> Les matériels <span class="badge bg-primary">Total : {{$materials->total()}}</span>
                            </h5>
                        </div>
                        <div class="col-6" >
                            <a class="text-info" href="{{route('materials.export')}}" >
                                <i class="bi bi-download me-1"></i> Télécharger les matériels trouvés
                            </a>
                            <a class="btn btn-sm btn-primary float-end" href="{{route('materials.create')}}" > <i class="bi bi-clipboard-plus me-1"></i> Nouveau Matériel </a>
                        </div>
                    </div>

                </div>
                <div class="card-body shadow">
                    <x-material-row :materials="$materials" />
                    <x-pagination-row :data="$materials" />
                </div>
            @endif
        </div>
    </div>
</x-layout>
