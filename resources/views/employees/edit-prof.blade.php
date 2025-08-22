<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <form action="{{ route('employees.update', ['employee' => $editedEmployee->id, 'cat' => $cat]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-border-style me-1"></i> Informations Administratives
                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <div>
                            <div>
                                <label class="col-form-label mt-4" for="sl_edit_service_entity_id">Service</label>
                                <select name="service_entity_id" class="form-control" id="sl_edit_service_entity_id" >
                                    <option value="0"> ------ Séléctionnez le service </option>
                                    @if ($service_entity_id != null)
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
                            <label class="col-form-label mt-4" for="sl_edit_entity_id">Entité</label>
                            <select name="entity_id" class="form-control" id="sl_edit_entity_id" >
                                <option value="0"> ------ Séléctionnez l'entité </option>
                                @if ($entity_id != null)
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
                                    @foreach($secters as $secter)
                                        <option value="{{$secter->id}}">{{$secter->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if (count($sections) != 0)
                            <div>
                                <label class="col-form-label mt-4" for="section_entity_id">Section</label>
                                <select name="section_entity_id" class="form-control" id="section_entity_id" >
                                    <option value="0"> ------ Séléctionnez la section </option>
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="mt-2">
                            <input type="hidden" value="{{$editedEmployee->id}}" id="hid_employee_id">
                            Voulez vous vraiment modifier les informations personnelles
                            <x-button type="submit" class="btn btn-sm btn-primary" text="OUI" />
                            <a class="btn btn-sm btn-danger" href="{{route('employees.show', $editedEmployee->id)}}">NON</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <i class="bi bi-info-circle"></i>
                        Informations professionnelles
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <table class="table table-light table-striped border-0 shadow-lg">
                        <tr>
                            <th> PPR </th>
                            <td> {{$editedEmployee->ppr}} </td>
                        </tr>
                        <tr>
                            <th> Prénom </th>
                            <td> {{$editedEmployee->firstname}} </td>
                        </tr>
                        <tr>
                            <th> Nom  </th>
                            <td> {{$editedEmployee->lastname}}</td>
                        </tr>
                        <tr>
                            <th> Email </th>
                            <td> {{$editedEmployee->email}} </td>
                        </tr>
                        <tr>
                            <th> N° de Téléphone  </th>
                            <td> {{$editedEmployee->tel}} </td>
                        </tr>
                        <tr>
                            <th> Local  </th>
                            <td> {{$editedEmployee->local->title}} </td>
                        </tr>
                        <tr>
                            <th> Ville  </th>
                            <td> {{$editedEmployee->local->city->title}} </td>
                        </tr>
                    </table>
                    <table class="table table-light table-striped border-0 shadow-lg">
                        <tr>
                            <th> Service </th>
                            <td> {{$editedEmployee->service_entity->title}} </td>
                        </tr>
                        @if(!is_null($editedEmployee->entity))
                            <tr>
                                <th> Entité </th>
                                <td> {{$editedEmployee->entity->title}} </td>
                            </tr>
                        @endif
                        @if(!is_null($editedEmployee->secter_entity))
                            <tr>
                                <th> Secteur  </th>
                                <td> {{$editedEmployee->secter_entity->title}}</td>
                            </tr>
                        @endif
                        @if(!is_null($editedEmployee->section_entity))
                            <tr>
                                <th> Section </th>
                                <td> {{$editedEmployee->section_entity->title}} </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-layout>
