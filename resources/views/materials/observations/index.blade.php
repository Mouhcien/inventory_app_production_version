<x-layout>
    <div class="card border-primary shadow">
        <div class="card-header border-primary">
            <div class="row col-12">
                <div class="col-6 align-content-center">
                    <h5>
                        <a href="{{route('materials.index')}}" class="text-primary" ><i class="bi bi-arrow-left-circle-fill"></i></a>
                        <i class="bi bi-info-circle me-2"></i>
                        Les observations du matériel
                    </h5>
                </div>
                <div class="col-6 align-content-center">
                    <div>
                        <select class="form-control" id="sl_title_observation">
                            <option value="0"> Séléctionnez par titre </option>
                            @foreach($titles as $title)
                                <option value="{{$title->title}}"> {{$title->title}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow">

            @forelse($observations as $observation)
                <div class="row col-12 mb-3 shadow">
                    <div class="col-4">
                        <x-material-info-card :material="$observation->material" />
                    </div>
                    <div class="col-8">
                        <x-observation-info-card :observation="$observation" />
                    </div>
                </div>
            @empty
                <p> Pas des observations ....</p>
            @endforelse

        </div>
        <div class="card-footer border-primary shadow">
            <x-pagination-row :data="$observations" />
        </div>
    </div>
</x-layout>
