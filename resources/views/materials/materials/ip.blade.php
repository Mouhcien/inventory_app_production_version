<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <form action="{{ route('materials.ip.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <x-input-file
                        label="Fichier excel des matériels"
                        name="file"
                        class="form-control"
                        id="file"
                    />
                    <div class="mt-2">
                        <x-button type="submit" class="btn btn-primary" text="Charger" />
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="card border-primary shadow">
                <div class="card-heade border-primary shadowr">
                    <h5> Exemple de fichier </h5>
                </div>
                <div class="card-body border-primary shadow">
                    <table class="table table-stripe table-light">
                        <thead>
                            <th> Série </th><th> IP </th>
                        </thead>
                        <tbody>
                            @for ($i=0; $i<10;$i++)
                                <tr>
                                    <td> XXXXXXXX </td>
                                    <td> {{ "10.93.128.".$i+100 }} </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</x-layout>