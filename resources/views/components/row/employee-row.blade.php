
@props(['employees'])

<table class="table table-striped table-striped table-hover shadow">
    <thead>
    <th> PPR </th>
    <th> Employée </th>
    <th> Entité </th>
    <th> Local </th>
    <th>  </th>
    </thead>
    <tbody>
    @forelse($employees as $employee)
        <tr>
            <td>
                <span class="badge bg-success"> {{ $employee->ppr }}</span>
            </td>
            <td> {{ $employee->lastname }} {{ $employee->firstname }} </td>
            <td>
                @if($employee->secter_entity)
                    <span class="badge bg-info">Secteur : </span><span class="badge bg-light">{{$employee->secter_entity->title}}</span> <br>
                @endif
                @if($employee->section_entity)
                    <span class="badge bg-info">Section : </span><span class="badge bg-light">{{ $employee->section_entity->title }} </span><br>
                @endif
                @if($employee->entity)
                    <span class="badge bg-info">Entité : </span><span class="badge bg-light">{{ $employee->entity->title }} </span><br>
                @endif
                <span class="badge bg-info">Service : </span><span class="badge bg-primary"> {{ $employee->service_entity->title }} </span>
            </td>
            <td>
                Local : <span class="badge bg-light">{{ $employee->local->title ?? '' }} </span><br>
                Ville : <span class="badge bg-primary">{{ $employee->local->city->title ?? '' }}</span>
            </td>
            <td>
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-tools"></i></button>
                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                            <x-button-traitement href="{{route('employees.show', $employee->id)}}" class="btn btn-sm btn-info ms-3" icon="bi bi-list-columns" />
                            @if(config('app.delete'))
                                <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$employee->id}}" />
                            @endif
                        </div>
                    </div>
                    <x-confirmation-modal
                        href="{{route('employees.destroy', $employee->id)}}"
                        target="deleteModal{{$employee->id}}"
                        title="Confirmation"
                        message="Voulez vous vraiment supprimer cette entité ?" />
                </div>
            </td>
        </tr>
    @empty
        <tr class="align-content-center text-center">
            <td colspan="6"> <h5> Pas des employées !!!!</h5> </td>
        </tr>
    @endforelse
    </tbody>
</table>
