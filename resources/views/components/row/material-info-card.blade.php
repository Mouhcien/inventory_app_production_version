
@props(['material'])

<div class="card mb-3 shadow border-primary">
    <div class="card-header border-primary">
        <div class="row col-12">
            <div class="col-6">
                <h5><i class="bi bi-pc me-2"></i>{{ $material->delivery_material->model_material->type_material->title }} </h5>
            </div>
            <div class="col-6">
                @if($material->state == 1)
                    <span class="badge bg-success shadow float-end">{{$material->serial}}</span>
                @endif
                @if($material->state == -1)
                    <span class="badge bg-warning shadow float-end">{{$material->serial}}</span>
                @endif
                @if($material->state == -2)
                    <span class="badge bg-danger shadow float-end"> {{$material->serial}}</span>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body border-primary">
        <div class="row col-12">
            <div class="col-4 align-content-center"> <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->image_data) }}" width="100" height="100"> </div>
            <div class="col-8 align-content-center">
                <span class="badge bg-light shadow ">{{ $material->delivery_material->model_material->title }} </span>
            </div>
        </div>
        <div class="row col-12 mt-2">
            <div class="col-4 align-content-center"> <img src="data:image/png;base64,{{ base64_encode($material->delivery_material->model_material->brand_material->logo_data) }}" width="64" height="64"> </div>
            <div class="col-8 align-content-center">
                <span class="badge bg-light shadow">{{ $material->delivery_material->model_material->brand_material->title }} </span>
            </div>
        </div>
        <div class="row col-12 mt-2">
            @if(!is_null($material->ip))
                <span class="badge bg-light shadow">{{ $material->ip }} </span>
            @endif
        </div>
    </div>
    <div class="card-footer border-primary align-content-center">
        <span class="badge bg-info">Marché :</span> <span class="badge bg-primary shadow"> {{ $material->delivery_material->march_material->title }}</span>
        @if(count($material->observations_material) != 0)
            <span class="badge bg-light float-end" title="Observations">
                <a class="text-warning" href="{{route('observations.create', $material->id)}}" >
                    <i class="bi bi-exclamation-circle text-warning"></i>
                </a>
            </span>
        @endif
    </div>
</div>
