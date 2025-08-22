
<x-layout>

    <x-material-detail-card :material="$material" />
    <div class="card border-primary ">
        <div class="card-body">
            <x-button-traitement href="{{route('materials.edit', $material->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer"  />
            <x-button-traitement href="{{route('materials.history', $material->id)}}" class="btn btn-sm btn-info" icon="bi bi-people" title="Consulter Utilisateurs"  />
            <x-confirmation-modal
                href="{{route('materials.destroy', $material->id)}}"
                target="deleteModal{{$material->id}}"
                title="Confirmation"
                message="Voulez vous vraiment supprimer ce modèle ?" />

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
            <x-button-traitement href="{{route('materials.edit', $material->id)}}" class="btn btn-sm btn-primary" icon="bi bi-file-pdf" title="Télécharger PDF"  />
            <x-button-traitement href="{{route('materials.show', $material->id)}}" class="btn btn-sm btn-success" icon="bi bi-file-excel" title="Télécharger Excel"  />
            @if(config('app.delete'))
                <x-button-modal class="btn btn-sm btn-danger float-end" icon="bi bi-trash" target="deleteModal{{$material->id}}" title="Supprimer" />
            @endif
        </div>
    </div>

</x-layout>
