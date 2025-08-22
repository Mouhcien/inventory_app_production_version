<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les types du consommable
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Id </th>
                        <th> Type </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($types as $type)
                            <tr>
                                <td> {{ $type->id }}</td>
                                <td> {{ $type->title }}</td>
                                <td>
                                    <x-button-traitement href="{{route('consumables.types.edit', $type->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil"  />
                                    <x-button-traitement href="{{route('consumables.types.show', $type->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$type->id}}" />
                                        <x-confirmation-modal
                                            href="{{route('consumables.types.destroy', $type->id)}}"
                                            target="deleteModal{{$type->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer ce type?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des types !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $types->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
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
                                label="Type du consommable"
                                name="title"
                                class="form-control"
                                placeholder="Type du consommable"
                                id="typeTitle"
                                :value="$editedType->title ?? ''"
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
