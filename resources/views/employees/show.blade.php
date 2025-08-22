
<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <a href="{{route('employees.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-info-circle"></i>
                        Informations personnelles
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <table class="table table-light table-striped border-0 shadow-lg">
                        <tr>
                            <th> PPR </th>
                            <td> {{$employee->ppr}} </td>
                        </tr>
                        <tr>
                            <th> Prénom </th>
                            <td> {{$employee->firstname}} </td>
                        </tr>
                        <tr>
                            <th> Nom  </th>
                            <td> {{$employee->lastname}}</td>
                        </tr>
                        <tr>
                            <th> Email </th>
                            <td> {{$employee->email}} </td>
                        </tr>
                        <tr>
                            <th> N° de Téléphone  </th>
                            <td> {{$employee->tel}} </td>
                        </tr>
                        <tr>
                            <th> Local  </th>
                            <td> {{$employee->local->title}} </td>
                        </tr>
                        <tr>
                            <th> Ville  </th>
                            <td> {{$employee->local->city->title}} </td>
                        </tr>
                        <tr>
                            <th> Situation  </th>
                            <td>
                                @if ($employee->situation == 1)
                                    <span class="badge bg-success">Employé en poste</span>
                                @elseif($employee->situation == -1)
                                    <span class="badge bg-dark" >Employé retraité</span>
                                @elseif($employee->situation == -2)
                                    <span class="badge bg-info" >Employé muté</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-primary">
                    <x-button-traitement href="{{route('employees.edit', ['employee' => $employee->id, 'cat'=>'person' ])}}" class="btn btn-sm btn-warning ms-3 float-end" icon="bi bi-pencil" title="Editer les informations personnelles"   />
                </div>
            </div>

            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <i class="bi bi-info-circle"></i>
                        Informations professionnelles
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <table class="table table-light table-striped border-0 shadow-lg">
                        <tr>
                            <th> Service </th>
                            <td> {{$employee->service_entity->title}} </td>
                        </tr>
                        @if(!is_null($employee->entity))
                            <tr>
                                <th> Entité </th>
                                <td> {{$employee->entity->title}} </td>
                            </tr>
                        @endif
                        @if(!is_null($employee->secter_entity))
                            <tr>
                                <th> Secteur  </th>
                                <td> {{$employee->secter_entity->title}}</td>
                            </tr>
                        @endif
                        @if(!is_null($employee->section_entity))
                            <tr>
                                <th> Section </th>
                                <td> {{$employee->section_entity->title}} </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="card-footer border-primary">
                    <x-button-traitement href="{{route('employees.edit', ['employee' => $employee->id, 'cat'=>'prof' ])}}" class="btn btn-sm btn-warning ms-3 float-end" icon="bi bi-pencil" title="Editer les informations professionnelles"   />
                </div>
            </div>
        </div>
        <div class="col-4">
            @if(!is_null($inventories))
                @foreach($inventories as $inventory)
                    <x-material-card :inventory="$inventory" />
                @endforeach
            @else
                <p  class="text-danger"> pas d'affectation des matériels </p>
            @endif
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                    <div class="card-header border-primary">

                        <h5><i class="bi bi-hourglass-split"></i> Les demandes du consommables </h5>
                    </div>
                    <div class="card-body">
                        @forelse($consummations as $consummation)
                            <div class="row col-12 mb-3 shadow-lg rounded-5">
                                <div class="col-2 align-content-center text-center">
                                    <img class="rounded-5" src="data:image/png;base64,{{ base64_encode($consummation->stock_consumable->consumable->image) }}" width="64" height="64">
                                </div>
                                <div class="col-10 align-content-center">
                                    <span class="badge bg-info">{{ $consummation->quantity_required }} {{ $consummation->stock_consumable->consumable->type_consumable->title }} : </span>
                                    <span class="badge bg-light">{{ $consummation->stock_consumable->consumable->ref }}</span>
                                    <span class="badge bg-light">demandé Le : {{ \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y') }} </span>
                                </div>
                            </div>
                        @empty
                            <h5> Pas de demande  !!!!</h5>
                        @endforelse
                    </div>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $consummations->links() }}
                        </ul>
                    </div>
                </div>
        </div>
    </div>

</x-layout>
