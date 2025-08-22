<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('consumables.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-hourglass me-1"></i> {{$consumable->ref}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-hover shadow">
                        <tbody>
                        <tr>
                            <th class="align-content-center"> Consommable </th>
                            <td class="align-content-center">
                                <div class="row col-12">
                                    <div class="col-4 align-content-center"><img src="data:image/png;base64,{{ base64_encode($consumable->image) }}" width="64" height="64"></div>
                                    <div class="col-8 align-content-center">
                                        <span class="badge bg-info">{{$consumable->ref}}</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Type </th>
                            <td>
                                <span class="badge bg-light">{{$consumable->type_consumable->title}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Description </th>
                            <td>
                                {{$consumable->description}}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Modèle(s) compatible </th>
                            <td>
                                @if(count($consumable->fittings) != 0)
                                    @foreach($consumable->fittings as $fitting)
                                        <div class="row col-12">
                                            <div class="col-10">
                                                <div class="card border-primary mb-3">
                                                    <div class="card-header">
                                                        <span class="badge badge-bg">{{$fitting->model_material->title}}</span>
                                                    </div>
                                                    <div class="card-body">
                                                        <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="64" height="64">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-2 text-center align-content-center">
                                                <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-x-square" target="disaffectModal{{$fitting->id}}" title="Retiré ce modèle" />
                                                <x-confirmation-modal
                                                    href="{{route('consumables.disaffect', $fitting->id)}}"
                                                    target="disaffectModal{{$fitting->id}}"
                                                    title="Confirmation"
                                                    message="Voulez vous vraiment retiré ce modèle ?" />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-bank2 me-1"></i>  Affecter un modèle à ce consommable
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('consumables.affect', $consumable->id)}}" method="POST">
                        @csrf
                        <label  class="col-form-label mt-4" for="model_material_id" >Séléctionnez un modèle</label>
                        <select class="form-control" name="model_material_id" id="model_material_id">
                            @foreach($models as $model)
                                <option value="{{$model->id}}">  {{$model->title}}</option>
                            @endforeach
                        </select>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Affecter" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout>
