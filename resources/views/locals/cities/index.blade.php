<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les Villes de la région
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Id </th>
                        <th> Ville </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($cities as $city)
                            <tr>
                                <td> {{ $city->id }}</td>
                                <td> {{ $city->title }}</td>
                                <td>
                                    <x-button-traitement href="{{route('cities.edit', $city->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil"  />
                                    <x-button-traitement href="{{route('cities.show', $city->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$city->id}}" />
                                        <x-confirmation-modal
                                            href="{{route('cities.destroy', $city->id)}}"
                                            target="deleteModal{{$city->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer cette ville ?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des cities !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $cities->links() }}
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
                                label="Ville"
                                name="title"
                                class="form-control"
                                placeholder="Ville"
                                id="cityTitle"
                                :value="$editedCity->title ?? ''"
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
