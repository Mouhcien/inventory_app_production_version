<?php

namespace App\Http\Controllers;

use App\Services\Material\DeliveryMaterialService;
use App\Services\Material\MarchMaterialService;
use App\Services\Material\MaterialService;
use App\Services\Material\ModelMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MarchMaterialController extends Controller
{
    private int $pages = 10;
    private MarchMaterialService $marchMaterialService;
    private ModelMaterialService $modelMaterialService;
    private DeliveryMaterialService $deliveryMaterialService;
    private MaterialService $materialService;
    private array $rules = [
        'title'     => 'required|max:255'
    ];

    /**
     * @param MarchMaterialService $marchMaterialService
     */
    public function __construct(MarchMaterialService $marchMaterialService,
                                ModelMaterialService $modelMaterialService,
                                DeliveryMaterialService  $deliveryMaterialService,
                                MaterialService $materialService)
    {
        $this->marchMaterialService = $marchMaterialService;
        $this->modelMaterialService = $modelMaterialService;
        $this->deliveryMaterialService = $deliveryMaterialService;
        $this->materialService = $materialService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $marchs = $this->marchMaterialService->getAllMaterialMarchs($this->pages);
            return view("materials.marchs.index", [
                'marchs'      => $marchs,
                'editedMarch' => null,
                'id'         => null,
                'url'        => 'marchs.store',
                'title'      => 'Nouveau marché du matériel'
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
            $result     = $this->marchMaterialService->createNewMaterialMarch($data);

            if ($result)
                return Redirect::route('marchs.index')->with('success', "Nouveau march de matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', "Une erreur technique est survenue pendant la création du march de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {

            $march = $this->marchMaterialService->getOneMaterialMarchById($id);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            $materials = $this->materialService->filterMaterial('march', $id, 10);
            if (!$march)
                return Redirect::route('marchs.index')->with('error', "Le march est introuvable");

            return view('materials.marchs.show',
            [
                'models' => $models,
                'march' => $march,
                'materials' => $materials,
                'total' => $materials->total()
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    public function export(int $id)
    {

        return $this->exportMaterials($this->materialService, 'march', $id);

    }

    public function export_delivery(int $id)
    {

        return $this->exportMaterials($this->materialService, 'delivery', $id);

    }

    public function delivery(string $id)
    {
        try {

            $delivery = $this->deliveryMaterialService->getOneDeliveryById($id);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            $materials = $this->materialService->filterMaterial('delivery', $id, 10);
            if (!$delivery)
                return Redirect::route('marchs.index')->with('error', "La livrasion du matériel est introuvable");

            return view('materials.marchs.delivery',
                [
                    'delivery' => $delivery,
                    'models' => $models,
                    'materials' => $materials,
                    'total' => $materials->total()
                ]);

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function affect(Request $request, string $id)
    {

        try {

            $march_id = $id;
            $model_id = $request->get('model_material_id');

            $result = $this->deliveryMaterialService->affect($model_id, $march_id);
            if ($result)
                return Redirect::route('marchs.show', $march_id)->with('success', "Le modèle est bien affecté au marché!!");

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    public function disaffect(string $id)
    {

        try {

            $delivery = $this->deliveryMaterialService->getOneDeliveryById($id);

            $result = $this->deliveryMaterialService->delete($delivery);
            if ($result)
                return Redirect::route('marchs.show', $delivery->march_material->id)->with('success', "Le modèle est bien retiré!!");

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $march  = $this->marchMaterialService->getOneMaterialMarchById($id);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs($this->pages);
            return view("materials.marchs.index", [
                'marchs'       => $marchs,
                'editedMarch'  => $march,
                'id'          => $id,
                'url'         => "marchs.update",
                'title'       => 'Modifier le march du matériel'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $march = $this->marchMaterialService->getOneMaterialMarchById($id);
            if (!$march)
                return Redirect::route('marchs.index')->with('error', "Le march est introuvable");

            $data                = $request->validate($this->rules);
            $data['nbr_models']  = $march->nbr_models;
            $data['is_reform']   = $march->is_reform;
            $result     = $this->marchMaterialService->updateMaterialMarch($march, $data);

            if ($result)
                return Redirect::route('marchs.index')->with('success', "Le march du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', "Une erreur technique est survenue pendant la modification du march de matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $march = $this->marchMaterialService->getOneMaterialMarchById($id);
            if (!$march)
                return Redirect::route('marchs.index')->with('error', "Le march est introuvable");

            $result = $this->marchMaterialService->deleteMaterialMarch($march);
            if ($result)
                return Redirect::route('marchs.index')->with('success', "Le marché du matériel est supprimé avec succès !");
            else
                return Redirect::route('marchs.index')->with('error', "Une erreur technique est survenue pendant la suppression du march de matériel");


        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Reform the specified resource from storage.
     */
    public function reform(string $id, int $state)
    {
        try {
            $march = $this->marchMaterialService->getOneMaterialMarchById($id);
            if (!$march)
                return Redirect::route('marchs.index')->with('error', "Le march est introuvable");

            $data['title']       = $march->title;
            $data['nbr_models']  = $march->nbr_models;
            $data['is_reform']   = $state;
            $result              = $this->marchMaterialService->updateMaterialMarch($march, $data);


            if ($result)
                return Redirect::route('marchs.index')->with('success', "Opération fait avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('marchs.index')->with('error', "Une erreur technique est survenue pendant la modification (réforme opération) du march de matériel");
        }
    }
}
