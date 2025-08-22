<x-layout>

    <div class="card border-primary mb-3 shadow">
        <div class="card-header border-primary">
            <div class="row col-12">
                <div class="col-6 align-content-center">
                    <h5 class="card-title">
                        <a href="{{route('inventories.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-search me-1"></i> Rechercher dans L'inventaire des matériel informatique
                    </h5>
                </div>
                <div class="col-6 align-content-center">
                    @if(!is_null($filter))
                        <a class="text-success float-end" href="{{route('inventories.search.filter', $filter)}}" >
                            <i class="bi bi-download me-1"></i> Télécharger l'inventaire trouvé
                        </a>
                    @endif
                </div>
            </div>

        </div>
        <div class="card-body border-primary shadow">

            <div class="card border-primary mb-3 shadow">
                <form action="{{route('inventories.search')}}" method="GET">
                <div class="row col-12 m-3">
                    <div class="col-4">
                        <input type="text" name="fltr" class="form-control bg-light" placeholder="Entrez le filter" value="{{$filter ?? ''}}" >
                    </div>
                    <div class="col-2">
                        <x-button type="submit" class="btn btn-primary" text="Rechercher" />
                    </div>
                    <div class="col-6">

                    </div>
                </div>
                </form>
            </div>

            @if(!is_null($inventories))
                <x-inventory-row :inventories="$inventories" />
                <x-pagination-row :data="$inventories" />
            @endif


        </div>
    </div>

</x-layout>
