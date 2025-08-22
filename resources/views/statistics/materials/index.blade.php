<x-layout>

    <div class="card border-primary shadow-lg">
        <div class="card-header border-primary shadow-lg">
            <h5>
                Statistiques des équipements informatiques
            </h5>
        </div>
        <div class="card-body border-primary shadow-lg">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab" tabindex="-1">Global</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#profile" aria-selected="false" role="tab">Statistiques par modèles</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link"  data-bs-toggle="tab" href="#march" aria-selected="false" tabindex="-1" role="tab">Statistiques par marché</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link"  data-bs-toggle="tab" href="#brandtype" aria-selected="false" tabindex="-1" role="tab">Statistiques par Type/Marque</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane active fade show" id="home" role="tabpanel">
                    <div class="card border-primary shadow-lg">
                        <div class="card-header border-primary">
                            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques globales des équipements informatique</h5>
                        </div>
                        <div class="card-body">
                            <div class="row col-12">
                                <div class="col-6 align-content-center">
                                    <ul class="list-group shadow-lg">
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <span class="badge bg-light"> Nombre d'équipements informatiques</span>
                                            <span class="badge bg-primary rounded-pill">{{$total_materials}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            @if ($total_inventory < $total_materials)
                                                <span class="badge bg-danger">Nombre d'équipements informatiques à l'inventaire</span>
                                                <span class="badge bg-danger rounded-pill" title="Manque de {{$total_materials - $total_inventory}} equipements">{{$total_inventory}}</span>
                                            @elseif($total_inventory == $total_materials)
                                                <span class="badge bg-light">Nombre d'équipements informatiques à l'inventaire</span>
                                                <span class="badge bg-success rounded-pill" >{{$total_inventory}}</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <canvas id="invMainChart"></canvas>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-6 align-content-center">
                                    <ul class="list-group shadow-lg mt-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <span class="badge bg-light">Nombre d'équipements non attribués à un utilisateur</span>
                                            <span class="badge bg-primary rounded-pill">{{$total_materials_non_affected}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <span class="badge bg-light">Nombre d'équipements en état de panne</span>
                                            <span class="badge bg-primary rounded-pill">{{$total_materials_Broke}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <span class="badge bg-light">Nombre d'équipements en état de casse</span>
                                            <span class="badge bg-primary rounded-pill">{{$total_materials_Damaged}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <canvas id="chartBrokeDamageMaterial"></canvas>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-6">
                                    <ul class="list-group shadow-lg mt-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-pc me-1"></i>
                                            <span class="badge bg-light"> Pc Fixe </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_pc}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-printer me-1"></i>
                                            <span class="badge bg-light"> Imprimantes </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_printers}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-laptop me-1"></i>
                                            <span class="badge bg-light"> Pc Portable </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_laptops}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-upc-scan me-1"></i>
                                            <span class="badge bg-light"> Scanner </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_scanners}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <canvas id="materialTypeChart"></canvas>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-6 align-content-center">
                                    <ul class="list-group shadow-lg mt-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-pc me-1"></i>
                                            <span class="badge bg-light"> Total des équipement informatique au DRI-Marrakech </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_materials}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-people me-1"></i>
                                            <span class="badge bg-light"> Total des employés du DRI-Marrakech </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_employees}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <canvas id="mainChart"></canvas>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-6 align-content-center">
                                    <ul class="list-group shadow-lg mt-4">
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-pc me-1"></i>
                                            <span class="badge bg-light"> Pc Fixe </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_pc}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-printer me-1"></i>
                                            <span class="badge bg-light"> Imprimantes </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_printers}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                            <i class="bi bi-people me-1"></i>
                                            <span class="badge bg-light"> Total des employés du DRI-Marrakech </span>
                                            <span class="badge bg-primary rounded-pill">{{$total_employees}}</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <canvas id="secondChart"></canvas>
                                </div>
                            </div>
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
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <div class="card border-primary shadow-lg">
                        <div class="card-header border-primary">
                            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par modèle</h5>
                        </div>
                        <div class="card-body">
                            <div class="row col-12">
                                <div class="col-6">
                                    <ul class="list-group shadow-lg">
                                        @foreach($models as $model)
                                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                                <img src="data:image/png;base64,{{ base64_encode($model->image_data) }}" width="32" height="32">
                                                {{$model->title}}
                                                <span class="badge bg-primary rounded-pill">Livré dans {{count($model->deliveries_material)}} marché</span>
                                                @php
                                                    $totalMaterials = 0; // Initialize the total variable
                                                @endphp
                                                @foreach($model->deliveries_material as $delivery)
                                                    @php
                                                        $totalMaterials += count($delivery->materials); // Add the count of materials in this delivery to the total
                                                    @endphp
                                                @endforeach
                                                <span class="badge bg-success rounded-pill">Total Matériels : {{$totalMaterials}} </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-primary">
                            <a href="" class="btn btn-sm btn-outline-warning" >
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
                <div class="tab-pane fade" id="march" role="tabpanel">
                    <div class="row col-12">
                        <div class="col-6">
                            <div class="card border-primary shadow-lg">
                                <div class="card-header border-primary">
                                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par marché</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group shadow-lg">
                                        @foreach($marchs as $march)
                                            <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                                <i class="bi bi-bank2"></i>
                                                {{$march->title}}
                                                <span class="badge bg-primary rounded-pill">Modèles : {{count($march->deliveries_material)}}</span>
                                                @php
                                                    $totalMaterials = 0; // Initialize the total variable
                                                @endphp
                                                @foreach($march->deliveries_material as $delivery)
                                                    @php
                                                        $totalMaterials += count($delivery->materials); // Add the count of materials in this delivery to the total
                                                    @endphp
                                                @endforeach
                                                <span class="badge bg-success rounded-pill">Total Matériels : {{$totalMaterials}} </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="card-footer border-primary">
                                    <a href="" class="btn btn-sm btn-outline-warning" >
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
                        <div class="col-6">

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="brandtype" role="tabpanel" >
                    <div class="card border-primary shadow-lg">
                        <div class="card-header border-primary">
                            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par type/marque</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group shadow-lg">
                                @foreach($types as $type)
                                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                        @if ($type->title == 'PC Fixe')
                                            <i class="bi bi-pc me-1"></i>
                                        @elseif ($type->title == 'Imprimante')
                                            <i class="bi bi-printer-fill me-1"></i>
                                        @elseif ($type->title == 'PC')
                                            <i class="bi bi-printer-fill me-1"></i>
                                        @elseif ($type->title == 'Scanner')
                                            <i class="bi bi-qr-code-scan me-1"></i>
                                        @elseif ($type->title == 'PC Portable')
                                            <i class="bi bi-laptop me-1"></i>
                                        @else
                                            <i class="bi bi-tools me-1"></i>
                                        @endif
                                        {{$type->title}}
                                        <span class="badge bg-primary rounded-pill">Modèles : {{count($type->models_material)}}</span>
                                        @php
                                            $totalMaterials = 0; // Initialize the total variable
                                        @endphp
                                        @foreach($type->models_material as $model)
                                            @foreach($model->deliveries_material as $delivery)
                                                @php
                                                    $totalMaterials += count($delivery->materials); // Add the count of materials in this delivery to the total
                                                @endphp
                                            @endforeach
                                        @endforeach
                                        <span class="badge bg-success rounded-pill">Total Matériels : {{$totalMaterials}} </span>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="list-group shadow-lg mt-4">
                                @foreach($brands as $brand)
                                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                                        <img src="data:image/png;base64,{{ base64_encode($brand->logo_data) }}" width="32" height="32">
                                        {{$brand->title}}
                                        <span class="badge bg-primary rounded-pill">Modèles : {{count($brand->models_material)}}</span>
                                        @php
                                            $totalMaterials = 0; // Initialize the total variable
                                        @endphp
                                        @foreach($brand->models_material as $model)
                                            @foreach($model->deliveries_material as $delivery)
                                                @php
                                                    $totalMaterials += count($delivery->materials); // Add the count of materials in this delivery to the total
                                                @endphp
                                            @endforeach
                                        @endforeach
                                        <span class="badge bg-success rounded-pill">Total Matériels : {{$totalMaterials}} </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer border-primary">
                            <a href="" class="btn btn-sm btn-outline-warning" >
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
        </div>
    </div>

    <div>
        <input type="hidden" value="{{$total_materials}}" id="txt_total_materials">
        <input type="hidden" value="{{$total_employees}}" id="txt_total_employees">
        <input type="hidden" value="{{$total_pc}}" id="txt_total_pc">
        <input type="hidden" value="{{$total_printers}}" id="txt_total_printer">
        <input type="hidden" value="{{$total_inventory}}" id="txt_total_inventory">
        <input type="hidden" value="{{$total_scanners}}" id="txt_total_scanner">
        <input type="hidden" value="{{$total_big_printers}}" id="txt_total_big_printer">
        <input type="hidden" value="{{$total_laptops}}" id="txt_total_laptop">
        <input type="hidden" value="{{$total_materials_Broke}}" id="txt_total_broke">
        <input type="hidden" value="{{$total_materials_Damaged}}" id="txt_total_damage">
        <input type="hidden" value="{{$total_materials_non_affected}}" id="txt_not_affetcted">
    </div>
</x-layout>
