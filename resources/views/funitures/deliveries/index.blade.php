<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    <div class="row col-12">
                        <div class="col-6">
                            <h5 class="card-title">
                                <i class="bi bi-truck me-1"></i> Les livraisons du consommable
                            </h5>
                        </div>
                        <div class="col-6">
                            <select class="form-control-sm form-control shadow-lg" name="delivery_year" id="sl_delivery_year">
                                <option value="0"> Séléctionnez l'anné de livraison </option>
                                @foreach($years as $year)
                                    <option {{$year->year == $selectedYear ? 'selected': ''}} value="{{$year->year}}"> {{$year->year}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-body border-primary shadow">
                    <table class="table table-light table-striped table-hover border-0 shadow">
                        <thead>
                        <th> Date de livrasion </th>
                        <th> Titre </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($deliveries as $delivery)
                            <tr>
                                <td>
                                    <span class="badge bg-light shadow-lg"> {{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d/m/Y') }} </span>
                                </td>
                                <td title="{{$delivery->observation}}">
                                    <span class="badge bg-light shadow-lg"> {{ $delivery->title }} </span>
                                </td>
                                <td>
                                    <x-button-traitement href="{{route('deliveries.edit', $delivery->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer"  />
                                    <x-button-traitement href="{{route('deliveries.show', $delivery->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                                    <x-button-traitement href="{{route('deliveries.stock', $delivery->id)}}" class="btn btn-sm btn-light" icon="bi bi-list" title="détail de stock"  />
                                    @if (!$delivery->is_valid)
                                    <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$delivery->id}}" title="Supprimer" />
                                    <x-confirmation-modal
                                        href="{{route('deliveries.destroy', $delivery->id)}}"
                                        target="deleteModal{{$delivery->id}}"
                                        title="Confirmation"
                                        message="Voulez vous vraiment supprimer cette livrasion ?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des livrasions !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <x-pagination-row :data="$deliveries" />
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> {{$title}}
                    </h5>
                </div>
                <div class="card-body border-primary shadow">
                    <form action="{{route($url, $id)}}" method="POST">
                        @csrf
                        <div>
                            <x-input-text
                                label="Titre"
                                name="title"
                                class="form-control"
                                placeholder="Titre"
                                id="deliveryTitle"
                                :value="$editedDelivery->title ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-date
                                label="Date de livrasion"
                                name="delivery_date"
                                class="form-control"
                                placeholder="La date de livrasion"
                                id="deliveryDate"
                                :value="$editedDelivery->delivery_date ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-textfield
                                label="Observbation"
                                placeholder="Observation"
                                name="observation"
                                class="form-control"
                                id="observation"
                                value="{{$editedDelivery->observation ?? '' }}" />
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
