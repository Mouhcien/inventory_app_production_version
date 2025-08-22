<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    <h5 class="card-title">
                        <a href="{{route('deliveries.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-truck me-1"></i> {{$delivery->title}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover border-0 shadow">
                        <tbody>
                        <tr>
                            <th class="align-content-center"> Date de livarsion </th>
                            <td class="align-content-center">
                                <span class="badge bg-light">{{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d/m/Y') }}</span>
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
                            <th class="align-content-center"> Consommables </th>
                            <td>
                                @if(count($delivery->stocks_consumables) != 0)
                                    <div class="row col-12">
                                    @foreach($delivery->stocks_consumables as $stock)

                                        <div class="col-4">
                                            <div class="card border-primary mb-3 shadow">
                                                <div class="card-header">
                                                    <div class="row">
                                                        <span class="badge badge-bg">
                                                            {{$stock->consumable->type_consumable->title}} :
                                                            {{$stock->consumable->ref}}
                                                        </span>
                                                        @if ($stock->quantity_rest == $stock->quantity_received)
                                                        <a class="text-danger text-center align-content-center" href="{{route('stocks.destroy', $stock->id)}}" title="Supprimer" ><i class="bi bi-x-square"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-body text-center align-content-center">
                                                    <img src="data:image/png;base64,{{ base64_encode($stock->consumable->image) }}" width="64" height="64">
                                                </div>
                                                <div class="card-footer">
                                                    Quantité livré : <span class="badge bg-success">{{$stock->quantity_received}}</span><br>
                                                    Quantité resté : <span class="badge bg-danger">{{$stock->quantity_rest}}</span>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                    </div>
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
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    <h5 class="card-title">
                        <i class="bi bi-truck me-1"></i> Ajouter le consommable à cette livrasion
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('stocks.store', $delivery->id)}}" method="POST">
                        @csrf
                        <div>
                            <label class="col-form-label mt-4" for="consumable_id">Type de consommable</label>
                            <select name="consumable_id" class="form-control" id="consumable_id" >
                                @foreach($consumables as $consumable)
                                    <option value="{{$consumable->id}}">{{$consumable->type_consumable->title}} : {{$consumable->ref}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-text
                                label="Quantité"
                                name="quantity_received"
                                class="form-control"
                                placeholder="Quantité"
                                id="stockQuantityReceived"
                            />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-layout>
