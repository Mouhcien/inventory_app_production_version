
@props(['materials'])

<table class="table table-light table-striped table-hover border-0 shadow">
    <thead>
    <th> Série </th>
    <th> Modèle</th>
    <th> Type </th>
    <th> Marque </th>
    <th> Marché</th>
    <th> IP</th>
    <th> </th>
    </thead>
    <tbody>
    @forelse($materials as $material)
        <tr>
            <td class="align-content-center">
                @if($material->state == 1)
                    <span class="badge bg-success" title="OK"> {{$material->serial}} </span>
                @elseif($material->state == -1)
                    <span class="badge bg-warning" title="En Panne"> {{$material->serial}} </span>
                @elseif($material->state == -2)
                    <span class="badge bg-dark" title="En Casse"> {{$material->serial}} </span>
                @endif

                @if(count($material->observations_material) != 0)
                    <a class="text-warning" href="{{route('observations.create', $material->id)}}" >
                        <i class="bi bi-exclamation-circle text-warning"></i>
                    </a>
                @endif
            </td>
            <td class="align-content-center">
                <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="32" height="32">
                <span class="badge bg-light" >{{ $material->delivery_material->model_material->title }}</span>
            </td>
            <td class="align-content-center">
                <span class="badge bg-light" >{{ $material->delivery_material->model_material->type_material->title }}</span>
            </td>
            <td class="align-content-center">
                <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->brand_material->logo_data) }}" width="32" height="32">
                <span class="badge bg-light" >{{ $material->delivery_material->model_material->brand_material->title }}</span>
            </td>
            <td class="align-content-center">
                <span class="badge bg-light" >{{ $material->delivery_material->march_material->title }}</span>
            </td>
            <td class="align-content-center">
                <span class="badge bg-light" >{{ $material->ip ?? '' }}</span>
            </td>
            <td class="align-content-center">
                <x-button-traitement href="{{route('materials.edit', $material->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer"  />
                <x-button-traitement href="{{route('materials.show', $material->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                @if(config('app.delete'))
                    <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$material->id}}" title="Supprimer" />
                    <x-confirmation-modal
                        href="{{route('materials.destroy', $material->id)}}"
                        target="deleteModal{{$material->id}}"
                        title="Confirmation"
                        message="Voulez vous vraiment supprimer ce modèle ?" />
                    @endif

                @if(!$material->is_reform)
                    <x-button-modal class="btn btn-sm btn-light" icon="bi bi-exclamation-octagon" target="reformModal{{$material->id}}" title="Réformé" />
                    <x-confirmation-modal
                        href="{{route('materials.reform', ['material' =>$material->id, 'state'=>true])}}"
                        target="reformModal{{$material->id}}"
                        title="Confirmation"
                        message="Voulez vous vraiment réformé ce modèle?" />
                @else
                    <x-button-modal class="btn btn-sm btn-success" icon="bi bi-check2-circle" target="annulerReformModal{{$material->id}}" title="Annuler la réforme" />
                    <x-confirmation-modal
                        href="{{route('materials.reform', ['material' =>$material->id, 'state'=>0])}}"
                        target="annulerReformModal{{$material->id}}"
                        title="Confirmation"
                        message="Voulez vous vraiment annuler la réform de ce modèle?" />
                @endif
            </td>
        </tr>
    @empty
        <tr class="align-content-center text-center">
            <td colspan="6"> <h5> Pas des matériel !!!!</h5> </td>
        </tr>
    @endforelse
    </tbody>
</table>
