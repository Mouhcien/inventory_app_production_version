<x-layout>
    <div class="card border-primary mb-3 shadow">
        <div class="card-header">
            <div class="row col-12">
                <div class="col-6">
                    <h5 class="card-title">
                        <a href="{{route('employees.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-search me-1"></i> Les options de la rechercher
                    </h5>
                </div>
                <div class="col-6">

                </div>
            </div>
        </div>
        <div class="card-body shadow">
            <div class="row col-12">
                <div class="col-4">
                    <form action="{{route('employees.search')}}" method="GET">
                        <x-input-text
                            label="PPR, Prénom ou Nom"
                            name="fltr"
                            class="form-control"
                            placeholder="PPR, Prénom ou Nom"
                            id="employeeLastname"
                            value="{{$filterValue ?? ''}}"
                        />
                        <x-button type="submit" class="btn btn-sm btn-primary mt-2" text="Trouver" />
                    </form>
                </div>
                <div class="col-4">
                    <div>
                        <label class="col-form-label mt-4" for="emp_rech_local_id">Local</label>
                        <select name="local_id" class="form-control" id="emp_rech_local_id" >
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
                <div class="col-4">
                    <label class="col-form-label mt-4" for="emp_rech_situation">Situation Administrative</label>
                    <select name="employee_situation" class="form-control" id="emp_rech_situation" >
                        <option value="0"> ------ Séléctionnez la situation </option>
                        <option value="1">Employé en poste</option>
                        <option value="-1">Employé retraité</option>
                        <option value="-2">Employé muté</option>
                    </select>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-3">
                    <label class="col-form-label mt-4" for="emp_rech_sl_service_entity_id">Service</label>
                    <select name="service_entity_id" class="form-control" id="emp_rech_sl_service_entity_id" >
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
                    <select name="entity_id" class="form-control" id="emp_rech_sl_entity_id" >
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
                    <select name="secter_entity_id" class="form-control" id="emp_rech_secter_entity_id" >
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
                    <select name="section_entity_id" class="form-control" id="emp_rech_section_entity_id" >
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

    @if  (!is_null($employees))
    <div class="card border-primary mb-3 shadow">
        <div class="card-header">
            <h5 class="card-title">
                <i class="bi bi-people-fill me-1"></i> Les employées trouvés
            </h5>
        </div>
        <div class="card-body">
            <x-employee-row :employees="$employees" />

            <x-pagination-row :data="$employees" />
        </div>
    </div>
    @endif
</x-layout>
