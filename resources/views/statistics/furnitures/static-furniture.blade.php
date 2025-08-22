<x-layout>
    <div class="card border-primary shadow-lg">
        <div class="card-header">
            <h5>Séléctionnez l'année : </h5>
        </div>
        <div class="card-body">
            <div>
                <select name="sl_delivery_year" class="form-control" id="sl_stat_delivery_year" >
                    <option value="0"> ----------------------------- </option>
                        @if($selectedYear != null)
                            @foreach($years as $year)
                                <option {{ $year->year == $selectedYear ? 'selected' : '' }} value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        @else
                            @foreach($years as $year)
                                <option value="{{$year->year}}">{{$year->year}}</option>
                            @endforeach
                        @endif
                </select>
            </div>
        </div>
    </div>
    <div class="row col-12 mt-4">
        <div class="col-6">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i><i class="bi bi-truck me-2"></i>Statistiques des fournitures par année de livraison {{$selectedYear}}</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group shadow-lg">
                        @foreach($stocks_by_year as $delivery)
                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                <i class="bi bi-truck me-1"></i>
                                Année : {{$delivery->delivery_year}}
                                <span class="badge bg-info rounded-pill">{{$delivery->quantity_received}} : livré</span>
                                <span class="badge bg-warning rounded-pill">{{$delivery->quantity_reset}} : resté</span>
                                <span class="badge bg-success rounded-pill">{{$delivery->quantity_received - $delivery->quantity_reset}} : sorti</span>
                            </li>
                        @endforeach
                    </ul>

                    <ul class="list-group shadow-lg mt-4">
                        @foreach($stocks_detail_type_by_year as $type)
                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                <i class="bi bi-truck me-1"></i>
                                {{$type->title}} de l'année : {{$type->delivery_year}}
                                <span class="badge bg-info rounded-pill">{{$type->quantity_received}} : livré</span>
                                <span class="badge bg-warning rounded-pill">{{$type->quantity_reset}} : resté</span>
                                <span class="badge bg-success rounded-pill">{{$type->quantity_received - $type->quantity_reset}} : sorti</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des fournitures par référence de l'année {{$selectedYear}} </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group shadow-lg">
                        @foreach($stocks_detail_by_year as $delivery)
                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                <i class="bi bi-truck me-1"></i>
                                {{$delivery->title}} :
                                <b>{{$delivery->ref}}</b>
                                <span class="badge bg-info rounded-pill">{{$delivery->quantity_received}} : livré</span>
                                <span class="badge bg-warning rounded-pill">{{$delivery->quantity_reset}} : resté</span>
                                <span class="badge bg-success rounded-pill">{{$delivery->quantity_received - $delivery->quantity_reset}} : sorti</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

    </div>
</x-layout>
