<x-layout>
    <div class="card border-primary mb-3 shadow-lg">
        <div class="card-header border-primary shadow-lg">
            <div class="row col-12">
                <div class="col-6">
                    <h5>
                        <a href="{{route('locals.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <span class="badge bg-info" >Local :</span>
                        <span class="badge bg-light">{{$local->title}}</span>
                    </h5>
                </div>
                <div class="col-6">
                    <span class="badge bg-success float-end">Total : {{$total}} équipements</span>
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow-lg">
            <x-inventory-row :inventories="$inventories" />
            <x-pagination-row :data="$inventories" />
        </div>
    </div>
</x-layout>
