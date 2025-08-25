
@props(['observation'])

<div class="card border-primary shadow">
    <div class="card-header border-primary">
        <h5>
            <i class="bi bi-info-circle"></i>
            {{$observation->title}}
        </h5>
    </div>
    <div class="card-body border-primary shadow">
        <span class="badge bg-light me-2"> Objet : </span><span class="badge bg-info"> {{$observation->object}} </span> <br>
    </div>
    <div class="card-footer border-primary shadow">
        <span class="badge bg-light me-2"> Date de création : </span><span class="badge bg-info"> {{ \Carbon\Carbon::parse($observation->created_at)->format('d/m/Y') }}</span>
    </div>
</div>
