<x-layout>
    <div class="card border-primary shadow-lg mb-3">
        <div class="card-header border-primary">
            <h5>
                <a href="{{route('services.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                {{$serviceEntity->title}}
                <span class="badge bg-primary rounded-pill" title="Nombre des employées">{{count($serviceEntity->employees)}}</span>
            </h5>
        </div>
        <div class="card-body border-primary">
            @if(count($serviceEntity->entities) != 0)
                <div class="row col-12">
                    @foreach($serviceEntity->entities as $entity)
                        <div class="col-6">
                            <div  class="card border-dark shadow-lg mb-3">
                                <div class="card-header">
                                    {{$entity->title}}
                                    <span class="badge bg-primary rounded-pill" title="Nombre des employées">{{count($entity->employees)}}</span>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @if (count($entity->sections_entities) != 0)
                                            @foreach($entity->sections_entities as $section)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                {{$section->title}}
                                                <span class="badge bg-primary rounded-pill" title="Nombre des employées">{{count($section->employees)}}</span>
                                            </li>
                                            @endforeach
                                        @endif
                                        @if (count($entity->secters_entities) != 0)
                                            @foreach($entity->secters_entities as $secter)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    {{$secter->title}}
                                                    <span class="badge bg-primary rounded-pill" title="Nombre des employées">{{count($secter->employees)}}</span>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <h5>Pas des entités dans ce service ...</h5>
            @endif
        </div>
        <div class="card-footer border-primary">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nombre des employées
                    <span class="badge bg-primary rounded-pill">{{count($serviceEntity->employees)}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nombre des entités
                    <span class="badge bg-primary rounded-pill">{{count($serviceEntity->entities)}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nombre des matériels informatique
                    <span class="badge bg-primary rounded-pill">1</span>
                </li>
            </ul>
        </div>
    </div>
</x-layout>
