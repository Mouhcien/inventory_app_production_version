<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <div class="row col-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <a href="{{route('entities.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary" ></i></a>
                                <i class="bi bi-border-style me-1"></i> Les sections du DRI Marrakech
                            </h5>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Section </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($sections as $section)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">{{ $section->title }}</span><br>
                                    <span class="badge bg-info">{{ $section->entity->type_entity->title }}</span>
                                    <span class="badge bg-secondary"> {{ $section->entity->title }}</span><br>
                                    <span class="badge bg-info">Service : </span>
                                    <span class="badge bg-light"> {{ $section->entity->service_entity->title }}</span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-tools"></i></button>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                            <x-button-traitement href="{{route('sections.edit', $section->id)}}" class="btn btn-sm btn-warning ms-3" icon="bi bi-pencil"  />
                                            <x-button-traitement href="{{route('sections.show', $section->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                            @if(config('app.delete'))
                                                <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$section->id}}" />
                                            @endif
                                        </div>
                                    </div>
                                    <x-confirmation-modal
                                        href="{{route('sections.destroy', $section->id)}}"
                                        target="deleteModal{{$section->id}}"
                                        title="Confirmation"
                                        message="Voulez vous vraiment supprimer ce secteur ?" />
                                </td>

                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="4"> <h5> Pas des sections !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{$sections->links()}}
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
                            <h5 class="card-title">
                                <i class="bi bi-border-style me-1"></i> {{$title}}
                            </h5>
                        </div>
                        <div class="card-body shadow">
                            <form action="{{route($url, $id)}}" method="POST">
                                @csrf
                                <div>
                                    <x-input-text
                                        label="Section"
                                        name="title"
                                        class="form-control"
                                        placeholder="Section"
                                        id="sectionTitle"
                                        :value="$editedSection->title ?? ''"
                                    />
                                </div>
                                <div>
                                    @if ($entity != null)
                                        <div>
                                            <label class="col-form-label mt-4" for="entity_id">Entité : </label>
                                            <span class="badge"> {{$entity->title}}</span>
                                            <input type="hidden" name="entity_id" value="{{$entity->id}}" />
                                            <input type="hidden" name="operation" value="with_entity" />
                                        </div>
                                    @else
                                        <label class="col-form-label mt-4" for="entity_id">Type d'entité</label>
                                        <select name="entity_id" class="form-control" id="entity_id" >
                                            @if ($editedSection != null)
                                                @foreach($entities as $entity)
                                                    <option {{ $entity->id == $editedSection->entity->id ? 'selected' : '' }} value="{{$entity->id}}">{{$entity->title}}</option>
                                                @endforeach
                                            @else
                                                @foreach($entities as $entity)
                                                    <option value="{{$entity->id}}">{{$entity->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif

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
                                <i class="bi bi-border-style me-1"></i> Importer les sections du DRI-Marrakech
                            </h5>
                        </div>
                        <div class="card-body shadow">
                            <form action="{{route('sections.import')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-input-file
                                        label="Fichier excel des sections du DRI-Marrakech"
                                        name="file"
                                        class="form-control"
                                        id="file"
                                    />
                                </div>
                                <div>
                                    @if ($entity != null)
                                        <div>
                                            <label class="col-form-label mt-4" for="entity_id">Entité : </label>
                                            <span class="badge"> {{$entity->title}}</span>
                                            <input type="hidden" name="entity_id" value="{{$entity->id}}" />
                                            <input type="hidden" name="operation" value="with_entity" />
                                        </div>
                                    @else
                                        <label class="col-form-label mt-4" for="entity_id">Type d'entité</label>
                                        <select name="entity_id" class="form-control" id="entity_id" >
                                            @if ($editedSection != null)
                                                @foreach($entities as $entity)
                                                    <option {{ $entity->id == $editedSection->entity->id ? 'selected' : '' }} value="{{$entity->id}}">{{$entity->title}}</option>
                                                @endforeach
                                            @else
                                                @foreach($entities as $entity)
                                                    <option value="{{$entity->id}}">{{$entity->title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    @endif

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
