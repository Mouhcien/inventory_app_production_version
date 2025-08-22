<x-layout>

    <div class="row col-12">
        <div class="col-6">
            <div class="card border-primary ">
                <h3 class="card-header">
                    <a class="text-primary" href="{{route('materials.show', $material->id)}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
                    Nouvelle observations
                </h3>
                <div class="card-body">
                    <form action="{{route('observations.store', $material->id)}}" method="POST">
                        @csrf
                        <div>
                            <x-input-text
                                label="Titre d'observation"
                                name="title"
                                class="form-control"
                                placeholder="Titre d'observation"
                                id="title"
                                :value="$editedObservation->title ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-textfield
                                label="Objet d'observation"
                                name="object"
                                class="form-control"
                                placeholder="Objet d'observation"
                                id="object"
                                :value="$editedObservation->object ?? ''"
                            />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-6">
            <x-material-detail-card :material="$material" />
        </div>
    </div>




</x-layout>
