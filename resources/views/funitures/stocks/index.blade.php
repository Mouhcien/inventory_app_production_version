<x-layout>
    <div class="card border-primary mb-3 shadow">
        <div class="card-header">
            <div class="row col-12">
                <div class="col-4">
                    <h5 class="card-title">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasStockConsumableFiltrage" aria-controls="offcanvasStockConsumableFiltrage">
                            <i class="bi bi-filter"></i>
                        </a>
                        <i class="bi bi-house me-1"></i> Les stocks du consommable
                    </h5>
                </div>
                <div class="col-4">
                    <select class="form-control-sm form-control shadow-lg" name="delivery_year" id="sl_stock_delivery_year">
                        <option value="0"> Séléctionnez l'anné de livraison </option>
                        @foreach($years as $year)
                            <option {{$year->year == $selectedYear ? 'selected': ''}} value="{{$year->year}}"> {{$year->year}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <a href="{{route('stocks.export', ['filter' => $filter, 'value' => $value])}}" class="text-success me-2 float-end" >
                        <i class="bi bi-download me-1"></i>Télécharger toutes les consommations
                    </a>
                    <a href="{{route('stocks.filter.advance')}}" class="text-info me-2 float-end" > <i class="bi bi-filter-circle me-1"></i>Filtrage Avancée </a>
                </div>
            </div>
        </div>
        <div class="card-body shadow">
            <table class="table table-light table-striped table-hover shadow">
                <thead>
                    <th>  </th>
                    <th> Consommable </th>
                    <th> Type </th>
                    <th> Imprimante(s) </th>
                    <th class="align-content-center text-center"> Quantité livré </th>
                    <th class="align-content-center text-center"> Quantité resté </th>
                    <th> Date de livraison </th>
                    <th>  </th>
                </thead>
                <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td class="align-content-center text-center"> <img src="data:image/png;base64,{{ base64_encode($stock->consumable->image) }}" width="32" height="32"> </td>
                        <td class="align-content-center">
                            <span class="badge bg-light">{{ $stock->consumable->ref }} </span>
                        </td>
                        <td class="align-content-center"> {{ $stock->consumable->type_consumable->title }}</td>
                        <td class="align-content-center">
                            @if(count($stock->consumable->fittings) != 0)
                                @foreach($stock->consumable->fittings as $fitting)
                                    <img src="data:image/png;base64,{{ base64_encode($fitting->model_material->image_data) }}" width="32" height="32">
                                    <span class="badge badge-bg">{{$fitting->model_material->title}}</span> <br>
                                @endforeach
                            @endif
                        </td>
                        <td class="align-content-center text-center"> <span class="badge bg-success">{{ $stock->quantity_received }}</span></td>
                        <td class="align-content-center text-center">
                            <span class="badge {{$stock->quantity_rest == 0 ? 'bg-danger' : 'bg-light'}}">{{ $stock->quantity_rest }}</span>
                        </td>
                        <td class="align-content-center text-center"> {{ \Carbon\Carbon::parse($stock->delivery->delivery_date)->format('d/m/Y') }}</td>
                        <td class="align-content-center text-center">
                            <x-button-traitement href="{{route('stocks.consummation', $stock->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Détail des consommations"  />
                        </td>
                    </tr>
                @empty
                    <tr class="align-content-center text-center">
                        <td colspan="3"> <h5> Pas des stocks !!!!</h5> </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                <ul class="pagination pagination-sm">
                    {{ $stocks->links() }}
                </ul>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1"
         id="offcanvasStockConsumableFiltrage" aria-labelledby="offcanvasStockConsumableFiltrage">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-filter"></i> Filtrage </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par type de consommable
                </div>
                <div class="card-body">
                    <select class="form-control" id="type_consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_type_consumable_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par réference du consommable
                </div>
                <div class="card-body">
                    <select class="form-control" id="consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($consumables as $consumable)
                            <option value="{{$consumable->id}}">{{$consumable->ref}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consumable_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par modèle d'imprimante
                </div>
                <div class="card-body">
                    <select class="form-control" id="printer_model_material_id">
                        <option value="0">--------------------------------</option>
                        @foreach($models_printers as $models_printer)
                            <option value="{{$models_printer->id}}">{{$models_printer->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_printer_model_material_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par modèle des photocopie
                </div>
                <div class="card-body">
                    <select class="form-control" id="big_printer_model_material_id">
                        <option value="0">--------------------------------</option>
                        @foreach($models_big_printers as $models_big_printer)
                            <option value="{{$models_big_printer->id}}">{{$models_big_printer->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_big_printer_model_material_id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
