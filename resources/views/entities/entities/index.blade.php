<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <div class="row col-12">
                        <div class="col-6 align-content-center">
                            <h5 class="card-title">
                                <i class="bi bi-columns-gap me-1"></i> Les entités du DRI Marrakech
                            </h5>
                        </div>
                        <div class="col-6 align-content-center">
                            <a class="float-end btn btn-light me-2" href="{{route('sections.index')}}" ><i class="bi bi-diamond"></i> Sections </a>
                            <a class="float-end btn btn-info me-2" href="{{route('secters.index')}}" > <i class="bi bi-diamond-fill"></i> Secteurs </a>
                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Entité </th>
                        <th> Type <a class="text-decoration-none text-success" href="{{route('entities.index')}}" title="Actualiser"><i class="bi bi-repeat"></i></a> </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($entities as $entity)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ $entity->title }}
                                    </span><br>
                                    <span class="badge bg-info">Service : </span>
                                    <span class="badge bg-light"> {{ $entity->service_entity->title }} </span>
                                </td>
                                <td>
                                    <a href="{{route('entities.index', $entity->type_entity->id)}}" class="badge bg-success text-decoration-none" >
                                        {{ $entity->type_entity->title }}
                                    </a>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-tools"></i></button>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                            <x-button-traitement href="{{route('entities.edit', $entity->id)}}" class="btn btn-sm btn-warning ms-2" icon="bi bi-pencil"  />
                                            <x-button-traitement href="{{route('entities.show', $entity->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                            @if(config('app.delete'))
                                                <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$entity->id}}" />
                                            @endif
                                            <x-button-traitement
                                                href="{{route('secters.secteurs', $entity->id)}}"
                                                class="btn btn-sm btn-light ms-2 mt-1"
                                                icon="bi bi-diamond-fill"
                                                title="Les secteurs [Total : {{ count($entity->secters_entities)  }}]"  />

                                            <x-button-traitement
                                                href="{{route('sections.sections', $entity->id)}}"
                                                class="btn btn-sm btn-light"
                                                icon="bi bi-diamond"
                                                title="Les sections [Total : {{ count($entity->sections_entities)  }}]"  />
                                        </div>
                                    </div>
                                    <x-confirmation-modal
                                        href="{{route('entities.destroy', $entity->id)}}"
                                        target="deleteModal{{$entity->id}}"
                                        title="Confirmation"
                                        message="Voulez vous vraiment supprimer cette entité ?" />
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="4"> <h5> Pas des entités !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{$entities->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <ul class="nav nav-tabs border-primary shadow" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab">Formulaire</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#importEntity" aria-selected="false" role="tab" tabindex="-1">Importation</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content border-primary shadow">
                <div class="tab-pane fade active show" id="home" role="tabpanel">
                    <div class="card border-primary mb-3">
                        <div class="card-header">
                            <div class="row col-12">
                                <div class="col-6">
                                    <h5 class="card-title">
                                        <i class="bi bi-border-style me-1"></i> {{$title}}
                                    </h5>
                                </div>
                                <div class="col-6">
                                    <a class="badge bg-primary float-end text-decoration-none" href="{{route('entities.types.index')}}" >Types d'entités</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body shadow">
                            <form action="{{route($url, $id)}}" method="POST">
                                @csrf
                                <div>
                                    <x-input-text
                                        label="Entité Administrative"
                                        name="title"
                                        class="form-control"
                                        placeholder="Entité Administrative"
                                        id="entityTitle"
                                        :value="$editedEntity->title ?? ''"
                                    />
                                </div>
                                <div>
                                    <label class="col-form-label mt-4" for="type_entity_id">Type d'entité</label>
                                    <select name="type_entity_id" class="form-control" id="type_entity_id" >
                                        @if ($editedEntity != null)
                                            @foreach($types as $type)
                                                <option {{ $type->id == $editedEntity->type_entity->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label class="col-form-label mt-4" for="service_entity_id">Service</label>
                                    <select name="service_entity_id" class="form-control" id="service_entity_id" >
                                        @if ($editedEntity != null)
                                            @foreach($services as $service)
                                                <option {{ $service->id == $editedEntity->service_entity->id ? 'selected' : '' }} value="{{$service->id}}">{{$service->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}">{{$service->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <x-button type="submit" class="btn btn-primary" text="Valider" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="importEntity" role="tabpanel">
                    <div class="card border-primary mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-border-style me-1"></i> Importer les entités du DRI-Marrakech
                            </h5>
                        </div>
                        <div class="card-body shadow">
                            <form action="{{route('entities.import')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-input-file
                                        label="Fichier excel des entités du DRI-Marrakech"
                                        name="file"
                                        class="form-control"
                                        id="file"
                                    />
                                </div>
                                <div>
                                    <label class="col-form-label mt-4" for="type_entity_id">Type d'entité</label>
                                    <select name="type_entity_id" class="form-control" id="type_entity_id" >
                                        @if ($editedEntity != null)
                                            @foreach($types as $type)
                                                <option {{ $type->id == $editedEntity->type_entity->id ? 'selected' : '' }} value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($types as $type)
                                                <option value="{{$type->id}}">{{$type->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div>
                                    <label class="col-form-label mt-4" for="service_entity_id">Service</label>
                                    <select name="service_entity_id" class="form-control" id="service_entity_id" >
                                        @if ($editedEntity != null)
                                            @foreach($services as $service)
                                                <option {{ $service->id == $editedEntity->service_entity->id ? 'selected' : '' }} value="{{$service->id}}">{{$service->title}}</option>
                                            @endforeach
                                        @else
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}">{{$service->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mt-2">
                                    <x-button type="submit" class="btn btn-primary" text="Importer" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
