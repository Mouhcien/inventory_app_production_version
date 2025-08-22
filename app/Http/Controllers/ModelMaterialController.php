<?php

namespace App\Http\Controllers;

use App\Services\Material\BrandMaterialService;
use App\Services\Material\DeliveryMaterialService;
use App\Services\Material\MarchMaterialService;
use App\Services\Material\MaterialService;
use App\Services\Material\ModelMaterialService;
use App\Services\Material\TypeMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModelMaterialController extends Controller
{
    private int $pages = 10;
    private ModelMaterialService $modelMaterialService;
    private BrandMaterialService $brandMaterialService;
    private TypeMaterialService $typeMaterialService;
    private MarchMaterialService $marchMaterialService;
    private DeliveryMaterialService $deliveryMaterialService;
    private MaterialService $materialService;
    private array $rules = [
        'title'             => 'required|max:255',
        'type_material_id'  => 'required',
        'brand_material_id' => 'required',
    ];

    /**
     * @param ModelMaterialService $modelMaterialService
     * @param BrandMaterialService $brandMaterialService
     * @param TypeMaterialService $typeMaterialService
     * @param MarchMaterialService $marchMaterialService
     * @param DeliveryMaterialService $deliveryMaterialService
     * @param MaterialService $materialService
     */
    public function __construct(ModelMaterialService $modelMaterialService,
                                BrandMaterialService $brandMaterialService,
                                TypeMaterialService $typeMaterialService,
                                MarchMaterialService $marchMaterialService,
                                DeliveryMaterialService $deliveryMaterialService,
                                MaterialService $materialService)
    {
        $this->modelMaterialService = $modelMaterialService;
        $this->brandMaterialService = $brandMaterialService;
        $this->typeMaterialService = $typeMaterialService;
        $this->marchMaterialService = $marchMaterialService;
        $this->deliveryMaterialService = $deliveryMaterialService;
        $this->materialService = $materialService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $models = $this->modelMaterialService->getAllMaterialModels($this->pages);
            $types  = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            return view("materials.models.index", [
                'models'        => $models,
                'editedModel'   => null,
                'id'            => null,
                'url'           => 'models.store',
                'title'         => 'Nouveau modèle du matériel',
                'types'         => $types,
                'brands'        => $brands
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
            $data                    = $request->validate($this->rules);

            $data['password']        = $request->get('password');
            $data["image"]           = $data["title"];
            $data["image_data"]      = file_get_contents($request->file('image')->getRealPath());

            $result                 = $this->modelMaterialService->createNewMaterialModel($data);

            if ($result)
                return Redirect::route('models.index')->with('success', "Nouveau modèle du matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', "Une erreur technique est survenue pendant la création modèle de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $model  = $this->modelMaterialService->getOneMaterialModelById($id);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);
            $materials = $this->materialService->filterMaterial('model', $id, 10);
            if (!$model)
                return Redirect::route('models.index')->with('error', "Le modèle est introuvable");

            return view('materials.models.show', [
                'model' => $model,
                'marchs' => $marchs,
                'materials' => $materials,
                'total' => $materials->total()
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    public function export(int $id)
    {

        return $this->exportMaterials($this->materialService, 'model', $id);

    }

    public function export_delivery(int $id)
    {

        return $this->exportMaterials($this->materialService, 'delivery', $id);

    }

    public function delivery(string $id)
    {
        try {

            $delivery = $this->deliveryMaterialService->getOneDeliveryById($id);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);
            $materials = $this->materialService->filterMaterial('delivery', $id, 10);
            if (!$delivery)
                return Redirect::route('marchs.index')->with('error', "La livrasion du matériel est introuvable");

            return view('materials.models.delivery',
                [
                    'delivery' => $delivery,
                    'marchs' => $marchs,
                    'materials' => $materials,
                    'total' => $materials->total()
                ]);

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    public function affect(Request $request, string $id)
    {

        try {

            $march_id = $request->get('march_material_id');
            $model_id = $id;

            $result = $this->deliveryMaterialService->affect($model_id, $march_id);
            if ($result)
                return Redirect::route('models.show', $model_id)->with('success', "Le marché est bien affecté au modèle!!");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    public function disaffect(string $id)
    {

        try {

            $delivery = $this->deliveryMaterialService->getOneDeliveryById($id);

            $result = $this->deliveryMaterialService->delete($delivery);
            if ($result)
                return Redirect::route('models.show', $delivery->model_material->id)->with('success', "Le marché est bien retiré!!");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $model  = $this->modelMaterialService->getOneMaterialModelById($id);
            $models = $this->modelMaterialService->getAllMaterialModels($this->pages);
            $types  = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            return view("materials.models.index", [
                'models'        => $models,
                'editedModel'   => $model,
                'id'            => $id,
                'url'           => "models.update",
                'title'         => 'Modifier le modèle du matériel',
                'types'         => $types,
                'brands'        => $brands
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $model = $this->modelMaterialService->getOneMaterialModelById($id);
            if (!$model)
                return Redirect::route('models.index')->with('error', "Le modèle du matériel est introuvable");

            $data               = $request->validate($this->rules);
            $data['password']   = $request->get('password');
            $data["image"]      = $data["title"];
            $data["is_reform"]  = $model->is_reform;

            if ($request->hasFile('image'))
                $data["image_data"]  = file_get_contents($request->file('image')->getRealPath());
            else
                $data["image_data"]  = $model->image_data;

            $result = $this->modelMaterialService->updateMaterialModel($model, $data);

            if ($result)
                return Redirect::route('models.index')->with('success', "Le modèle du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', "Une erreur technique est survenue pendant la création du modèle du matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $model = $this->modelMaterialService->getOneMaterialModelById($id);
            if (!$model)
                return Redirect::route('models.index')->with('error', "Le modèle du matériel est introuvable");

            $result = $this->modelMaterialService->deleteMaterialModel($model);
            if ($result)
                return Redirect::route('models.index')->with('success', "Le modèle du matériel est supprimé avec succès !");
            else
                return Redirect::route('models.index')->with('error', "Une erreur technique est survenue pendant la suppression du model de matériel");


        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Reform the specified resource from storage.
     */
    public function reform(string $id, int $state)
    {
        try {
            $model = $this->modelMaterialService->getOneMaterialModelById($id);
            if (!$model)
                return Redirect::route('models.index')->with('error', "Le modèle du matériel est introuvable");

            $data["title"]              = $model->title;
            $data["image"]              = $model->image;
            $data["image_data"]         = $model->image_data;
            $data["type_material_id"]   = $model->type_material_id;
            $data["brand_material_id"]  = $model->brand_material_id;
            $data["is_reform"]          = $state;

            $result = $this->modelMaterialService->updateMaterialModel($model, $data);

            if ($result)
                return Redirect::route('models.index')->with('success', "Le modèle du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('models.index')->with('error', "Une erreur technique est survenue pendant la création du modèle du matériel");
        }
    }
}
