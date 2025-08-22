<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Les employées du DRI-marrakech</h5>
                </div>
                <div class="card-body shadow">
                    <label class="col-form-label mt-4" for="sl_inv_employee_id">Employée</label>
                    <select name="employee_id" class="form-control" id="sl_inv_employee_id" >
                        <option value="0">-----------------------</option>
                        @foreach($employees as $employee)
                            @if($employeeSelected != null)
                                <option {{ $employeeSelected->id == $employee->id ? 'selected' : ''}} value="{{$employee->id}}">{{$employee->firstname}} {{$employee->lastname}}</option>
                            @else
                                <option value="{{$employee->id}}">{{$employee->lastname}} {{$employee->firstname}} </option>
                            @endif
                        @endforeach
                    </select>
                    @if ($employeeSelected != null)
                        <table class="table table-striped table-light shadow mt-3">
                            <tr>
                                <th> Employée </th><td> {{$employeeSelected->firstname}} {{$employeeSelected->lastname}} </td>
                            </tr>
                            <tr>
                                <th> PPR </th><td> {{$employeeSelected->ppr}} </td>
                            </tr>
                            <tr>
                                <th> Email </th><td> {{$employeeSelected->email}} </td>
                            </tr>
                            <tr>
                                <th> Téléphone </th><td> {{$employeeSelected->tel}} </td>
                            </tr>
                            <tr>
                                <th> Service </th><td> {{$employeeSelected->service_entity->title}} </td>
                            </tr>
                            @if ($employeeSelected->entity != null)
                                <tr>
                                    <th> Entity </th><td> {{$employeeSelected->entity->title}} </td>
                                </tr>
                            @endif
                            @if ($employeeSelected->secter_entity != null)
                                <tr>
                                    <th> Secteur </th><td> {{$employeeSelected->secter_entity->title}} </td>
                                </tr>
                            @endif
                            @if ($employeeSelected->section_entity)
                                <tr>
                                    <th> Section </th><td> {{$employeeSelected->section_entity->title}} </td>
                                </tr>
                            @endif
                            <tr>
                                <th> Local </th><td> {{$employeeSelected->local->title}} </td>
                            </tr>
                            <tr>
                                <th> Ville </th><td> {{$employeeSelected->local->city->title}} </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Les matériels du DRI-marrakech</h5>
                </div>
                <div class="card-body shadow">
                    <div>
                        <label class="col-form-label mt-4" for="sl_inv_model_material_id">Modèles du matériel</label>
                        <select name="delivery_id" class="form-control" id="sl_inv_model_material_id" >
                            <option value="0">-----------------------</option>
                            @foreach($deliveries as $delivery)
                                @if($deliverySelected != null)
                                    <option {{ $deliverySelected == $delivery->id ? 'selected' : ''}} value="{{$delivery->id}}">
                                        {{$delivery->model_material->title}} du marché : [{{$delivery->march_material->title}}]
                                    </option>
                                @else
                                    <option value="{{$delivery->id}}">
                                        {{$delivery->model_material->title}} du marché : [{{$delivery->march_material->title}}]
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="col-form-label mt-4" for="sl_inv_material_id">Matériel</label>
                        <select name="material_id" class="form-control" id="sl_inv_material_id" >
                            <option value="0">-----------------------</option>
                            @foreach($materials as $material)
                                @if($materialSelected != null)
                                    <option {{ $materialSelected->id == $material->id ? 'selected' : ''}} value="{{$material->id}}">
                                        {{$material->serial}} [{{$material->delivery_material->model_material->title}}]
                                    </option>
                                @else
                                    <option value="{{$material->id}}">
                                        {{$material->serial}} [{{$material->delivery_material->model_material->title}}]
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @if ($materialSelected != null)
                        <table class="table table-striped table-light shadow mt-3">
                            <tr>
                                <td colspan="2" class="text-center align-content-center">
                                    <img src="data:image/png;base64,{{ base64_encode($materialSelected->delivery_material->model_material->image_data) }}" width="128" height="128">
                                </td>
                            </tr>
                            <tr>
                                <th> Série </th><td> {{$materialSelected->serial}} </td>
                            </tr>
                            <tr>
                                <th> Modèle </th><td> {{$materialSelected->delivery_material->model_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Type </th><td> {{$materialSelected->delivery_material->model_material->type_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marque </th><td> {{$materialSelected->delivery_material->model_material->brand_material->title}} </td>
                            </tr>
                            <tr>
                                <th> Marché </th><td> {{$materialSelected->delivery_material->march_material->title}} </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <div class="row cols-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <i class="bi bi-border-style me-1"></i> Validation
                            </h5>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    @if ( $employeeSelected != null && $materialSelected != null)
                    <form action="{{route('inventories.store', ['employee_id' => $employeeSelected->id, 'material_id' => $materialSelected->id])}}" method="POST">
                        @csrf
                        <p class="text-danger">Voulez vraiment Affecter ce matériel a ce employé ?</p>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="OUI" />
                            <a href="{{route('inventories.index')}}" class="btn btn-sm btn-danger float-end"><i class="bi bi-x-square" ></i> NON </a>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layout>
