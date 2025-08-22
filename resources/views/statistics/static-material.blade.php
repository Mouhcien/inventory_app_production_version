<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary shadow-lg">
                <div class="card-header border-primary">
                    <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par modèle</h5>
                </div>
                <div class="card-body">
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
        <div class="col-4">
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
        <div class="col-4">
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
</x-layout>
