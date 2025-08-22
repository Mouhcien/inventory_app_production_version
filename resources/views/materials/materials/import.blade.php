<x-layout>
    <div class="row col-12">
        <div class="col-8">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <a href="{{route('models.index')}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        <i class="bi bi-box-fill me-1"></i> {{$delivery->model_material->title}}

                    </h5>
                </div>
                <div class="card-body shadow">
                    <table class="table table-light table-hover shadow">
                        <tbody>
                        <tr>
                            <th class="align-content-center"> Modèle </th>
                            <td class="align-content-center">
                                <div class="row col-12">
                                    <div class="col-4 align-content-center"><img src="data:image/png;base64,{{ base64_encode($delivery->model_material->image_data) }}" width="64" height="64"></div>
                                    <div class="col-8 align-content-center">
                                        <span class="badge badge-bg"> {{$delivery->model_material->title}} </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Type </th>
                            <td>
                                <span class="badge badge-bg">{{$delivery->model_material->type_material->title}}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Marque </th>
                            <td class="align-content-center">
                                <div class="row col-12">
                                    <div class="col-4 align-content-center"><img src="data:image/png;base64,{{ base64_encode($delivery->model_material->brand_material->logo_data) }}" width="64" height="64"></div>
                                    <div class="col-8 align-content-center">
                                        <span class="badge badge-bg"> {{$delivery->model_material->brand_material->title}} </span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="align-content-center"> Marché </th>
                            <td>
                                <span class="badge badge-bg">{{$delivery->march_material->title}}</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card border-primary mb-3">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="bi bi-bank2 me-1"></i>  Importer les matériels
                    </h5>
                </div>
                <div class="card-body shadow">
                    <form action="{{route('materials.import', $delivery->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <x-input-file
                            label="Fichier excel des matériels"
                            name="file"
                            class="form-control"
                            id="file"
                        />
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Charger" />
                        </div>
                    </form>
                    <hr>
                    Exemple de fichier excel :
                    <table class="table table-striped">
                        <thead>
                        <th>N° Série</th>
                        <th> ip </th>
                        <th>N° d'inventaire </th>
                        </thead>
                        <tbody>
                        <tr>
                            <td>XXXXXX</td>
                            <td>XX.XX.XX.XX</td>
                            <td>XXXXXX</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
