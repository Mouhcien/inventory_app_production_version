<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les marchs du matériels
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Id </th>
                        <th> Marché </th>
                        <th> Modèles </th>
                        <th> Réformé </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($marchs as $march)
                            <tr>
                                <td class="align-content-center"> {{ $march->id }}</td>
                                <td class="align-content-center"> {{ $march->title }}</td>
                                <td class="align-content-center">
                                    @if(count($march->deliveries_material) != 0)
                                        @foreach($march->deliveries_material as $delivery)
                                            <div class="row col-12">
                                                <div class="col-4">
                                                    <img src="data:image/png;base64,{{ base64_encode($delivery->model_material->image_data) }}" width="32" height="32">
                                                </div>
                                                <div class="col-8">
                                                    {{$delivery->model_material->title}}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="align-content-center">
                                    @if($march->is_reform == false)
                                        <span class="badge bg-success">Non</span>
                                    @else
                                        <span class="badge bg-danger">Oui</span>
                                    @endif
                                </td>
                                <td class="align-content-center">
                                    <x-button-traitement href="{{route('marchs.edit', $march->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil" title="Editer" />
                                    <x-button-traitement href="{{route('marchs.show', $march->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$march->id}}" title="Supprimer" />
                                        <x-confirmation-modal
                                            href="{{route('marchs.destroy', $march->id)}}"
                                            target="deleteModal{{$march->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer ce marché?"/>
                                    @endif
                                    @if(!$march->is_reform)
                                        <x-button-modal class="btn btn-sm btn-light" icon="bi bi-exclamation-octagon" target="reformModal{{$march->id}}" title="Réformé" />
                                        <x-confirmation-modal
                                            href="{{route('marchs.reform', ['march' =>$march->id, 'state'=>true])}}"
                                            target="reformModal{{$march->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment réformé ce marché?" />
                                    @else
                                        <x-button-modal class="btn btn-sm btn-success" icon="bi bi-check2-circle" target="annulerReformModal{{$march->id}}" title="Annuler la réforme" />
                                        <x-confirmation-modal
                                            href="{{route('marchs.reform', ['march' =>$march->id, 'state'=>0])}}"
                                            target="annulerReformModal{{$march->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment annuler la réform de ce marché?" />
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des marchés !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $marchs->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> {{$title}}
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route($url, $id)}}" method="POST">
                        @csrf
                        <div>
                            <x-input-text
                                label="Marché du matériel"
                                name="title"
                                class="form-control"
                                placeholder="Marché du matériel informatique"
                                id="marchTitle"
                                :value="$editedMarch->title ?? ''"
                            />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>
