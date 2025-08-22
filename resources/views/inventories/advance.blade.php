<x-layout>
    <div class="card border-primary mb-3 shadow">
            <h5 class="card-header border-primary">
                <a class="text-primary" href="{{route('inventories.index')}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
                Filtrage Avancée

                <a href="{{route('inventories.advance')}}" class="btn btn-sm btn-light float-end" title="Actualiser" ><i class="bi bi-repeat"></i></a>

                <a class="btn btn-sm btn-success me-2 float-end" href="{{route('inventories.export.filter', ['filter'=>$filter, 'value'=>$value])}}" >
                    <i class="bi bi-download me-1"></i> Télécharger l'inventaire filtré
                </a>
            </h5>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <h5>
                                    <i class="bi bi-filter"></i>
                                    <i class="bi bi-pc"></i>
                                    <i class="bi bi-printer"></i>
                                    Filtrage par les options d'un matériel
                                </h5>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                            <div class="accordion-body">
                                <div class="card border-primary mb-3 shadow">
                                    <div class="card-body">
                                        <div class="row col-12">
                                            <div class="col-3">
                                                <div class="card border-primary mb-3 shadow">
                                                    <div class="card-header">
                                                        Type
                                                    </div>
                                                    <div class="card-body">
                                                        <select class="form-control" id="inv_adv_type_material_id" name="adv_type_material_id">
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
                                                        <select class="form-control" id="inv_adv_brand_material_id" name="adv_brand_material_id">
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
                                                        <select class="form-control" id="inv_adv_model_material_id" name="adv_model_material_id">
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
                                                        <select class="form-control" id="inv_adv_march_material_id" name="adv_march_material_id">
                                                            <option value="0"  > ------ Séléctionnez le marché du matériel</option>
                                                            @foreach($marchs as $march)
                                                                <option {{$march_id == $march->id ? 'selected' : ''}} value="{{$march->id}}">{{$march->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row col-12 mt-2">
                                            <div class="col-6">
                                                <div>
                                                    <x-input-text
                                                        label="Série"
                                                        name="sr"
                                                        class="form-control"
                                                        placeholder="Série du matériel informatique"
                                                        id="inv_adv_search_serial"
                                                        value="{{$searchedSerial ?? ''}}"
                                                    />
                                                </div>
                                                <div class="mt-2">
                                                    <x-button type="submit" class="btn btn-sm btn-primary" text="Trouver" id="btn_inv_adv_search" />
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card border-primary mb-3 shadow">
                                                    <div class="card-header">
                                                        Etats d'équipement
                                                    </div>
                                                    <div class="card-body">
                                                        <select class="form-control" id="inv_adv_state_material_id" name="adv_march_material_id">
                                                            <option value="0"  > ------ Séléctionnez le marché du matériel</option>
                                                            <option {{$stateValue == 1 ? 'selected' : ''}} value="1"  > Opérationnel </option>
                                                            <option {{$stateValue == -1 ? 'selected' : ''}} value="-1"  > En Panne </option>
                                                            <option {{$stateValue == -2 ? 'selected' : ''}} value="-2"  > En casse </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <h5>
                                    <i class="bi bi-filter"></i>
                                    <i class="bi bi-people"></i>
                                    <i class="bi bi-diagram-3"></i>
                                    Filtrage par les entités administrative
                                </h5>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="card-body shadow">
                                    <div class="row col-12">
                                        <div class="col-6">
                                            <x-input-text
                                                label="PPR, Prénom ou Nom"
                                                name="fltr"
                                                class="form-control"
                                                placeholder="PPR, Prénom ou Nom"
                                                id="inv_adv_filtr_employee"
                                                value="{{$filterValue ?? ''}}"
                                            />
                                            <x-button type="submit" class="btn btn-sm btn-primary mt-2" text="Trouver" id="btn_inv_adv_filtr_employee" />
                                        </div>
                                        <div class="col-6">
                                            <div>
                                                <label class="col-form-label mt-4" for="emp_rech_local_id">Local</label>
                                                <select name="local_id" class="form-control" id="inv_emp_rech_local_id" >
                                                    <option value="0"> ------ Séléctionnez le local </option>
                                                    @if (is_null($selectedLocal))
                                                        @foreach($locals as $local)
                                                            <option value="{{$local->id}}">{{$local->title}}</option>
                                                        @endforeach
                                                    @else
                                                        @foreach($locals as $local)
                                                            <option {{$selectedLocal == $local->id ? 'selected' : ''}} value="{{$local->id}}">{{$local->title}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row col-12">
                                        <div class="col-3">
                                            <label class="col-form-label mt-4" for="inv_emp_rech_sl_service_entity_id">Service</label>
                                            <select name="service_entity_id" class="form-control" id="inv_emp_rech_sl_service_entity_id" >
                                                <option value="0"> ------ Séléctionnez le service </option>
                                                @if(is_null($selectedService))
                                                    @foreach($services as $service)
                                                        <option value="{{$service->id}}">{{$service->title}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($services as $service)
                                                        <option {{$selectedService == $service->id ? 'selected' : ''}} value="{{$service->id}}">{{$service->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label mt-4" for="emp_rech_sl_entity_id">Entité</label>
                                            <select name="entity_id" class="form-control" id="inv_emp_rech_sl_entity_id" >
                                                <option value="0"> ------ Séléctionnez l'entité </option>
                                                @if (is_null($selectedEntity))
                                                    @foreach($entities as $entity)
                                                        <option value="{{$entity->id}}">{{$entity->title}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($entities as $entity)
                                                        <option {{$selectedEntity == $entity->id ? 'selected' : ''}} value="{{$entity->id}}">{{$entity->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label mt-4" for="emp_rech_secter_entity_id">Secteurs</label>
                                            <select name="secter_entity_id" class="form-control" id="inv_emp_rech_secter_entity_id" >
                                                <option value="0"> ------ Séléctionnez le secteur </option>
                                                @if (is_null($selectedSecter))
                                                    @foreach($secters as $secter)
                                                        <option value="{{$secter->id}}">{{$secter->title}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($secters as $secter)
                                                        <option {{$selectedSecter == $secter->id ? 'selected' : ''}} value="{{$secter->id}}">{{$secter->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="col-form-label mt-4" for="emp_rech_section_entity_id">Section</label>
                                            <select name="section_entity_id" class="form-control" id="inv_emp_rech_section_entity_id" >
                                                <option value="0"> ------ Séléctionnez la section </option>
                                                @if (is_null($selectedSection))
                                                    @foreach($sections as $section)
                                                        <option value="{{$section->id}}">{{$section->title}}</option>
                                                    @endforeach
                                                @else
                                                    @foreach($sections as $section)
                                                        <option {{$selectedSection == $section->id ? 'selected' : ''}} value="{{$section->id}}">{{$section->title}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="mt-4">
        @if (!is_null($inventories))
            <x-inventory-row :inventories="$inventories" />
            <x-pagination-row :data="$inventories" />
        @endif
    </div>
</x-layout>
