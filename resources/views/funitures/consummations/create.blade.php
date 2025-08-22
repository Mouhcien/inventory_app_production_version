<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <div class="row cols-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <i class="bi bi-border-style me-1"></i> Les employées du DRI
                            </h5>
                        </div>
                        <div class="col-6">
                            <a href="{{'consummations.create'}}" class="btn btn-sm btn-primary float-end" title="Actualiser" ><i class="bi bi-repeat"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    <label class="col-form-label mt-4" for="sl_employee_id">Employée</label>
                    <select name="employee_id" class="form-control" id="sl_employee_id" >
                        <option value="0">-----------------------</option>
                        @foreach($employees as $employee)
                            @if($employeeSelected != null)
                                <option {{ $employeeSelected->id == $employee->id ? 'selected' : ''}} value="{{$employee->id}}">{{$employee->firstname}} {{$employee->lastname}}</option>
                            @else
                                <option value="{{$employee->id}}">{{$employee->lastname}} {{$employee->firstname}}</option>
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
                        <div class="mt-2">
                            <x-button type="button" class="btn btn-sm btn-primary" text="Séléctionez" id="sl_btn_employee" />
                        </div>
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
                                <i class="bi bi-border-style me-1"></i> Le consommable
                            </h5>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="card-body shadow">
                    <div>
                        <label class="col-form-label mt-4" for="sl_type_consumable_id">Type de consommable</label>
                        <select name="type_consumable_id" class="form-control" id="sl_type_consumable_id" >
                            <option value="0">-----------------------</option>
                            @foreach($types as $type)
                                @if ($typeSelected != null)
                                    <option {{$typeSelected == $type->id ? 'selected' : ''}} value="{{$type->id}}">{{$type->title}}</option>
                                @else
                                    <option value="{{$type->id}}">{{$type->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <table class="table table-striped table-light shadow mt-3">
                            @if ($consumables != null)
                                @foreach($consumables as $consumable)
                                <tr>
                                    <th>
                                        <input type="radio" name="consumable_id" value="{{$consumable->id}}" id="radio_consumable_id{{$consumable->id}}">
                                    </th>
                                    <th> <img src="data:image/png;base64,{{ base64_encode($consumable->image) }}" width="32" height="32"></th>
                                    <th>{{$consumable->ref}}</th>
                                    <td>
                                        @if(count($consumable->fittings) != 0)
                                            @foreach($consumable->fittings as $fitting)
                                                <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="32" height="32">
                                                <span class="badge badge-bg">{{$fitting->model_material->title}}</span> <br>
                                            @endforeach
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            @endif

                            @if ($stockSelected != null)
                                @foreach($stockSelected as $stock)
                                    <table class="table table-striped table-light shadow mt-3">
                                        <tr>
                                            <td colspan="2" class="text-center align-content-center">
                                                <img src="data:image/png;base64,{{ base64_encode($stock->consumable->image) }}" width="32" height="32">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Référence </th><td> {{$stock->consumable->ref}} </td>
                                        </tr>
                                        <tr>
                                            <th> Type </th><td> {{$stock->consumable->type_consumable->title}} </td>
                                        </tr>
                                        <tr>
                                            <th> Livraison </th><td> {{$stock->delivery->title}} </td>
                                        </tr>
                                        <tr>
                                            <th> Date de livraison </th><td> {{\Carbon\Carbon::parse($stock->delivery->delivery_date)->format('d/m/Y')}} </td>
                                        </tr>
                                        <tr>
                                            <th> Stock </th>
                                            <td>
                                                @if ($stock->quantity_rest > 0)
                                                    <span class="badge bg-success">Quantité resté : {{$stock->quantity_rest}} </span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                        <div class="mt-2">
                                            <x-button type="button" name="btn_stock_id" class="btn btn-sm btn-primary" text="Séléctionez" id="btn_stock_id{{$stock->id}}" value="{{$stock->id}}"  />
                                        </div>
                                @endforeach
                            @endif
                        </table>
                    </div>
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
                    <form action="{{route('consummations.store')}}" method="POST">
                        @csrf
                        <div>
                            <input type="date" class="form-control" name="consummation_date">
                        </div>
                        <div>
                            <x-input-text
                                label="Quantité demendé"
                                name="quantity_required"
                                class="form-control"
                                placeholder="Quantité demendé"
                                id="stockQuantityRequired"
                                value="1"
                            />
                            <input type="hidden" id="hd_employee_id" name="employee_id" value="" />
                            <input type="hidden" id="hd_stock_id" name="stock_consumable_id" value="" />
                        </div>
                        <div class="align-content-center mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                            <a href="{{route('consummations.prepare')}}" class="text-info float-end" >
                                <i class="bi bi-upload"></i>
                                Importer liste des consommations
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
