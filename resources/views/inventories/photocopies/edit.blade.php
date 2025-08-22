<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Les employées du DRI-marrakech</h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-striped table-light border-0 shadow mt-3">
                        <tr>
                            <th colspan="2"> Entité Administrative </th>
                        </tr>
                        <tr>
                            <th> Service </th><td> {{$photocopy->service_entity->title}} </td>
                        </tr>
                        @if ($photocopy->entity != null)
                            <tr>
                                <th> Entity </th><td> {{$photocopy->entity->title}} </td>
                            </tr>
                        @endif
                        @if ($photocopy->secter_entity != null)
                            <tr>
                                <th> Secteur </th><td> {{$photocopy->secter_entity->title}} </td>
                            </tr>
                        @endif
                        @if ($photocopy->section_entity)
                            <tr>
                                <th> Section </th><td> {{$photocopy->section_entity->title}} </td>
                            </tr>
                        @endif
                        <tr>
                            <th> Local </th><td> {{$photocopy->local->title}} </td>
                        </tr>
                        <tr>
                            <th> Ville </th><td> {{$photocopy->local->city->title}} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Les matériels du DRI-marrakech</h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-striped table-light border-0 shadow mt-3">
                            <tr>
                                <td colspan="2" class="text-center align-content-center">
                                    <img src="data:image/png;base64,{{ base64_encode($photocopy->material->delivery_material->model_material->image_data) }}" width="128" height="128">
                                </td>
                            </tr>
                            <tr>
                                <th> Série </th><td> {{$photocopy->material->serial}} </td>
                            </tr>
                            <tr>
                                <th> Modèle </th><td> {{$photocopy->material->delivery_material->model_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Type </th><td> {{$photocopy->material->delivery_material->model_material->type_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marque </th><td> {{$photocopy->material->delivery_material->model_material->brand_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marché </th><td> {{$photocopy->material->delivery_material->march_material->title}} </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <div class="row cols-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <i class="bi bi-info me-1"></i> Confirmation
                            </h5>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('inventories.photocopies.update', $photocopy->id)}}" method="POST">
                        @csrf
                        <p class="text-danger">Voulez-vous vraimenet modifier cette attribution ?</p>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="OUI" />
                            <a href="{{route('inventories.photocopies')}}" class="btn btn-sm btn-danger float-end"><i class="bi bi-x-square" ></i> NON </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
