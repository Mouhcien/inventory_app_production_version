<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-border-style me-1"></i> Les Services du DRI-Marrakech
                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped table-hover shadow">
                        <thead>
                        <th> Id </th>
                        <th> Service </th>
                        <th>  </th>
                        </thead>
                        <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td> {{ $service->id }}</td>
                                <td> {{ $service->title }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-primary"><i class="bi bi-tools"></i></button>
                                        <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                            <x-button-traitement href="{{route('services.edit', $service->id)}}" class="btn btn-sm btn-warning ms-3" icon="bi bi-pencil"  />
                                            <x-button-traitement href="{{route('services.show', $service->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns"  />
                                            @if(config('app.delete'))
                                                <x-button-modal class="btn btn-sm btn-danger" icon="bi bi-trash" target="deleteModal{{$service->id}}" />
                                            @endif
                                        </div>
                                    </div>
                                    <x-confirmation-modal
                                        href="{{route('services.destroy', $service->id)}}"
                                        target="deleteModal{{$service->id}}"
                                        title="Confirmation"
                                        message="Voulez vous vraiment supprimer ce service ?" />
                                </td>
                            </tr>
                        @empty
                            <tr class="align-content-center text-center">
                                <td colspan="3"> <h5> Pas des services !!!!</h5> </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        <ul class="pagination pagination-sm">
                            {{ $services->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <ul class="nav nav-tabs border-primary shadow" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab">Formulaire</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#importService" aria-selected="false" role="tab" tabindex="-1">Importation</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content border-primary shadow">
                <div class="tab-pane fade active show" id="home" role="tabpanel">
                    <div class="card border-primary mb-3">
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
                                        label="Service"
                                        name="title"
                                        class="form-control"
                                        placeholder="Service"
                                        id="serviceTitle"
                                        :value="$editedService->title ?? ''"
                                    />
                                </div>
                                <div class="mt-2">
                                    <x-button type="submit" class="btn btn-primary" text="Valider" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="importService" role="tabpanel">
                    <div class="card border-primary mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="bi bi-border-style me-1"></i> Importer les services
                            </h5>
                        </div>
                        <div class="card-body shadow">
                            <form action="{{route('services.import')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div>
                                    <x-input-file
                                        label="Fichier excel des service du DRI-Marrakech"
                                        name="file"
                                        class="form-control"
                                        id="file"
                                    />
                                </div>
                                <div class="mt-2">
                                    <x-button type="submit" class="btn btn-primary" text="Importer" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>
