
@props(['inventories'])

@forelse($inventories as $inventory)
    <div class="row col-12 mt-4 mb-2 border border-dark rounded-5 shadow-lg">
        <div class="col-1 mt-3 align-content-center">
            <div class="btn-group float-end" role="group" aria-label="Button group with nested dropdown">
                <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-tools"></i></button>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                        <x-button-traitement href="{{route('inventories.edit', $inventory->id)}}" class="btn btn-sm btn-warning ms-3" icon="bi bi-pencil" title="Editer"  />
                        <x-button-traitement href="{{route('inventories.show', $inventory->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mt-3">
            <x-material-card :inventory="$inventory" />
        </div>
        <div class="col-6 mt-3">
            <div class="card mb-3 shadow border-primary">
                <div class="card-header border-primary">
                    <h5> <i class="bi bi-people-fill me-2"></i>{{ $inventory->employee->firstname }} {{ $inventory->employee->lastname }}</h5>
                </div>
                <div class="card-body">
                    @if($inventory->employee->secter_entity)
                        <span class="badge bg-light mt-2"><i class="bi bi-diamond-fill me-2"></i>{{ $inventory->employee->secter_entity->title}}</span> <br>
                    @endif
                    @if($inventory->employee->section_entity)
                        <span class="badge bg-light mt-2"><i class="bi bi-diamond me-2"></i>{{ $inventory->employee->section_entity->title}}</span> <br>
                    @endif
                    @if($inventory->employee->entity)
                        <span class="badge bg-light mt-2"><i class="bi bi-columns-gap me-2"></i>{{ $inventory->employee->entity->title}}</span> <br>
                    @endif
                </div>
                <div class="card-footer border-primary">
                    <span class="badge bg-primary mt-2"><i class="bi bi-diagram-3-fill me-2"></i>{{ $inventory->employee->service_entity->title }}</span> <br>
                </div>
            </div>
        </div>
        <div class="col-2 mt-3">
            <div class="card mb-3 shadow border-primary">
                <div class="card-header border-primary">
                    <h5> <i class="bi bi-buildings-fill me-2"></i>Local</h5>
                </div>
                <div class="card-body border-primary">
                    <span class="badge bg-light shadow">{{ $inventory->employee->local->title }}</span>
                </div>
                <div class="card-footer border-primary">
                    <span class="badge bg-info me-1">Ville : </span><span class="badge bg-primary">{{ $inventory->employee->local->city->title }}</span>
                </div>
            </div>
        </div>
    </div>
@empty
    <h5> Inventaire est vide !!!!</h5>
@endforelse

