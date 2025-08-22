<?php

namespace App\Http\Controllers;
use App\Services\Material\MaterialService;
use App\Services\Material\TypeMaterialService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class TypeMaterialController extends Controller
{
    private int $pages = 10;
    private TypeMaterialService $typeMaterialService;
    private MaterialService $materialService;
    private array $rules = [
        'title'     => 'required|max:255',
    ];

    /**
     * @param TypeMaterialService $typeMaterialService
     */
    public function __construct(TypeMaterialService $typeMaterialService, MaterialService $materialService)
    {
        $this->typeMaterialService = $typeMaterialService;
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $types = $this->typeMaterialService->getAllMaterialTypes($this->pages);
            return view("materials.types.index", [
                'types'      => $types,
                'editedType' => null,
                'id'         => null,
                'url'        => 'types.store',
                'title'      => 'Nouveau Type du matériel'
            ]);

        }catch (\Exception $exception) {

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data       = $request->validate($this->rules);
            $result     = $this->typeMaterialService->createNewMaterialType($data);

            if ($result)
                return Redirect::route('types.index')->with('success', "Nouveau type de matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', "Une erreur technique est survenue pendant la création du type de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $type = $this->typeMaterialService->getOneMaterialById($id);
            $materials = $this->materialService->filterMaterial('type', $id, 10);
            if (!$type)
                return Redirect::route('types.index')->with('error', "Le type est introuvable");

            return view('materials.types.show', [
                'type' => $type,
                'materials' => $materials,
                'total' => $materials->total()
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', $exception->getMessage());
        }
    }

    public function export(int $id)
    {

        return $this->exportMaterials($this->materialService, 'type', $id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $type  = $this->typeMaterialService->getOneMaterialById($id);
            $types = $this->typeMaterialService->getAllMaterialTypes($this->pages);
            return view("materials.types.index", [
                'types'       => $types,
                'editedType'  => $type,
                'id'          => $id,
                'url'         => "types.update",
                'title'       => 'Modifier le type du matériel'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $type = $this->typeMaterialService->getOneMaterialById($id);
            if (!$type)
                return Redirect::route('types.index')->with('error', "Le type est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->typeMaterialService->updateMaterialType($type, $data);

            if ($result)
                return Redirect::route('types.index')->with('success', "Le type du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', "Une erreur technique est survenue pendant la création du type de matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $type = $this->typeMaterialService->getOneMaterialById($id);
            if (!$type)
                return Redirect::route('types.index')->with('error', "Le type est introuvable");

            $result = $this->typeMaterialService->deleteMaterialType($type);
            if ($result)
                return Redirect::route('types.index')->with('success', "Le type du matériel est supprimé avec succès !");
            else
                return Redirect::route('types.index')->with('error', "Une erreur technique est survenue pendant la suppression du type de matériel");


        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', $exception->getMessage());
        }
    }
}
