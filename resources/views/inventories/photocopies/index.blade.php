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
                    <a href="{{route('inventories.photocopies.export')}}" class="text-primary float-end" ><i class="bi bi-download"></i> Télécharger la liste des photocopies</a>
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow-lg">
            <x-inventory-photocopy-row :inventories="$photocopies" />
            <x-pagination-row :data="$photocopies" />
        </div>
    </div>
</x-layout>
