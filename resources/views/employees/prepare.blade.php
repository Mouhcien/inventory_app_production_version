<x-layout>
    <form action="{{route('employees.import')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row col-12">
            <div class="col-6">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a href="{{route('employees.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                            <i class="bi bi-border-style me-1"></i> Informatiosn Administratives
                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <div>
                            <div>
                                <label class="col-form-label mt-4" for="sl_local_id_import">Local</label>
                                <select name="local_id" class="form-control" id="sl_local_id_import" >
                                    <option value="0"> ------ Séléctionnez le local </option>
                                    @if ($editedEmployee != null)
                                        @foreach($locals as $local)
                                            <option {{ $local->id == $editedEmployee->local->id ? 'selected' : '' }} value="{{$local->id}}">{{$local->title}}</option>
                                        @endforeach
                                    @elseif($local_id != null)
                                        @foreach($locals as $local)
                                            <option {{ $local->id == $local_id ? 'selected' : '' }} value="{{$local->id}}">{{$local->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($locals as $local)
                                            <option value="{{$local->id}}">{{$local->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div>
                                <label class="col-form-label mt-4" for="sl_service_entity_id_import">Service</label>
                                <select name="service_entity_id" class="form-control" id="sl_service_entity_id_import" >
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
                            <label class="col-form-label mt-4" for="sl_entity_id_import">Entité</label>
                            <select name="entity_id" class="form-control" id="sl_entity_id_import" >
                                <option value="0"> ------ Séléctionnez l'entité </option>
                                @if ($editedEmployee != null)
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
                        @if(count($secters))
                            <div>
                                <label class="col-form-label mt-4" for="secter_entity_id">Secteurs</label>
                                <select name="secter_entity_id" class="form-control" id="secter_entity_id" >
                                    <option value="0"> ------ Séléctionnez le secteur </option>
                                    @if ($editedEmployee != null)
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
                        @if (count($sections))
                            <div>
                                <label class="col-form-label mt-4" for="section_entity_id">Section</label>
                                <select name="section_entity_id" class="form-control" id="section_entity_id" >
                                    <option value="0"> ------ Séléctionnez la section </option>
                                    @if ($editedEmployee != null)
                                        @foreach($sections as $section)
                                            <option {{ $entity->id == $editedEmployee->section_entity->id ? 'selected' : '' }} value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                    @else
                                        @foreach($sections as $section)
                                            <option value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-border-style me-1"></i> Exemple de fichier Excel à importer
                        </h5>
                    </div>
                    <div class="card-body shadow">

                        <table class="table table-striped">
                            <thead>
                            <th>PPR</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Tel</th>
                            </thead>
                            <tbody>
                            @for($i=0;$i<5;$i++)
                                <tr>
                                    <td>XXXX</td>
                                    <td>XXXX </td>
                                    <td>XXXXX</td>
                                    <td>XXXX@XXX.XX</td>
                                    <td>XXXXXXXXXX</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                        <div>
                            <x-input-file
                                label="Fichier excel des matériels"
                                name="file"
                                class="form-control"
                                id="file"
                            />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="Enregister" />
                            <a href="{{route('employees.create')}}" class="btn btn-sm btn-light" ><i class="bi bi-repeat"></i></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </form>
</x-layout>

