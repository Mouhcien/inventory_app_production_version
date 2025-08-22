<x-layout>

    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('deliveries.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-truck me-1"></i> {{$delivery->title}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <tbody>
                        <tr>
                            <th class="align-content-center"> Date de livarsion </th>
                            <td class="align-content-center">
                                {{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Validé </th>
                            <td>
                                @if($delivery->is_valid)
                                    <span class="badge bg-success">OUI</span>
                                @else
                                    <span class="badge bg-danger">NON</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if(count($delivery->stocks_consumables) != 0)
                                    @foreach($delivery->stocks_consumables as $stock)
                                        <a href="{{route('deliveries.stock.consumable', ['consumable' => $stock->consumable_id, 'delivery' => $delivery->id] )}}">
                                        <div class="card border-primary mb-3 shadow">
                                            <div class="card-header border-0">
                                                <div class="row">
                                                    <span class="badge badge-bg">
                                                        {{$stock->consumable->type_consumable->title}} :
                                                        {{$stock->consumable->ref}}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="card-body text-center align-content-center">
                                                <img src="data:image/png;base64,{{ base64_encode($stock->consumable->image) }}" width="64" height="64">
                                            </div>
                                            <div class="card-footer border-primary">
                                                Quantité livré : <span class="badge bg-success">{{$stock->quantity_received}}</span><br>
                                                Quantité resté : <span class="badge bg-danger">{{$stock->quantity_rest}}</span>
                                            </div>
                                        </div>
                                        </a>
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                @if (!$delivery->is_valid)
                                    <a href="{{route('deliveries.valid', $delivery->id)}}" class="btn btn-sm btn-success" title="Valider la livraison" ><i class="bi bi-check"></i></a>
                                @endif
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-primary mb-3 shadow" >
                <div class="card-header border-primary">
                    <h5>
                        <a href="{{route('deliveries.stock', $delivery->id)}}"><i class="bi bi-repeat text-primary"></i></a>
                        <i class="bi bi-hourglass-split"></i>
                        Les consommations
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <table class="table table-striped border-0">
                        <thead>
                            <th>  </th>
                            <th> Consommable </th>
                            <th> Type </th>
                            <th> Employée </th>
                            <th> Quantité </th>
                            <th> Date </th>
                            <th></th>
                        </thead>
                        <tbody>
                        @foreach($consummations as $consummation)
                            <tr>
                                <td class="align-content-center text-center"> <img src="data:image/png;base64,{{ base64_encode($consummation->stock_consumable->consumable->image) }}" width="32" height="32"> </td>
                                <td class="align-content-center"> {{ $consummation->stock_consumable->consumable->ref }}</td>
                                <td class="align-content-center"> {{ $consummation->stock_consumable->consumable->type_consumable->title }}</td>
                                <td class="align-content-center">
                                    {{ $consummation->employee->firstname }} {{ $consummation->employee->lastname }}
                                </td>
                                <td class="align-content-center"> {{ $consummation->quantity_required }}</td>
                                <td class="align-content-center text-center"> {{ \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y') }}</td>
                                <td class="align-content-center text-center">
                                    @if (!$consummation->is_done)
                                        <x-button-modal class="btn btn-sm btn-success" target="validModal{{$consummation->id}}" icon="bi bi-check" title="Valider" />
                                        <x-confirmation-modal
                                            href="{{route('consummations.valid', $consummation->id)}}"
                                            target="validModal{{$consummation->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment valider ce demande de consommable ?" />
                                    @else
                                        <a href="{{route('consummations.receipt', $consummation->id)}}" target="_blank" class="btn btn-sm btn-danger" title="Télécharger le bon"  > <i class="bi bi-file-pdf"></i></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <x-pagination-row :data="$consummations" />
                </div>
            </div>
        </div>
    </div>

</x-layout>
