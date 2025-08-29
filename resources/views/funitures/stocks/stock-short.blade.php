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
                    <div class="row col-12">
                        <div class="col-6">
                            <a href="{{route('stocks.index')}}" >Version complète</a>
                        </div>
                        <div class="col-6">

                        </div>
                    </div>

                </div>
                <div class="col-4">
                    @if (is_null($filter))
                        <a class="text-primary" href="{{ route('stocks.short.download') }}" ><i class="bi bi-download me-2"></i> Télécharger la liste des consommables </a>
                    @else
                        <a class="text-primary" href="{{ route('stocks.short.download', ['fltr' => $filter, 'val' => $value]) }}" ><i class="bi bi-download me-2"></i> Télécharger la liste des consommables </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body shadow">
            <table class="table table-light table-striped table-hover shadow">
                <thead>
                <th>  </th>
                <th> Consommable </th>
                <th> Type </th>
                <th class="align-content-center text-center"> Quantité livré </th>
                <th class="align-content-center text-center"> Quantité resté </th>
                <th>  </th>
                </thead>
                <tbody>
                @forelse($stocks as $stock)
                    <tr>
                        <td class="align-content-center text-center"> <img src="data:image/png;base64,{{ base64_encode($stock->image) }}" width="32" height="32"> </td>
                        <td class="align-content-center">
                            <span class="badge bg-light">{{ $stock->ref }} </span>
                        </td>
                        <td class="align-content-center">
                            <span class="badge bg-light"> {{ $stock->type }}</span>
                        </td>
                        <td class="align-content-center text-center"> <span class="badge bg-success">{{ $stock->quantity_received }}</span></td>
                        <td class="align-content-center text-center">
                            <span class="badge {{$stock->quantity_rest == 0 ? 'bg-danger' : 'bg-light'}}">{{ $stock->quantity_rest }}</span>
                        </td>
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
            <x-pagination-row :data="$stocks" />
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
                    <select class="form-control" id="short_type_consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_short_type_consumable_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par réference du consommable
                </div>
                <div class="card-body">
                    <select class="form-control" id="short_consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($consumables as $consumable)
                            <option value="{{$consumable->id}}">{{$consumable->ref}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_short_consumable_id" />
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
