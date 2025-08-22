<?php

namespace App\Http\Controllers;

use App\Services\Employee\TypeEntityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeEntityController extends Controller
{
    private int $pages = 10;
    private TypeEntityService $typeEntityService;
    private array $rules = [
        'title'     => 'required|max:255',
    ];

    /**
     * @param TypeEntityService $typeEntityService
     */
    public function __construct(TypeEntityService $typeEntityService)
    {
        $this->typeEntityService = $typeEntityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $types = $this->typeEntityService->getAllTypeEntities($this->pages);
            return view("entities.types.index", [
                'types'      => $types,
                'editedType' => null,
                'id'         => null,
                'url'        => 'entities.types.store',
                'title'      => "Nouveau type d'entité"
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
            $result     = $this->typeEntityService->createNewTypeEntity($data);

            if ($result)
                return Redirect::route('entities.types.index')->with('success', "Le nouveau type est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('entities.types.index')->with('error', "Une erreur technique est survenue pendant la création du type");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $type = $this->typeEntityService->getOneTypeEntityById($id);
            if (!$type)
                return Redirect::route('entities.types.index')->with('error', "Le type est introuvable");

            return view('entities.types.show')->with('type', $type);

        }catch (\Exception $exception) {
            return Redirect::route('types.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $type  = $this->typeEntityService->getOneTypeEntityById($id);
            $types = $this->typeEntityService->getAllTypeEntities($this->pages);
            return view("entities.types.index", [
                'types'       => $types,
                'editedType'  => $type,
                'id'          => $id,
                'url'         => "entities.types.update",
                'title'       => 'Modifier le type'
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
            $type = $this->typeEntityService->getOneTypeEntityById($id);
            if (!$type)
                return Redirect::route('entities.types.index')->with('error', "Le type est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->typeEntityService->updateTypeEntity($type, $data);

            if ($result)
                return Redirect::route('entities.types.index')->with('success', "Le type est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('entities.types.index')->with('error', "Une erreur technique est survenue pendant la modification du service");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $type = $this->typeEntityService->getOneTypeEntityById($id);
            if (!$type)
                return Redirect::route('entities.types.index')->with('error', "Le type est introuvable");

            $result = $this->typeEntityService->deleteTypeEntity($type);
            if ($result)
                return Redirect::route('entities.types.index')->with('success', "Le type est supprimé avec succès !");
            else
                return Redirect::route('entities.types.index')->with('error', "Une erreur technique est survenue pendant la suppression du type ");


        }catch (\Exception $exception) {
            return Redirect::route('entities.types.index')->with('error', $exception->getMessage());
        }
    }


}
