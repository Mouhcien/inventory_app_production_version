<x-layout>
    <div class="card border-primary mb-3 shadow">
        <div class="card-header border-primary">
            <div class="row cols-12 align-content-center">
                <div class="col-6 align-content-center">
                    <h5 class="card-title">
                        <a class="" data-bs-toggle="offcanvas" href="#offcanvasConsummationFiltrage" aria-controls="offcanvasConsummationFiltrage">
                            <i class="bi bi-filter"></i>
                        </a>
                        <i class="bi bi-hourglass-split me-1"></i> Les consommation du DRI-Marrakech
                    </h5>
                </div>
                <div class="col-6">
                    <a href="{{route('consummations.filter.advance')}}" class="text-info me-2" > <i class="bi bi-filter-circle me-1"></i>Filtrage Avancée </a>
                    <a href="{{route('consummations.export', ['filter' => $filter, 'value' => $value])}}" class="text-success me-2" > <i class="bi bi-download me-1"></i>Télécharger toutes les consommations</a>
                    <a href="{{route('consummations.create')}}" class="btn btn-primary float-end" ><i class="bi bi-plus-square"></i> Nouvelle Consommation</a>
                </div>
            </div>
        </div>
        <div class="card-body border-primary shadow">
            <table class="table table-light table-striped border-0 table-hover shadow">
                <thead>
                    <th>  </th>
                    <th> Consommable </th>
                    <th> Type </th>
                    <th> Employée </th>
                    <th> Quantité </th>
                    <th> Date </th>
                    <th>  </th>
                </thead>
                <tbody>
                @forelse($consummations as $consummation)
                    <tr>
                        <td class="align-content-center text-center"> <img src="data:image/png;base64,{{ base64_encode($consummation->stock_consumable->consumable->image) }}" width="32" height="32"> </td>
                        <td class="align-content-center">
                            <span class="badge bg-light">{{ $consummation->stock_consumable->consumable->ref }}</span>
                        </td>
                        <td class="align-content-center">
                            <span class="badge bg-info">{{ $consummation->stock_consumable->consumable->type_consumable->title }}</span>
                        </td>
                        <td class="align-content-center">
                            <span class="badge bg-light">{{ $consummation->employee->firstname }} {{ $consummation->employee->lastname }} </span>
                        </td>
                        <td class="align-content-center">
                            <span class="badge bg-success"> {{ $consummation->quantity_required }} </span>
                        </td>
                        <td class="align-content-center text-center">
                            <span class="badge bg-light"> {{ \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y') }} </span>
                        </td>
                        <td class="align-content-center text-center">
                            @if (!$consummation->is_done)
                                <x-button-traitement href="{{route('consummations.edit', $consummation->id)}}" class="btn btn-sm btn-warning" icon="bi bi-pen" title="Editer"  />
                                <x-button-modal class="btn btn-sm btn-success" target="validModal{{$consummation->id}}" icon="bi bi-check" title="Valider" />
                                <x-confirmation-modal
                                    href="{{route('consummations.valid', $consummation->id)}}"
                                    target="validModal{{$consummation->id}}"
                                    title="Confirmation"
                                    message="Voulez vous vraiment valider ce demande de consommable ?" />
                            @else
                                <a href="{{route('consummations.receipt', $consummation->id)}}" target="_blank" class="btn btn-sm btn-danger" > <i class="bi bi-file-pdf"></i></a>
                            @endif

                            <x-button-traitement href="{{route('consummations.show', $consummation->id)}}" class="btn btn-sm btn-info" icon="bi bi-list-columns" title="Consulter cette demande"  />

                        </td>
                    </tr>
                @empty
                    <tr class="align-content-center text-center">
                        <td colspan="7"> <h5> Pas des consommations !!!!</h5> </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="mt-2">
                <ul class="pagination pagination-sm">
                    {{ $consummations->links() }}
                </ul>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-start" tabindex="-1"
         id="offcanvasConsummationFiltrage" aria-labelledby="offcanvasConsummationFiltrage">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-filter"></i> Filtrage </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par type de consommable
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_type_consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($types as $type)
                            <option value="{{$type->id}}">{{$type->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_type_consumable_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par réference du consommable
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_consumable_id">
                        <option value="0">--------------------------------</option>
                        @foreach($consumables as $consumable)
                            <option value="{{$consumable->id}}">{{$consumable->ref}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_consumable_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par employé
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_employee_id">
                        <option value="0">--------------------------------</option>
                        @foreach($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->lastname}} {{$employee->firstname}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_employee_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par service
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_service_id">
                        <option value="0">--------------------------------</option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}">{{$service->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_service_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par entité
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_entity_id">
                        <option value="0">--------------------------------</option>
                        @foreach($entities as $entity)
                            <option value="{{$entity->id}}">{{$entity->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_entity_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par secteur
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_sercter_id">
                        <option value="0">--------------------------------</option>
                        @foreach($secters as $secter)
                            <option value="{{$secter->id}}">{{$secter->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_sercter_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par section
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_section_id">
                        <option value="0">--------------------------------</option>
                        @foreach($sections as $section)
                            <option value="{{$section->id}}">{{$section->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_section_id" />
                    </div>
                </div>
            </div>

            <div class="card border-primary mb-3 shadow">
                <div class="card-header border-primary">
                    Filtrez par local
                </div>
                <div class="card-body">
                    <select class="form-control" id="consummation_local_id">
                        <option value="0">--------------------------------</option>
                        @foreach($locals as $local)
                            <option value="{{$local->id}}">{{$local->title}}</option>
                        @endforeach
                    </select>
                    <div class="mt-2">
                        <x-button type="button" class="btn btn-primary" text="Filtrer" id="btn_consummation_local_id" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
