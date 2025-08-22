<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary shadow">
                <div class="card-header">
                    <h5>
                        <a href="{{route('consummations.index')}}" class="" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-people"></i> {{$consummation->employee->firstname}} {{$consummation->employee->lastname}}
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-light shadow mt-3">
                        <tr>
                            <th> PPR </th><td> {{$consummation->employee->ppr}} </td>
                        </tr>
                        <tr>
                            <th> Email </th><td> {{$consummation->employee->email}} </td>
                        </tr>
                        <tr>
                            <th> Téléphone </th><td> {{$consummation->employee->tel}} </td>
                        </tr>
                        <tr>
                            <th> Service </th><td> {{$consummation->employee->service_entity->title}} </td>
                        </tr>
                        @if ($consummation->employee->entity != null)
                        <tr>
                            <th> Entity </th><td> {{$consummation->employee->entity->title}} </td>
                        </tr>
                        @endif
                        @if ($consummation->employee->secter_entity != null)
                            <tr>
                                <th> Secteur </th><td> {{$consummation->employee->secter_entity->title}} </td>
                            </tr>
                        @endif
                        @if ($consummation->employee->section_entity)
                            <tr>
                                <th> Section </th><td> {{$consummation->employee->section_entity->title}} </td>
                            </tr>
                        @endif
                        <tr>
                            <th> Local </th><td> {{$consummation->employee->local->title}} </td>
                        </tr>
                        <tr>
                            <th> Ville </th><td> {{$consummation->employee->local->city->title}} </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary shadow">
                <div class="card-header">
                    <h5><i class="bi bi-water"></i> {{$consummation->stock_consumable->consumable->ref}}</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-light shadow mt-3">
                        <tr>
                            <td colspan="2" class="text-center align-content-center"><img src="data:image/png;base64,{{ base64_encode($consummation->stock_consumable->consumable->image) }}" width="128" height="128"></td>
                        </tr>
                        <tr>
                            <th> Type </th><td> {{$consummation->stock_consumable->consumable->type_consumable->title}} </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Description </th><td> {{$consummation->stock_consumable->consumable->description}} </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Imprimante(s) </th>
                            <td>
                                @foreach($consummation->stock_consumable->consumable->fittings as $fitting)
                                    <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="64" height="64">
                                    <span class="badge badge-bg">{{$fitting->model_material->title}}</span> <br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary shadow">
                <div class="card-header">
                    <div class="row col-12">
                        <div class="col-8">
                            <h5><i class="bi bi-info"></i> Les informations de demande </h5>
                        </div>
                        <div class="col-4">
                            @if($consummation->is_done)
                                <span class="badge bg-success float-end">Validé</span>
                            @else
                                <span class="badge bg-warning float-end">Non Validé</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-light shadow mt-3">
                        <tr>
                            <th> Quantité </th><td> {{$consummation->quantity_required}} </td>
                        </tr>
                        <tr>
                            <th> Date de conommation </th><td> {{ \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y') }} </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div class="row col-12">
                                    <div class="col-6">
                                        @if(!$consummation->is_done)
                                            <x-button-modal class="btn btn-sm btn-success" target="validModal{{$consummation->id}}" icon="bi bi-check" title="Valider" />
                                            <x-confirmation-modal
                                                href="{{route('consummations.valid', $consummation->id)}}"
                                                target="validModal{{$consummation->id}}"
                                                title="Confirmation"
                                                message="Voulez vous vraiment valider ce demande de consommable ?" />
                                        @else
                                            <a href="{{route('consummations.receipt', $consummation->id)}}" target="_blank" class="text-success" > <i class="bi bi-download"></i> Télécharger le bon de réception </a>
                                        @endif
                                    </div>
                                    <div class="col-6 align-content-center">

                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
