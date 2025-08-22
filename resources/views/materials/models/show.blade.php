<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="row">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <a href="{{route('models.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                            <i class="bi bi-box-fill me-1"></i> {{$model->title}}

                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <table class="table table-light table-hover shadow">
                            <tbody>
                            <tr>
                                <th class="align-content-center"> Modèle </th>
                                <td class="align-content-center">
                                    <div class="row col-12">
                                        <div class="col-4 align-content-center"><img src="data:image/png;base64,{{ base64_encode($model->image_data) }}" width="64" height="64"></div>
                                        <div class="col-8 align-content-center">{{$model->title}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-content-center"> Type </th>
                                <td>
                                    {{$model->type_material->title}}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-content-center"> Marque </th>
                                <td class="align-content-center">
                                    <div class="row col-12">
                                        <div class="col-4 align-content-center"><img src="data:image/png;base64,{{ base64_encode($model->brand_material->logo_data) }}" width="64" height="64"></div>
                                        <div class="col-8 align-content-center">{{$model->brand_material->title}}</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="align-content-center"> Marché(s) </th>
                                <td>
                                    @if(count($model->deliveries_material) != 0)
                                        @foreach($model->deliveries_material as $delivery)
                                            <div class="row col-12 mb-3">
                                                        <div class="col-6">
                                                            <span class="badge badge-bg">
                                                                <a class="text-decoration-none" href="{{route('models.delivery', $model->id)}}">{{$delivery->march_material->title}}</a>
                                                            </span>
                                                        </div>
                                                        <div class="col-6">
                                                            <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-x-square" target="disaffectModal{{$delivery->id}}" title="Retiré ce marché" />
                                                            <x-confirmation-modal
                                                                href="{{route('models.disaffect', $delivery->id)}}"
                                                                target="disaffectModal{{$delivery->id}}"
                                                                title="Confirmation"
                                                                message="Voulez vous vraiment retiré ce marché ?" />
                                                        </div>
                                                    </div>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="align-content-center"> Mot de passe administrateur </th>
                                <td>
                                    {{$model->password}}
                                </td>
                            </tr>
                            <tr>
                                <th class="align-content-center"> Nomnbre des matériels </th>
                                <td>
                                    {{$total}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card border-primary mb-3">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-bank2 me-1"></i>  Affecter un marché à ce modèle
                        </h5>
                    </div>
                    <div class="card-body shadow">
                        <form action="{{route('models.affect', $model->id)}}" method="POST">
                            @csrf
                            <label  class="col-form-label mt-4" for="march_material_id" >Séléctionnez un marché</label>
                            <select class="form-control" name="march_material_id" id="march_material_id">
                                @foreach($marchs as $march)
                                    <option value="{{$march->id}}">  {{$march->title}}</option>
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
        <div class="col-6">
            <div class="">
                <div class="card border-primary shadow mb-3">
                    <div class="card-header border-primary">
                        <div class="row col-12">
                            <div class="col-6">
                                <h5> Les matérieles du modèle <span class="badge bg-light">{{$model->title}}</span></h5>
                            </div>
                            <div class="col-6">
                                <a href="{{route('models.export', $model->id)}}" class="text-decoration-none float-end" >
                                <span class="badge bg-primary">
                                    <i class="bi bi-download"></i>Télécharger
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row col-12">
                            @foreach($materials as $material)
                                <div class="col-4 shadow">
                                    <div class="card mb-3 shadow">
                                        <div class="card-header text-center">
                                            @if($material->state == 1)
                                                <h5><span class="badge bg-success" title="OK">{{$material->serial}}</span></h5>
                                            @endif
                                            @if($material->state == -1)
                                                <h5><span class="badge bg-warning" title="En Panne">{{$material->serial}}</span></h5>
                                            @endif
                                            @if($material->state == -2)
                                                <h5><span class="badge bg-danger" title="En Casse">{{$material->serial}}</span></h5>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="text-center m-2">
                                                <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="128" height="128">
                                            </div>
                                            <div class="row m-2">
                                                <span class="badge bg-light">{{ $material->delivery_material->model_material->title }}</span>
                                            </div>
                                            <div class="row m-2">
                                                <span class="badge bg-light">{{ $material->delivery_material->model_material->type_material->title }}</span>
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            Marché <span class="badge bg-light">{{ $material->delivery_material->march_material->title }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$materials->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
