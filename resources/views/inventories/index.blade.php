<x-layout>

    <div class="card border-primary mb-3 shadow">
        <div class="card-header border-primary">
            <div class="row col-12">
                <div class="col-4 align-content-center">
                    <h5 class="card-title">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasMaterialFiltrage" aria-controls="offcanvasMaterialFiltrage">
                            <i class="bi bi-filter"></i>
                        </a>
                        <i class="bi bi-clipboard-check me-1"></i> L'inventaire des matériel informatique
                    </h5>
                </div>
                <div class="col-4 align-content-center">
                    <a href="{{route('inventories.search')}}" > <i class="bi bi-search me-2"></i> Rechercher sur l'inventaire</a>
                    <a href="{{route('inventories.check')}}" class="ms-3" > <i class="bi bi-check2-circle me-2"></i> Vérifier l'inventaire</a>
                </div>
                <div class="col-4 align-content-center" >
                    <a class="btn btn-sm btn-primary float-end" href="{{route('inventories.create')}}" > <i class="bi bi-clipboard-plus me-1"></i> Nouvelle Affectation </a>
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow">

            <div class="card border-primary mb-3 rounded-5 shadow">
                <div class="row col-12 m-3">
                    <div class="col-4">
                        <a class="text-info" href="{{route('inventories.advance')}}" >
                            <i class="bi bi-filter"></i>  Filtrage Avancée
                        </a>
                    </div>
                    <div class="col-8">
                        @if (is_null($is_filter))
                        <a class="text-success" href="{{route('inventories.export')}}" >
                            <i class="bi bi-download me-1"></i> Télécharger l'inventaire complète
                        </a>
                        @else
                            <a class="text-success" href="{{route('inventories.export.filter', ['filter' => $filter, 'value' => $value])}}" >
                                <i class="bi bi-download me-1"></i> Télécharger l'inventaire filtré
                            </a>
                        @endif
                        <a class="text-danger float-end me-3" href="{{route('inventories.prepare')}}" >
                            <i class="bi bi-upload me-1"></i> Importer le fichier Excel
                        </a>
                    </div>
                </div>
            </div>

            <x-inventory-row :inventories="$inventories" />
            <x-pagination-row :data="$inventories" />
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
                    <select class="form-control" id="inv_type_material_id">
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_inv_type_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par marque
                </div>
                <div class="card-body">
                    <select class="form-control" id="inv_brand_material_id">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_inv_brand_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par modèle
                </div>
                <div class="card-body">
                    <select class="form-control" id="inv_model_material_id">
                        @foreach($models as $model)
                            <option value="{{$model->id}}">{{$model->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_inv_model_material" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    Filtrez par marché
                </div>
                <div class="card-body">
                    <select class="form-control" id="inv_march_material_id">
                        @foreach($marchs as $march)
                            <option value="{{$march->id}}">{{$march->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_inv_march_material" />
                    </div>
                </div>
            </div>
            <div>
                <a href="{{route('inventories.photocopies')}}" class="btn btn-info" >Gestion des photocopies </a>
            </div>
        </div>
    </div>

</x-layout>
