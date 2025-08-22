<?php

namespace App\Http\Controllers;

use App\Services\Furniture\TypeConsumableService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeConsumableController extends Controller
{
    private int $pages = 10;
    private TypeConsumableService $typeConsumableService;
    private array $rules = [
        'title'     => 'required|max:255',
    ];

    /**
     * @param TypeConsumableService $typeConsumableService
     */
    public function __construct(TypeConsumableService $typeConsumableService)
    {
        $this->typeConsumableService = $typeConsumableService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $types = $this->typeConsumableService->getAllConsumableTypes($this->pages);
            return view("funitures.types.index", [
                'types'      => $types,
                'editedType' => null,
                'id'         => null,
                'url'        => 'consumables.types.store',
                'title'      => 'Nouveau Type du consommable'
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
            $result     = $this->typeConsumableService->createNewConsumableType($data);

            if ($result)
                return Redirect::route('consumables.types.index')->with('success', "Nouveau type de consommable ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.types.index')->with('error', "Une erreur technique est survenue pendant la création du type de consommable");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $type = $this->typeConsumableService->getOneConsumableById($id);
            if (!$type)
                return Redirect::route('consumables.types.index')->with('error', "Le type est introuvable");

            return view('funitures.types.show')->with('type', $type);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.types.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $type  = $this->typeConsumableService->getOneConsumableById($id);
            $types = $this->typeConsumableService->getAllConsumableTypes($this->pages);
            return view("funitures.types.index", [
                'types'       => $types,
                'editedType'  => $type,
                'id'          => $id,
                'url'         => "consumables.types.update",
                'title'       => 'Modifier le type du consommable'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.types.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $type = $this->typeConsumableService->getOneConsumableById($id);
            if (!$type)
                return Redirect::route('consumables.types.index')->with('error', "Le type est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->typeConsumableService->updateConsumableType($type, $data);

            if ($result)
                return Redirect::route('consumables.types.index')->with('success', "Le type du consommable est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.types.index')->with('error', "Une erreur technique est survenue pendant la création du type de consommable");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $type = $this->typeConsumableService->getOneConsumableById($id);
            if (!$type)
                return Redirect::route('consumables.types.index')->with('error', "Le type est introuvable");

            $result = $this->typeConsumableService->deleteConsumableType($type);
            if ($result)
                return Redirect::route('consumables.types.index')->with('success', "Le type du consommable est supprimé avec succès !");
            else
                return Redirect::route('consumables.types.index')->with('error', "Une erreur technique est survenue pendant la suppression du type de consommable");


        }catch (\Exception $exception) {
            return Redirect::route('consumables.types.index')->with('error', $exception->getMessage());
        }
    }
}
