<x-layout>
    <div class="row col-12">
        <div class="col-9">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les modèles du matériels
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th class="text-center"> Modèle </th>
                        <th>Type</th>
                        <th>Marque</th>
                        <th>Marché</th>
                        <th>Réformé</th>
                        <th> </th>
                        </thead>
                        <tbody>
                        @forelse($models as $model)
                            <tr>
                                <td class="align-content-center"> <img src="data:image/png;base64,{{ base64_encode($model->image_data) }}" width="32" height="32"> {{ $model->title }}</td>
                                <td class="align-content-center"> {{ $model->type_material->title }}</td>
                                <td class="align-content-center"> <img src="data:image/png;base64,{{ base64_encode($model->brand_material->logo_data) }}" width="32" height="32"> {{ $model->brand_material->title }}</td>
                                <td class="align-content-center">
                                    @if(count($model->deliveries_material) != 0)
                                        <ul class="text-decoration-none">
                                            @foreach($model->deliveries_material as $delivery)
                                                <li class="list-unstyled">
                                                    <span class="badge bg-light">
                                                        <a href="{{route('materials.prepare', $delivery->id)}}" >
                                                            {{$delivery->march_material->title}}
                                                        </a>
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td class="align-content-center">
                                    @if(!$model->is_reform)
                                        <span class="badge bg-success">Non</span>
                                    @else
                                        <span class="badge bg-danger">Oui</span>
                                    @endif
                                </td>
                                <td class="align-content-center">
                                    <x-button-traitement href="{{route('models.edit', $model->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer"  />
                                    <x-button-traitement href="{{route('models.show', $model->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$model->id}}" title="Supprimer" />
                                        <x-confirmation-modal
                                            href="{{route('models.destroy', $model->id)}}"
                                            target="deleteModal{{$model->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer ce modèle ?" />
                                    @endif

                                    @if(!$model->is_reform)
                                        <x-button-modal class="btn btn-sm btn-light" icon="bi bi-exclamation-octagon" target="reformModal{{$model->id}}" title="Réformé" />
                                        <x-confirmation-modal
                                            href="{{route('models.reform', ['model' =>$model->id, 'state'=>true])}}"
                                            target="reformModal{{$model->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment réformé ce modèle?" />
                                    @else
                                        <x-button-modal class="btn btn-sm btn-success" icon="bi bi-check2-circle" target="annulerReformModal{{$model->id}}" title="Annuler la réforme" />
                                        <x-confirmation-modal
                                            href="{{route('models.reform', ['model' =>$model->id, 'state'=>0])}}"
                                            target="annulerReformModal{{$model->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment annuler la réform de ce modèle?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="6"> <h5> Pas des modèles !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $models->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
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
                                label="Modèle du matériel"
                                name="title"
                                class="form-control"
                                placeholder="Modèle du matériel informatique"
                                id="modelTitle"
                                :value="$editedModel->title ?? ''"
                            />
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="type_material_id">Type du matériel</label>
                            <select name="type_material_id" class="form-control" id="type_material_id" >
                                @foreach($types as $type)
                                    @if($editedModel != null)
                                        @if ($type->id == $editedModel->type_material->id)
                                            <option selected value="{{$type->id}}">{{$type->title}}</option>
                                        @endif
                                    @else
                                        <option value="{{$type->id}}">{{$type->title}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="brand_material_id">Marque du matériel</label>
                            <select name="brand_material_id" class="form-control" id="brand_material_id" >
                                @foreach($brands as $brand)
                                    @if($editedModel != null)
                                        @if($brand->id == $editedModel->brand_material->id)
                                            <option selected value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endif
                                    @else
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endif


                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-file
                                label="Image du modèle"
                                name="image"
                                class="form-control"
                                id="modelLogo"
                            />
                        </div>
                        <div>
                            <x-input-password
                                label="Mot de passe "
                                name="password"
                                class="form-control"
                                placeholder="Mot de passe administrateur"
                                id="modelPassword"
                                :value="$editedModel->password ?? ''"
                            />
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
