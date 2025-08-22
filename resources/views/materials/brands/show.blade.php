<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary shadow mb-3">
                <div class="card-header border-primary">
                    <h5>
                        <a href="{{route('brands.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                        Marque du matériel : {{$brand->title}}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center m-2">
                        <img src="data:image/png;base64,{{ base64_encode($brand->logo_data) }}" width="128" height="128">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nombre des modèles
                            <span class="badge bg-primary rounded-pill">{{count($brand->models_material)}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nombre des matériels
                            <span class="badge bg-primary rounded-pill">{{$total}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card border-primary shadow mb-3">
                <div class="card-header border-primary">
                    <div class="row col-12">
                        <div class="col-6">
                            <h5> Les matériele du brand <span class="badge bg-light">{{$brand->title}}</span></h5>
                        </div>
                        <div class="col-6">
                            <a href="{{route('brands.export', $brand->id)}}" class="text-decoration-none float-end" >
                                <span class="badge bg-primary">
                                    <i class="bi bi-download"></i>Télécharger
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row col-12">
                        @foreach($materials as $material)
                            <div class="col-4 shadow">
                                <div class="card mb-3 shadow">
                                    <div class="card-header text-center">
                                        @if($material->state == 1)
                                            <h5><span class="badge bg-success" title="OK">{{$material->serial}}</span></h5>
                                        @endif
                                        @if($material->state == -1)
                                            <h5><span class="badge bg-warning" title="En Panne">{{$material->serial}}</span></h5>
                                        @endif
                                        @if($material->state == -2)
                                            <h5><span class="badge bg-danger" title="En Casse">{{$material->serial}}</span></h5>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center m-2">
                                            <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="128" height="128">
                                        </div>
                                        <div class="row m-2">
                                            <span class="badge bg-light">{{ $material->delivery_material->model_material->title }}</span>
                                        </div>
                                        <div class="row m-2">
                                            <span class="badge bg-light">{{ $material->delivery_material->model_material->type_material->title }}</span>
                                        </div>

                                    </div>
                                    <div class="card-footer">
                                        Marché <span class="badge bg-light">{{ $material->delivery_material->march_material->title }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    {{$materials->links()}}
                </div>
            </div>
        </div>
    </div>
</x-layout>
