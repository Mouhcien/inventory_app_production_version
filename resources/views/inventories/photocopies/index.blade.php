<x-layout>
    <div class="card border-primary shadow-lg">
        <div class="card-header border-primary shadow-lg">
            <div class="row col-12">
                <div class="col-6">
                    <h5>
                        <a href="{{route('inventories.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        Les photocopies du DRI-Marrakech
                    </h5>
                </div>
                <div class="col-6">
                    <a href="{{route('inventories.photocopies.vacant')}}" class="text-dark" ><i class="bi bi-arrow-down-circle"></i> Les photocopies vacants</a>

                    @if ($option == "photocopy_vacant")
                        <a href="{{route('inventories.photocopies..vacant.export')}}" class="text-primary float-end" ><i class="bi bi-download"></i> Télécharger la liste des photocopies</a>
                    @else
                        <a href="{{route('inventories.photocopies.export')}}" class="text-primary float-end" ><i class="bi bi-download"></i> Télécharger la liste des photocopies</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow-lg">
            @if (is_null($option))
                <x-inventory-photocopy-row :inventories="$photocopies" />
            @else
                <x-material-row :materials="$photocopies" />
            @endif
            <x-pagination-row :data="$photocopies" />
        </div>
    </div>
</x-layout>
