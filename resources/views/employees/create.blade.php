<x-layout>
    <form action="{{route('employees.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row col-12">
            <div class="col-6">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-border-style me-1"></i> Informations Administratives
                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <div>
                            <div>
                                <label class="col-form-label mt-4" for="sl_service_entity_id">Service</label>
                                <select name="service_entity_id" class="form-control" id="sl_service_entity_id" >
                                    <option value="0"> ------ Séléctionnez le service </option>
                                    @if ($editedEmployee != null)
                                        @foreach($services as $service)
                                            <option {{ $service->id == $editedEmployee->service_entity->id ? 'selected' : '' }} value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    @elseif($service_entity_id != null)
                                        @foreach($services as $service)
                                            <option {{ $service->id == $service_entity_id ? 'selected' : '' }} value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($services as $service)
                                            <option value="{{$service->id}}">{{$service->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="sl_entity_id">Entité</label>
                            <select name="entity_id" class="form-control" id="sl_entity_id" >
                                <option value="0"> ------ Séléctionnez l'entité </option>
                                @if ($editedEmployee != null && $editedEmployee->entity != null)
                                    @foreach($entities as $entity)
                                        <option {{ $entity->id == $editedEmployee->entity->id ? 'selected' : '' }} value="{{$entity->id}}">{{$entity->title}}</option>
                                    @endforeach
                                @elseif($entity_id != null)
                                    @foreach($entities as $entity)
                                        <option {{ $entity->id == $entity_id ? 'selected' : '' }} value="{{$entity->id}}">{{$entity->title}}</option>
                                    @endforeach
                                @else
                                    @foreach($entities as $entity)
                                        <option value="{{$entity->id}}">{{$entity->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        @if(count($secters) != 0)
                            <div>
                                <label class="col-form-label mt-4" for="secter_entity_id">Secteurs</label>
                                <select name="secter_entity_id" class="form-control" id="secter_entity_id" >
                                    <option value="0"> ------ Séléctionnez le secteur </option>
                                    @if ($editedEmployee != null && $editedEmployee->secter_entity != null)
                                        @foreach($secters as $secter)
                                            <option {{ $secter->id == $editedEmployee->secter_entity->id ? 'selected' : '' }} value="{{$secter->id}}">{{$secter->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($secters as $secter)
                                            <option value="{{$secter->id}}">{{$secter->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        @if (count($sections) != 0)
                            <div>
                                <label class="col-form-label mt-4" for="section_entity_id">Section</label>
                                <select name="section_entity_id" class="form-control" id="section_entity_id" >
                                    <option value="0"> ------ Séléctionnez la section </option>
                                    @if ($editedEmployee != null && $editedEmployee->section_entity != null)
                                        @foreach($sections as $section)
                                            <option {{ $section->id == $editedEmployee->section_entity->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="Enregister" />
                            <a href="{{route('employees.create')}}" class="btn btn-sm btn-light" ><i class="bi bi-repeat"></i></a>
                            <a href="{{route('employees.prepare')}}" class="text-decoration-none float-end text-info" ><i class="bi bi-upload"></i> Importer les employées depuis un fichier Excel</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-border-style me-1"></i> Informations Personnelles
                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <div>
                            <x-input-text
                                label="PPR"
                                name="ppr"
                                class="form-control"
                                placeholder="PPR"
                                id="employeePPR"
                                :value="$editedEmployee->ppr ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="Prénom"
                                name="firstname"
                                class="form-control"
                                placeholder="Prénom"
                                id="employeeFirstname"
                                :value="$editedEmployee->firstname ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="Nom"
                                name="lastname"
                                class="form-control"
                                placeholder="Nom"
                                id="employeeLastname"
                                :value="$editedEmployee->lastname ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="Email"
                                name="email"
                                class="form-control"
                                placeholder="Email"
                                id="employeeEmail"
                                :value="$editedEmployee->email ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="N° Téléphone"
                                name="tel"
                                class="form-control"
                                placeholder="N° Téléphone"
                                id="employeeTel"
                                :value="$editedEmployee->tel ?? ''"
                            />
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="local_id">Local</label>
                            <select name="local_id" class="form-control" id="local_id" >
                                <option value="0"> ------ Séléctionnez le local </option>
                                @if ($editedEmployee != null)
                                    @foreach($locals as $local)
                                        <option {{ $local->id == $editedEmployee->local->id ? 'selected' : '' }} value="{{$local->id}}">{{$local->title}}</option>
                                    @endforeach
                                @else
                                    @foreach($locals as $local)
                                        <option value="{{$local->id}}">{{$local->title}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</x-layout>

