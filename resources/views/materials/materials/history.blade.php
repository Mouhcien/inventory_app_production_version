<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <x-material-detail-card :material="$material" />
        </div>
        <div class="col-6">
            <div class="card border-primary mb-3">
                <h5 class="card-header">
                    Liste des affectations
                </h5>
                <div class="card-body">
                    @if(!is_null($inventories))
                        @foreach($inventories as $inventory)
                            <table class="table table-striped table-light border-1 shadow mb-3 {{!$inventory->is_active ? 'border-danger' : 'border-info'}}">
                                <tr>
                                    <th> Employée </th><td> {{$inventory->employee->firstname}} {{$inventory->employee->lastname}} </td>
                                </tr>
                                <tr>
                                    <th> PPR </th><td> {{$inventory->employee->ppr}} </td>
                                </tr>
                                <tr>
                                    <th> Email </th><td> {{$inventory->employee->email}} </td>
                                </tr>
                                <tr>
                                    <th> Téléphone </th><td> {{$inventory->employee->tel}} </td>
                                </tr>
                                <tr>
                                    <th> Service </th><td> {{$inventory->employee->service_entity->title}} </td>
                                </tr>
                                @if ($inventory->employee->entity != null)
                                    <tr>
                                        <th> Entity </th><td> {{$inventory->employee->entity->title}} </td>
                                    </tr>
                                @endif
                                @if ($inventory->employee->secter_entity != null)
                                    <tr>
                                        <th> Secteur </th><td> {{$inventory->employee->secter_entity->title}} </td>
                                    </tr>
                                @endif
                                @if ($inventory->employee->section_entity)
                                    <tr>
                                        <th> Section </th><td> {{$inventory->employee->section_entity->title}} </td>
                                    </tr>
                                @endif
                                <tr>
                                    <th> Local </th><td> {{$inventory->employee->local->title}} </td>
                                </tr>
                                <tr>
                                    <th> Ville </th><td> {{$inventory->employee->local->city->title}} </td>
                                </tr>
                                <tr>
                                    <th> Date d'affectation </th><td>{{ \Carbon\Carbon::parse($inventory->created_at)->format('d/m/Y H:m:s') }} </td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layout>
