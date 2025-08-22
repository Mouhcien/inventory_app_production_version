<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les marques du matériels
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-light table-striped table-hover">
                        <thead>
                        <th> Id </th>
                        <th colspan="2" class="text-center"> Marque </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td class="align-content-center"> {{ $brand->id }}</td>
                                <td><img src="data:image/png;base64,{{ base64_encode($brand->logo_data) }}" width="32" height="32"></td>
                                <td class="align-content-center"> {{ $brand->title }}</td>
                                <td class="align-content-center">
                                    <x-button-traitement href="{{route('brands.edit', $brand->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pencil"  />
                                    <x-button-traitement href="{{route('brands.show', $brand->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                    @if(config('app.delete'))
                                        <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$brand->id}}" />
                                        <x-confirmation-modal
                                            href="{{route('brands.destroy', $brand->id)}}"
                                            target="deleteModal{{$brand->id}}"
                                            title="Confirmation"
                                            message="Voulez vous vraiment supprimer cette marque ?" />
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des marques !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $brands->links() }}
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
                    <form action="{{route($url, $id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-input-text
                                label="Marque du matériel"
                                name="title"
                                class="form-control"
                                placeholder="Marque du matériel informatique"
                                id="brandTitle"
                                :value="$editedBrand->title ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-file
                                label="Logo du marque"
                                name="logo"
                                class="form-control"
                                id="brandLogo"
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
