
<x-layout>
    <div class="card border-primary mb-3 shadow">
        <div class="card-header">
            <div class="row col-12">
                <div class="col-6 align-content-center">
                    <h5 class="card-title">
                        <i class="bi bi-people me-1"></i> Les employées du DRI Marrakech <span class="badge bg-primary">Total : {{$total}}</span>
                    </h5>
                </div>
                <div class="col-6 align-content-center">
                    <a href="{{route('employees.create')}}" class="btn btn-primary float-end float-end" >
                        <i class="bi bi-plus-square"></i> Nouveau Employée
                    </a>

                    <a href="{{route('employees.search')}}" class="btn btn-light float-end me-2" >
                        <i class="bi bi-search"></i> Rechercher
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body shadow">
            <x-employee-row :employees="$employees" />

            <x-pagination-row :data="$employees" />
        </div>
    </div>
</x-layout>
