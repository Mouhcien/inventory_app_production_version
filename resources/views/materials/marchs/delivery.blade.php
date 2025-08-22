<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('marchs.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-bank2 me-1"></i> {{$delivery->march_material->title}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-hover shadow">
                        <tbody>
                        <th class="align-content-center"> Modèle </th>
                        <td>
                            <div class="row col-12 mt-2">
                                <div class="col-4">
                                    <img src="data:image/png;base64,{{ base64_encode($delivery->model_material->image_data) }}" width="32" height="32">
                                    <span class="badge badge-bg">{{$delivery->model_material->title}}</span>
                                </div>
                                <div class="col-4">
                                    <img src="data:image/png;base64,{{ base64_encode($delivery->model_material->brand_material->logo_data) }}" width="32" height="32">
                                    <span class="badge badge-bg">{{$delivery->model_material->brand_material->title}}</span>
                                </div>
                                <div class="col-3">
                                    <span class="badge badge-bg">{{$delivery->model_material->type_material->title}}</span>
                                </div>
                                <div class="col-1">
                                    <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-x-square" target="disaffectModal{{$delivery->id}}" title="Retiré ce modèle" />
                                    <x-confirmation-modal
                                        href="{{route('marchs.disaffect', $delivery->id)}}"
                                        target="disaffectModal{{$delivery->id}}"
                                        title="Confirmation"
                                        message="Voulez vous vraiment retiré ce modèle ?" />
                                </div>
                            </div>
                        </td>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-box-fill me-1"></i> Affecter un modèle à ce marché
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('marchs.affect', $delivery->march_material->id)}}" method="POST">
                        @csrf
                        <label  class="col-form-label mt-4" for="model_material_id" >Séléctionnez un modèle</label>
                        <select class="form-control" name="model_material_id" id="model_material_id">
                            @foreach($models as $model)
                                <option value="{{$model->id}}"> {{$model->title}}</option>
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
    <div>
        <div class="card border-primary shadow mb-3">
            <div class="card-header border-primary">
                <div class="row col-12">
                    <div class="col-6">
                        <h5> Les matérieles du marché <span class="badge bg-light">{{$delivery->march_material->title}}</span></h5>
                    </div>
                    <div class="col-6">
                        <a href="{{route('marchs.export.delivery', $delivery->id)}}" class="text-decoration-none float-end" >
                                <span class="badge bg-primary">
                                    <i class="bi bi-download"></i>Télécharger
                                </span>
                        </a>
                        <span class="badge bg-primary"> Total : {{$total}}</span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row col-12">
                    @foreach($materials as $material)
                        <div class="col-3 shadow">
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
                                    <div class="text-center m-2">
                                        <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->brand_material->logo_data) }}" width="64" height="64">
                                    </div>
                                    <div class="row m-2">
                                        <span class="badge bg-light">{{ $material->delivery_material->model_material->brand_material->title }}</span>
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
</x-layout>
