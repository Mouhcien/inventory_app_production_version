<x-layout>

    <div class="card border-primary mb-3 shadow">
        <div class="card-header">
            <div class="row col-12">
                <div class="col-6">
                    <h5 class="card-title">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasMaterialFiltrage" aria-controls="offcanvasMaterialFiltrage">
                            <i class="bi bi-filter"></i>
                        </a>
                        <i class="bi bi-clipboard-check me-1"></i> Les matériels <span class="badge bg-primary">Total : {{$total}}</span>
                    </h5>
                </div>
                <div class="col-6" >
                    <a class="btn btn-sm btn-primary float-end" href="{{route('materials.create')}}" > <i class="bi bi-clipboard-plus me-1"></i> Nouveau Matériel </a>
                </div>
            </div>

        </div>
        <div class="card-body shadow">

            <div class="card border-primary mb-2 shadow">
                <div class="row col-12 m-3">
                    <div class="col-4">
                        <a class="text-info" href="{{route('materials.advance')}}" >
                            <i class="bi bi-filter"></i>  Filtrage Avancée
                        </a>
                    </div>
                    <div class="col-8">
                        <a class="text-success float-end me-3" href="{{route('materials.export')}}" title="Exporter fichier Excel" >
                            <i class="bi bi-download me-1"></i> Exporter le fichier Excel
                        </a>
                    </div>
                </div>
            </div>

            <x-material-row :materials="$materials" />
            <x-pagination-row :data="$materials" />
        </div>
    </div>

    <!-- Box Filtrage Materails -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasMaterialFiltrage" aria-labelledby="offcanvasMaterialFiltrage">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-filter"></i> Filtrage </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par type
                </div>
                <div class="card-body">
                    <select class="form-control" id="type_material_id">
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_type_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par marque
                </div>
                <div class="card-body">
                    <select class="form-control" id="brand_material_id">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_brand_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par modèle
                </div>
                <div class="card-body">
                    <select class="form-control" id="model_material_id">
                        @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_model_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par marché
                </div>
                <div class="card-body">
                    <select class="form-control" id="march_material_id">
                        @foreach($marchs as $march)
                            <option value="{{$march->id}}">{{$march->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_march_material" />
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
