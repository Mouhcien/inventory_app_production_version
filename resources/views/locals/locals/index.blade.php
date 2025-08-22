<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les locaux du DRI Marrakech
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Id </th>
                        <th> Local </th>
                        <th> Ville </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($locals as $local)
                            <tr>
                                <td> {{ $local->id }}</td>
                                <td> {{ $local->title }}</td>
                                <td> {{ $local->city->title }}</td>
                                <td>
                                    <x-button-traitement href="{{route('locals.edit', $local->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil"  />
                                    <x-button-traitement href="{{route('locals.show', $local->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$local->id}}" />
                                        <x-confirmation-modal
                                            href="{{route('locals.destroy', $local->id)}}"
                                            target="deleteModal{{$local->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer ce local ?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des locaux !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $locals->links() }}
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
                                label="Local"
                                name="title"
                                class="form-control"
                                placeholder="Local"
                                id="localTitle"
                                :value="$editedLocal->title ?? ''"
                            />
                        </div>
                        <div>
                            <label class="col-form-label mt-4" for="city_id">Ville</label>
                            <select name="city_id" class="form-control" id="city_id" >
                                @if ($editedLocal != null)
                                    @foreach($cities as $city)
                                        <option {{ $city->id == $editedLocal->city->id ? 'selected' : '' }} value="{{$city->id}}">{{$city->title}}</option>
                                    @endforeach
                                @else
                                    @foreach($cities as $city)
                                        <option value="{{$city->id}}">{{$city->title}}</option>
                                    @endforeach
                                @endif
                            </select>
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
