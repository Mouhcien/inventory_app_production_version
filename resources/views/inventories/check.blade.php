<x-layout>
    <div class="row col-12">
        <div class="col-4">
            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <i class="bi bi-check-all"></i>
                        Les options de vérification
                    </h5>
                </div>
                <div class="card-body border-primary text-center align-content-center">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier la duplication d'une série d'équipement.
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier si une série d'équipements est attribuée à plusieurs employés.
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier si une série d'équipements n'est attribuée à aucun employé.
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier que le nombre de matériels attribués à un employé ne dépasse pas 3.
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier si un employé dispose d'une seule série pour chaque type d'équipement.
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked="checked">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Vérifier la duplication du PPR d'un employé.
                                </label>
                            </div>
                        </li>
                    </ul>
                    <a href="{{route('inventories.check')}}" class="btn btn-info mt-2" ><i class="bi bi-check-circle"></i> Commencer la vérirication </a>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card border-primary mb-3 shadow-lg">
                <div class="card-header border-primary">
                    <h5>
                        <i class="bi bi-list-check"></i>
                        Résultat de vérification
                    </h5>
                </div>
                <div class="card-body border-primary">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($duplicateSerials) && count($duplicateSerials) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification de la duplication d'une série d'équipement.
                                        </span>
                                        <span class="badge bg-info">{{!is_null($duplicateSerials) ? count($duplicateSerials) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    @if (!is_null($duplicateSerials))
                                        @foreach($duplicateSerials as $result)
                                            <span class="badge bg-warning me-2"><a href="{{route('materials.advance', ['sr' =>$result->serial])}}" target="_blank" class="text-decoration-none" >{{$result->serial}}</a> </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($duplicateInventorySerials) && count($duplicateInventorySerials) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification de l'attribution d'une série d'équipements à plusieurs employés
                                        </span>
                                        <span class="badge bg-info">{{!is_null($duplicateInventorySerials) ? count($duplicateInventorySerials) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if (!is_null($duplicateInventorySerials))
                                        @foreach($duplicateInventorySerials as $result)
                                            <span class="badge bg-warning"><a href="{{route('materials.history', $result->material_id)}}" class="text-decoration-none" target="_blank" >{{$result->serial}}</a> </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($materialNotAffected) && count($materialNotAffected) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification si une série d'équipements n'est attribuée à aucun employé.
                                        </span>
                                        <span class="badge bg-info">{{!is_null($materialNotAffected) ? count($materialNotAffected) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if (!is_null($materialNotAffected))
                                        @foreach($materialNotAffected as $result)
                                            <span class="badge bg-warning"><a href="{{route('materials.history', $result->id)}}" class="text-decoration-none" target="_blank" >{{$result->serial}}</a> </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($employeesWithMoreMaterials) && count($employeesWithMoreMaterials) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification que le nombre de matériels attribués à un employé ne dépasse pas 5.
                                        </span>
                                        <span class="badge bg-info">{{!is_null($employeesWithMoreMaterials) ? count($employeesWithMoreMaterials) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample" style="">
                                <div class="accordion-body">
                                    @if (!is_null($employeesWithMoreMaterials))
                                        @foreach($employeesWithMoreMaterials as $result)
                                            <span class="badge bg-warning">
                                                <a href="{{route('employees.show', $result->employee_id)}}" class="text-decoration-none" target="_blank" >
                                                    {{$result->lastname}} {{$result->firstname}}
                                                </a>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($employeesWithMoreThanOneMaterialForEachType) && count($employeesWithMoreThanOneMaterialForEachType) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification si un employé dispose d'une seule série pour chaque type d'équipement.
                                        </span>
                                        <span class="badge bg-info">{{!is_null($employeesWithMoreThanOneMaterialForEachType) ? count($employeesWithMoreThanOneMaterialForEachType) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if (!is_null($employeesWithMoreThanOneMaterialForEachType))
                                        @foreach($employeesWithMoreThanOneMaterialForEachType as $result)
                                            <span class="badge bg-warning">
                                                <a href="{{route('employees.show', $result->employee_id)}}" class="text-decoration-none" target="_blank" >
                                                    {{$result->lastname}} {{$result->firstname}} [<strong>{{$result->type_title}}</strong>]
                                                </a>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <h5>
                                        <i class="bi bi-check-circle me-2"></i>
                                        <span class="badge {{!is_null($duplicateEmployeePPR) && count($duplicateEmployeePPR) != 0  ? 'bg-danger' : 'bg-success' }}" >
                                            Résultat : Vérification de la duplication du PPR d'un employé.
                                        </span>
                                        <span class="badge bg-info">{{!is_null($duplicateEmployeePPR) ? count($duplicateEmployeePPR) : 'Pas de résultat' }}</span>
                                    </h5>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if (!is_null($duplicateEmployeePPR))
                                        @foreach($duplicateEmployeePPR as $result)
                                            <span class="badge bg-warning">
                                                <a href="{{route('employees.show', $result->id)}}" class="text-decoration-none" target="_blank" >
                                                    {{$result->lastname}} {{$result->firstname}} [<strong>{{$result->ppr}}</strong>]
                                                </a>
                                            </span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
