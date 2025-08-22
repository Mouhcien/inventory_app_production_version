<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Le modèle du fichier d'importation </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped shadow">
                        <thead>
                            <th> Série </th><th> PPR </th>
                        </thead>
                        <tbody>
                            @for($i=0;$i<5;$i++)
                                <tr>
                                    <td>XXXXXXXX</td><td>XXXXXXXX</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Importer la liste d'inventaire </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('inventories.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-file
                            label="Fichier excel d'inventaire"
                            name="file"
                            class="form-control"
                            id="file"
                        />
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-sm btn-primary" text="Charger" />

                            <a href="{{route('inventories.index')}}" class="btn btn-sm btn-danger float-end" > <i class="bi bi-x-square me-2"></i>Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
