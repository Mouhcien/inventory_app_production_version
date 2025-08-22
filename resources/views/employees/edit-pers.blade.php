<x-layout>
    <div class="card border-primary mb-3">
        <form action="{{ route('employees.update', ['employee' => $editedEmployee->id, 'cat' => $cat]) }}" method="POST">
            @csrf
            <div class="card-header border-primary shadow-lg">
                <h5 class="card-title">
                    <a href="{{route('employees.show', $editedEmployee->id)}}"><i class="bi bi-arrow-left-circle-fill text-primary"></i></a>
                    <i class="bi bi-people me-1"></i><i class="bi bi-pencil me-1"></i> Modifier les informations Personnelles
                </h5>
            </div>
            <div class="card-body border-primary shadow-lg">
                <div>
                    <x-input-text
                        label="PPR"
                        name="ppr"
                        class="form-control"
                        placeholder="PPR"
                        id="employeePPR"
                        :value="$editedEmployee->ppr ?? ''"
                    />
                </div>
                <div>
                    <x-input-text
                        label="Prénom"
                        name="firstname"
                        class="form-control"
                        placeholder="Prénom"
                        id="employeeFirstname"
                        :value="$editedEmployee->firstname ?? ''"
                    />
                </div>
                <div>
                    <x-input-text
                        label="Nom"
                        name="lastname"
                        class="form-control"
                        placeholder="Nom"
                        id="employeeLastname"
                        :value="$editedEmployee->lastname ?? ''"
                    />
                </div>
                <div>
                    <x-input-text
                        label="Email"
                        name="email"
                        class="form-control"
                        placeholder="Email"
                        id="employeeEmail"
                        :value="$editedEmployee->email ?? ''"
                    />
                </div>
                <div>
                    <x-input-text
                        label="N° Téléphone"
                        name="tel"
                        class="form-control"
                        placeholder="N° Téléphone"
                        id="employeeTel"
                        :value="$editedEmployee->tel ?? ''"
                    />
                </div>
                <div>
                    <label class="col-form-label mt-4" for="local_id">Local</label>
                    <select name="local_id" class="form-control" id="local_id" >
                        <option value="0"> ------ Séléctionnez le local </option>
                        @if ($editedEmployee != null)
                            @foreach($locals as $local)
                                <option {{ $local->id == $editedEmployee->local->id ? 'selected' : '' }} value="{{$local->id}}">{{$local->title}}</option>
                            @endforeach
                        @else
                            @foreach($locals as $local)
                                <option value="{{$local->id}}">{{$local->title}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div>
                    <label class="col-form-label mt-4" for="employee_situation_id">Situation Administrative</label>
                    <select name="employee_situation" class="form-control" id="employee_situation_id" >
                        <option value="0"> ------ Séléctionnez la situation </option>
                        @if ($editedEmployee != null)
                            <option {{ $editedEmployee->situation == '1' ? 'selected' : '' }} value="1">Employé en poste</option>
                            <option {{ $editedEmployee->situation == '-1' ? 'selected' : '' }} value="-1">Employé retraité</option>
                            <option {{ $editedEmployee->situation == '-2' ? 'selected' : '' }} value="-2">Employé muté</option>
                        @else
                            <option value="1">Employé en poste</option>
                            <option value="-1">Employé retraité</option>
                            <option value="-2">Employé muté</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="card-footer border-primary shadow-lg">
                Voulez vous vraiment modifier les informations personnelles
                <x-button type="submit" class="btn btn-sm btn-primary" text="OUI" />
                <a class="btn btn-sm btn-danger" href="{{route('employees.show', $editedEmployee->id)}}">NON</a>
            </div>
        </form>
    </div>
</x-layout>
