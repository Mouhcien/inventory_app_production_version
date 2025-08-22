<?php

namespace App\Http\Controllers;

use App\Services\Furniture\ConsumableService;
use App\Services\Furniture\FittingService;
use App\Services\Furniture\TypeConsumableService;
use App\Services\Material\ModelMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ConsumableController extends Controller
{
    private int $pages = 10;
    private ConsumableService $consumableService;
    private TypeConsumableService $typeConsumableService;
    private ModelMaterialService $modelMaterialService;
    private FittingService $fittingService;
    private array $rules = [
        'ref'     => 'required|max:255',
        'type_consumable_id' => 'required'
    ];

    /**
     * @param ConsumableService $consumableService
     */
    public function __construct(ConsumableService $consumableService,
                                TypeConsumableService $typeConsumableService,
                                ModelMaterialService $modelMaterialService,
                                FittingService $fittingService)
    {
        $this->consumableService = $consumableService;
        $this->typeConsumableService = $typeConsumableService;
        $this->modelMaterialService = $modelMaterialService;
        $this->fittingService = $fittingService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $consumables = $this->consumableService->getAllConsumables($this->pages);
            $types = $this->typeConsumableService->getAllConsumableTypes(0);

            return view("funitures.consumables.index", [
                'consumables'      => $consumables,
                'editedConsumable' => null,
                'id'         => null,
                'url'        => 'consumables.store',
                'title'      => 'Nouveau Consumable',
                'types'     => $types
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
            $this->rules['image']    = 'required|image|mimes:jpg,jpeg,png,gif|max:2048';

            $data       = $request->validate($this->rules);
            $data["description"] = $request->get('description');
            $data["image"]  = file_get_contents($request->file('image')->getRealPath());

            $result     = $this->consumableService->createNewConsumable($data);

            if ($result)
                return Redirect::route('consumables.index')->with('success', "Nouveau consommable ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', "Une erreur technique est survenue pendant la création du consumable de consommable");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $consumable = $this->consumableService->getOneConsumableById($id);
            $models = $this->modelMaterialService->getAllMaterialModels(0);

            if (!$consumable)
                return Redirect::route('consumables.index')->with('error', "Le consumable est introuvable");

            return view('funitures.consumables.show', [
                'consumable' => $consumable,
                'models' => $models
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $consumable  = $this->consumableService->getOneConsumableById($id);
            $consumables = $this->consumableService->getAllConsumables($this->pages);
            $types = $this->typeConsumableService->getAllConsumableTypes(0);
            return view("funitures.consumables.index", [
                'consumables'       => $consumables,
                'editedConsumable'  => $consumable,
                'id'          => $id,
                'url'         => "consumables.update",
                'title'       => 'Modifier le consumable',
                'types'     => $types
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $consumable = $this->consumableService->getOneConsumableById($id);
            if (!$consumable)
                return Redirect::route('consumables.index')->with('error', "Le consumable est introuvable");

            $data                   = $request->validate($this->rules);
            $data["description"]    = $request->get('description');

            if ($request->hasFile('image'))
                $data["image"]  = file_get_contents($request->file('image')->getRealPath());
            else
                $data["image"]  = $consumable->image;

            $result     = $this->consumableService->updateConsumable($consumable, $data);

            if ($result)
                return Redirect::route('consumables.index')->with('success', "Le consumable est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', "Une erreur technique est survenue pendant la modification du consumable");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $consumable = $this->consumableService->getOneConsumableById($id);
            if (!$consumable)
                return Redirect::route('consumables.index')->with('error', "Le consumable est introuvable");

            $result = $this->consumableService->deleteConsumable($consumable);
            if ($result)
                return Redirect::route('consumables.index')->with('success', "Le consumable du consommable est supprimé avec succès !");
            else
                return Redirect::route('consumables.index')->with('error', "Une erreur technique est survenue pendant la suppression du consumable de consommable");


        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    public function affect(Request $request, string $id)
    {

        try {

            $model_material_id = $request->get('model_material_id');
            $consumable_id = $id;

            $data['model_material_id'] = $model_material_id;
            $data['consumable_id'] = $consumable_id;

            $result = $this->fittingService->createNewFitting($data);
            if ($result)
                return Redirect::route('consumables.show', $consumable_id)->with('success', "Le modèle est bien affecté au consommable!!");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    public function disaffect(string $id)
    {

        try {

            $fitting = $this->fittingService->getOneFittingById($id);

            $result = $this->fittingService->deleteFitting($fitting);
            if ($result)
                return Redirect::route('consumables.show', $fitting->consumable->id)->with('success', "Le moèle est bien retiré!!");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }
}
