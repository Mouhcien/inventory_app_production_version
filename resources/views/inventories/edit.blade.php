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
                            <th> Employée </th><td> {{$inventory->employee->firstname}} {{$inventory->employee->lastname}} </td>
                        </tr>
                        <tr>
                            <th> PPR </th><td> {{$inventory->employee->ppr}} </td>
                        </tr>
                        <tr>
                            <th> Email </th><td> {{$inventory->employee->email}} </td>
                        </tr>
                        <tr>
                            <th> Téléphone </th><td> {{$inventory->employee->tel}} </td>
                        </tr>
                        <tr>
                            <th> Service </th><td> {{$inventory->employee->service_entity->title}} </td>
                        </tr>
                        @if ($inventory->employee->entity != null)
                            <tr>
                                <th> Entity </th><td> {{$inventory->employee->entity->title}} </td>
                            </tr>
                        @endif
                        @if ($inventory->employee->secter_entity != null)
                            <tr>
                                <th> Secteur </th><td> {{$inventory->employee->secter_entity->title}} </td>
                            </tr>
                        @endif
                        @if ($inventory->employee->section_entity)
                            <tr>
                                <th> Section </th><td> {{$inventory->employee->section_entity->title}} </td>
                            </tr>
                        @endif
                        <tr>
                            <th> Local </th><td> {{$inventory->employee->local->title}} </td>
                        </tr>
                        <tr>
                            <th> Ville </th><td> {{$inventory->employee->local->city->title}} </td>
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
                                    <img src="data:image/png;base64,{{ base64_encode($inventory->material->delivery_material->model_material->image_data) }}" width="128" height="128">
                                </td>
                            </tr>
                            <tr>
                                <th> Série </th><td> {{$inventory->material->serial}} </td>
                            </tr>
                            <tr>
                                <th> Modèle </th><td> {{$inventory->material->delivery_material->model_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Type </th><td> {{$inventory->material->delivery_material->model_material->type_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marque </th><td> {{$inventory->material->delivery_material->model_material->brand_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marché </th><td> {{$inventory->material->delivery_material->march_material->title}} </td>
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
                    <form action="{{route('inventories.update', $inventory->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{$inventory->employee_id}}">
                        <input type="hidden" name="material_id" value="{{$inventory->material_id}}">
                        <p class="text-danger">Voulez-vous vraimenet modifier cette attribution ?</p>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="OUI" />
                            <a href="{{route('inventories.index')}}" class="btn btn-sm btn-danger float-end"><i class="bi bi-x-square" ></i> NON </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
