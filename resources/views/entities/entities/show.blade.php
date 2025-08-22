<x-layout>
    <div  class="card border-dark shadow-lg mb-3">
        <div class="card-header">
            <a href="{{route('entities.index')}}" ><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
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
                @else
                    <h5> Pas des sections dans cette entité ...</h5>
                @endif
                @if (count($entity->secters_entities) != 0)
                    @foreach($entity->secters_entities as $secter)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$secter->title}}
                            <span class="badge bg-primary rounded-pill" title="Nombre des employées">{{count($secter->employees)}}</span>
                        </li>
                    @endforeach
               @else
                        <h5> Pas des secteurs dans cette entité ...</h5>
                @endif
            </ul>
        </div>
        <div class="card-footer border-primary">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nombre des employées
                    <span class="badge bg-primary rounded-pill">{{count($entity->employees)}}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Nombre des matériels informatique
                    <span class="badge bg-primary rounded-pill">1</span>
                </li>
            </ul>
        </div>
    </div>






</x-layout>
