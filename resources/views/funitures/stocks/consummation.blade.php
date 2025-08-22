<x-layout>

    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('stocks.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-hourglass me-1"></i> {{ $stock->consumable->ref }}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover border-0 shadow">
                        <tbody>
                        <tr>
                            <td colspan="2" class="align-content-center text-center">
                                <img src="data:image/png;base64,{{ base64_encode($stock->consumable->image) }}" width="256" height="256">
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Type </th>
                            <td>
                                {{ $stock->consumable->type_consumable->title }}
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Imprimantes Compatibles </th>
                            <td>
                                @if(count($stock->consumable->fittings) != 0)
                                    @foreach($stock->consumable->fittings as $fitting)
                                        <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="128" height="128">
                                        <span class="badge badge-bg">{{$fitting->model_material->title}}</span> <br>
                                    @endforeach
                                @endif
                            </td>
                        <tr>
                            <th> Quantité livré</th>
                            <td class="align-content-center text-center"> <span class="badge bg-success">{{ $stock->quantity_received }}</span></td>
                        </tr>
                        <tr>
                            <th> Quantité resté</th>
                            <td class="align-content-center text-center"> <span class="badge bg-light">{{ $stock->quantity_rest }}</span></td>
                        </tr>
                        <tr>
                            <th> Date de livraison</th>
                            <td class="align-content-center text-center"> <span class="badge bg-light">{{ \Carbon\Carbon::parse($stock->delivery->delivery_date)->format('d/m/Y') }}</span></td>
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
                        <a href="{{route('stocks.consummation', $stock->id)}}"><i class="bi bi-repeat text-primary"></i></a>
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
