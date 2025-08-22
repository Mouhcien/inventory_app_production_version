<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques globales des équipements informatique</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group shadow-lg">
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-clipboard-check me-1"></i>
                            Nombre d'équipements informatiques
                            <span class="badge bg-primary rounded-pill">{{$total_materials}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-box-fill me-1"></i>
                            Nombre de modèles des équipements informatiques
                            <span class="badge bg-primary rounded-pill">{{$total_models}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-bank2 me-1"></i>
                            Nombre de marchés des équipements informatiques
                            <span class="badge bg-primary rounded-pill">{{$total_marchs}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-border-style me-1"></i>
                            Nombre de types d'équipements informatiques
                            <span class="badge bg-primary rounded-pill">{{$total_types}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-collection-fill me-1"></i>
                            Nombre de marques d'équipements informatiques
                            <span class="badge bg-primary rounded-pill">{{$total_brands}}</span>
                        </li>
                    </ul>

                    <ul class="list-group shadow-lg mt-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-stack me-1"></i>
                            @if ($total_inventories < $total_materials)
                                <span class="text-danger">Nombre d'équipements informatiques à l'inventaire</span>
                            <span class="badge bg-danger rounded-pill" title="Manque de {{$total_materials - $total_inventories}} equipements">{{$total_inventories}}</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-toggle-off me-1"></i>
                            Nombre d'équipements non attribués à un utilisateur
                            <span class="badge bg-primary rounded-pill">{{$total_materials_non_affected}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-tools me-1"></i>
                            Nombre d'équipements en état de panne
                            <span class="badge bg-primary rounded-pill">{{$total_materials_Broke}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-tools me-1"></i>
                            Nombre d'équipements en état de casse
                            <span class="badge bg-primary rounded-pill">{{$total_materials_Damaged}}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-primary">
                    <a href="{{route('statistics.material')}}" class="btn btn-sm btn-outline-warning" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-list me-2"></i> Voir les détails
                    </a>

                    <a href="" class="btn btn-sm btn-outline-success float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-earmark-excel me-2"></i> EXCEL
                    </a>

                    <a href="" class="btn btn-sm btn-outline-danger float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-pdf me-2"></i> PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques globales des employés du DRI-Marrakech</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group shadow-lg">
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-person-vcard"></i>
                            Nombre des employés du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_employees}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-diagram-3-fill me-2"></i>
                            Nombre des services du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_services}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-columns-gap me-2"></i>
                            Nombre des entités du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_entities}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-diamond-fill me-2"></i>
                            Nombre des secteurs du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_secters}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-diamond me-2"></i>
                            Nombre des sections du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_sections}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-globe"></i>
                            Nombre de villes au sein du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_cities}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-buildings"></i>
                            Nombre de locaux au sein du DRI-Marrakech
                            <span class="badge bg-primary rounded-pill">{{$total_locals}}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer border-primary">
                    <a href="{{route('statistics.employee')}}" class="btn btn-sm btn-outline-warning" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-list me-2"></i> Voir les détails
                    </a>

                    <a href="" class="btn btn-sm btn-outline-success float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-earmark-excel me-2"></i> EXCEL
                    </a>

                    <a href="" class="btn btn-sm btn-outline-danger float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-pdf me-2"></i> PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques globales des fournitures du DRI-Marrakech</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group shadow-lg">
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-clipboard-check me-1"></i>
                            Nombre de types de consommables
                            <span class="badge bg-primary rounded-pill">{{$total_types_consumables}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                            <i class="bi bi-box-fill me-1"></i>
                            Nombre de référence de consommables
                            <span class="badge bg-primary rounded-pill">{{$total_consumable}}</span>
                        </li>
                    </ul>

                    <ul class="list-group shadow-lg mt-4">
                        @foreach($stocks_by_deliveries as $delivery)
                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                <i class="bi bi-truck me-1"></i>
                                Livraison de :{{ \Carbon\Carbon::parse($delivery->delivery_date)->format('d/m/Y') }}
                                <span class="badge bg-info rounded-pill">{{$delivery->quantity_received}} : livré</span>
                                <span class="badge bg-warning rounded-pill">{{$delivery->quantity_reset}} : resté</span>
                                <span class="badge bg-success rounded-pill">{{$delivery->quantity_received - $delivery->quantity_reset}} : sorti</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-footer border-primary">
                    <a href="{{route('statistics.furniture')}}" class="btn btn-sm btn-outline-warning" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-list me-2"></i> Voir les détails
                    </a>

                    <a href="" class="btn btn-sm btn-outline-success float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-earmark-excel me-2"></i> EXCEL
                    </a>

                    <a href="" class="btn btn-sm btn-outline-danger float-end" >
                        <i class="bi bi-bar-chart-fill"></i> <i class="bi bi-file-pdf me-2"></i> PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
