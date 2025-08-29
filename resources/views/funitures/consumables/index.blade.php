<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-hourglass  me-1"></i> Les consommables
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th class="text-center"> Consommable </th>
                        <th> Référence </th>
                        <th>Type</th>
                        <th title="Les modèles des imprimantes compatible avec ce référence"> Modèles </th>
                        <th> </th>
                        </thead>
                        <tbody>
                        @forelse($consumables as $consumable)
                            <tr>
                                <td class="align-content-center text-center" title="{{$consumable->description}}"> <img src="data:image/png;base64,{{ base64_encode($consumable->image) }}" width="32" height="32"> </td>
                                <td class="align-content-center" title="{{$consumable->description}}">
                                    <span class="badge bg-light">{{ $consumable->ref }}</span>
                                </td>
                                <td class="align-content-center">
                                    <span class="badge bg-light">{{ $consumable->type_consumable->title }} </span>
                                </td>
                                <td class="align-content-center">
                                    @if(count($consumable->fittings) != 0)
                                        @foreach($consumable->fittings as $fitting)
                                            <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="32" height="32">
                                            <span class="badge badge-bg">{{$fitting->model_material->title}}</span> <br>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="align-content-center">
                                    <x-button-traitement href="{{route('consumables.edit', $consumable->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer"  />
                                    <x-button-traitement href="{{route('consumables.show', $consumable->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$consumable->id}}" title="Supprimer" />
                                        <x-confirmation-modal
                                            href="{{route('consumables.destroy', $consumable->id)}}"
                                            target="deleteModal{{$consumable->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer ce consommable ?" />
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="6"> <h5> Pas des consommables !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <x-pagination-row :data="$consumables" />
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> {{$title}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route($url, $id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-text
                                label="Référence du Consommable"
                                name="ref"
                                class="form-control"
                                placeholder="Référence du Consommable"
                                id="consumableRef"
                                :value="$editedConsumable->ref ?? ''"
                            />
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="type_consumable_id">Type de consommable</label>
                            <select name="type_consumable_id" class="form-control" id="type_consumable_id" >
                                @foreach($types as $type)
                                    @if($editedConsumable != null)
                                        <option {{$type->id == $editedConsumable->type_consumable->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                    @else
                                        <option value="{{$type->id}}">{{$type->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-file
                                label="Image du consommable"
                                name="image"
                                class="form-control"
                                id="consumableLogo"
                            />
                        </div>
                        <div>
                            <x-input-textfield
                                label="Description du consommable"
                                placeholder="Description du consommable"
                                name="description"
                                class="form-control"
                                id="description"
                                value="{{$editedConsumable->description ?? '' }}" />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
