<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header">
                    <h5><i class="bi bi-clipboard-check me-1"></i> Le modèle du fichier d'importation </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-striped shadow">
                        <thead>
                        <th> PPR </th><th> Date </th>
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
        <div class="col-8">
            <form action="{{route('consummations.import')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card border-primary mb-3 shadow">
                    <div class="card-header border-primary">
                        <h5><i class="bi bi-clipboard-check me-1"></i> Importer la liste des consommations </h5>
                    </div>
                    <div class="card-body border-primary">
                        <div>
                            <label class="col-form-label mt-4" for="consumable_id"> Séléctionnez la référence du consommable </label>
                            <select class="form-control" name="stock_consumable_id" id="consumable_id">
                                <option value="0"> ---------------------------------- </option>
                                @foreach($stocks as $stock)
                                    <option value="{{$stock->id}}">{{$stock->consumable->type_consumable->title}} : {{$stock->consumable->ref}} [{{$stock->delivery->title}}]</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-file
                                label="Fichier excel de consommations"
                                name="file"
                                class="form-control"
                                id="file"
                            />
                        </div>
                    </div>
                    <div class="card-footer border-primary">
                        <x-button type="submit" class="btn btn-primary" text="Valider" />
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-layout>
