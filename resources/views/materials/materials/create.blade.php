<x-layout>

    <div class="card border-primary mb-3">
        <div class="card-header">
            <div class="row col-12">
                <div class="col-6">
                    <h5 class="card-title">
                        <a class="text-primary" href="{{route('materials.index')}}" > <i class="bi bi-arrow-left-circle-fill me-1"></i></a>
                        <i class="bi bi-clipboard-plus me-1"></i> {{$title}}
                    </h5>
                </div>
            </div>

        </div>
        <div class="card-body shadow">
            <form action="{{route($url, $id)}}" method="POST">
                @csrf
                <div class="row col-12">
                    <div class="col-6">
                        <div>
                            <x-input-text
                                label="Série"
                                name="serial"
                                class="form-control"
                                placeholder="Série du matériel informatique"
                                id="serial"
                                :value="$editedMaterial->serial ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="Adresse IP"
                                name="ip"
                                class="form-control"
                                placeholder="Adresse IP du matériel informatique"
                                id="ip"
                                :value="$editedMaterial->ip ?? ''"
                            />
                        </div>
                        <div>
                            <x-input-text
                                label="N° d'inventaire"
                                name="inventory_number"
                                class="form-control"
                                placeholder="N° d'inventaire du matériel informatique"
                                id="inventory_number"
                                :value="$editedMaterial->inventory_number ?? ''"
                            />
                        </div>
                        <div class="mt-2">
                            <x-button type="submit" class="btn btn-primary" text="Valider" />
                            <a class="text-primary float-end" href="{{ route('materials.ip.import') }}" ><i class="bi bi-upload me-2"></i> Importer les adrsses IP</a>
                        </div>
                    </div>
                    <div class="col-6">
                        <label class="col-form-label mt-4" for="model_material_id">Séélectionnez un modèle </label>
                        <ul class="list-group">
                            @foreach($deliveries as $delivery)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    @if($id != null && $editedMaterial != null && $delivery->id == $editedMaterial->delivery_material->id)
                                        <x-radio-input
                                            label="{{$delivery->model_material->title}} - {{$delivery->march_material->title}}"
                                            name="delivery_material_id"
                                            class="form-check-input"
                                            id="delivery_material_id"
                                            value="{{$delivery->id}}"
                                            :checked="true"
                                        />
                                    @else
                                        <x-radio-input
                                            label="{{$delivery->model_material->title}} - {{$delivery->march_material->title}}"
                                            name="delivery_material_id"
                                            class="form-check-input"
                                            id="delivery_material_id"
                                            value="{{$delivery->id}}"
                                            :checked="false"
                                        />
                                    @endif
                                    <span title="Nombres de matériels" class="badge bg-primary rounded-pill">{{count($delivery->materials)}}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-layout>
