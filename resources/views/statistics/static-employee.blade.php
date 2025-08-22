<x-layout>
    <div class="card border-primary shadow-lg mt-4">
        <div class="card-header border-primary">
            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par Service</h5>
        </div>
        <div class="card-body">
            <ul class="list-group shadow-lg">
                @foreach($inventories_services as $inv_service)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                        {{$inv_service['title']}}
                        <span class="badge bg-info rounded-pill"> {{$inv_service['employees_nbr']}} employés</span>
                        <span class="badge bg-primary rounded-pill"> {{$inv_service['inventories_nbr']}} équipements</span>
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

    <div class="card border-primary shadow-lg mt-4">
        <div class="card-header border-primary">
            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par Entité</h5>
        </div>
        <div class="card-body">
            <ul class="list-group shadow-lg">
                @foreach($inventories_entities as $inv_entity)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                        {{$inv_entity['title']}}
                        <span class="badge bg-info rounded-pill"> {{$inv_entity['employees_nbr']}} employés</span>
                        <span class="badge bg-primary rounded-pill"> {{$inv_entity['inventories_nbr']}} équipements</span>
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

    <div class="card border-primary shadow-lg mt-4">
        <div class="card-header border-primary">
            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par Secteur</h5>
        </div>
        <div class="card-body">
            <ul class="list-group shadow-lg">
                @foreach($inventories_secters as $inv_secter)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                        {{$inv_secter['title']}}
                        <span class="badge bg-info rounded-pill"> {{$inv_secter['employees_nbr']}} employés</span>
                        <span class="badge bg-primary rounded-pill"> {{$inv_secter['inventories_nbr']}} équipements</span>
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

    <div class="card border-primary shadow-lg mt-4">
        <div class="card-header border-primary">
            <h5><i class="bi bi-bar-chart-fill me-2"></i>Statistiques des équipements informatique par Section</h5>
        </div>
        <div class="card-body">
            <ul class="list-group shadow-lg mt-4">
                @foreach($inventories_sections as $inv_section)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-lg mt-1 border-primary">
                        {{$inv_section['title']}}
                        <span class="badge bg-info rounded-pill"> {{$inv_section['employees_nbr']}} employés</span>
                        <span class="badge bg-primary rounded-pill"> {{$inv_section['inventories_nbr']}} équipements</span>
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

</x-layout>
