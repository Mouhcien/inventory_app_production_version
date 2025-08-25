<?php

namespace App\Http\Controllers;

use App\Exports\MaterialExport;
use App\Models\Inventory;
use App\Services\InventoryService;
use App\Services\Material\BrandMaterialService;
use App\Services\Material\DeliveryMaterialService;
use App\Services\Material\MarchMaterialService;
use App\Services\Material\MaterialService;
use App\Services\Material\ModelMaterialService;
use App\Services\Material\ObservationMaterialService;
use App\Services\Material\TypeMaterialService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class MaterialController extends Controller
{

    private MaterialService $materialService;
    private DeliveryMaterialService $deliveryMaterialService;
    private TypeMaterialService $typeMaterialService;
    private BrandMaterialService $brandMaterialService;
    private ModelMaterialService $modelMaterialService;
    private MarchMaterialService  $marchMaterialService;
    private InventoryService $inventoryService;
    private ObservationMaterialService $observationMaterialService;
    private int $pages = 10;
    private array $rules = [
        'serial'            => 'required|max:255',
        'delivery_material_id' => 'required',
    ];

    /**
     * @param MaterialService $materialService
     */
    public function __construct(MaterialService $materialService,
                                DeliveryMaterialService $deliveryMaterialService,
                                TypeMaterialService $typeMaterialService,
                                BrandMaterialService $brandMaterialService,
                                ModelMaterialService $modelMaterialService,
                                MarchMaterialService  $marchMaterialService,
                                InventoryService $inventoryService,
                                ObservationMaterialService  $observationMaterialService
    )
    {
        $this->materialService = $materialService;
        $this->deliveryMaterialService = $deliveryMaterialService;
        $this->typeMaterialService = $typeMaterialService;
        $this->brandMaterialService = $brandMaterialService;
        $this->modelMaterialService = $modelMaterialService;
        $this->marchMaterialService = $marchMaterialService;
        $this->inventoryService = $inventoryService;
        $this->observationMaterialService = $observationMaterialService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $materials  = $this->materialService->getAllMaterials($this->pages);
            $types      = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands     = $this->brandMaterialService->getAllMaterialBrands(0);
            $models     = $this->modelMaterialService->getAllMaterialModels(0);
            $marchs     = $this->marchMaterialService->getAllMaterialMarchs(0);

            return view("materials.materials.index", [
                'materials' => $materials,
                'types'     => $types,
                'brands'    => $brands,
                'models'    => $models,
                'marchs'    => $marchs,
                'total'     => $materials->total()
            ]);

        }catch (\Exception $exception) {

        }
    }

    public function create()
    {
        try {

            $deliveries = $this->deliveryMaterialService->getAllDeliveries();

            return view("materials.materials.create", [
                'title' => 'Nouveau matériel',
                'url' => 'materials.store',
                'id' => null,
                'editedMaterial' => null,
                'deliveries' => $deliveries
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
            $data                       = $request->validate($this->rules);
            $data['ip']                 = $request->get('ip');
            $data['inventory_number']   = $request->get('inventory_number');
            $result                     = $this->materialService->createNewMaterial($data);

            if ($result)
                return Redirect::route('materials.index')->with('success', "Nouveau matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('materials.create')->with('error', "Une erreur technique est survenue pendant la création de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {

            $material = $this->materialService->getOneMaterialById($id);
            if (!$material)
                return Redirect::route('materials.index')->with('error', "Le material est introuvable");

            return view('materials.materials.show',
                [
                    'material' => $material
                ]);

        }catch (\Exception $exception) {
            return Redirect::route('materials.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $material   = $this->materialService->getOneMaterialById($id);
            $deliveries = $this->deliveryMaterialService->getAllDeliveries();

            return view("materials.materials.create", [
                'deliveries' => $deliveries,
                'editedMaterial' => $material,
                'id' => $id,
                'title' => 'Modifier ce matériel',
                'url' => 'materials.update',
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('materials.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $material = $this->materialService->getOneMaterialById($id);
            if (!$material)
                return Redirect::route('materials.index')->with('error', "Le material est introuvable");

            $data                       = $request->validate($this->rules);
            $data['ip']                 = $request->get('ip');
            $data['inventory_number']   = $request->get('inventory_number');
            $data['state']              = $material->state;
            $data['is_reform']          = $material->is_reform;
            $data['is_deployed']        = $material->is_deployed;
            $result                     = $this->materialService->updateMaterial($material, $data);

            if ($result)
                return Redirect::route('materials.index')->with('success', "Le material est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('materials.edit', $id)->with('error', "Une erreur technique est survenue pendant la modification de material");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $material = $this->materialService->getOneMaterialById($id);
            if (!$material)
                return Redirect::route('materials.index')->with('error', "Le material est introuvable");

            $result = $this->materialService->deleteMaterial($material);
            if ($result)
                return Redirect::route('materials.index')->with('success', "Le material est supprimé avec succès !");
            else
                return Redirect::route('materials.index')->with('error', "Une erreur technique est survenue pendant la suppression de matériel");


        }catch (\Exception $exception) {
            return Redirect::route('materials.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Reform the specified resource from storage.
     */
    public function reform(string $id, int $state)
    {
        try {
            $material = $this->materialService->getOneMaterialById($id);
            if (!$material)
                return Redirect::route('materials.index')->with('error', "Le material est introuvable");

            $data['serial']             = $material->serial;
            $data['delivery_material_id']  = $material->delivery_material_id;
            $data['ip']                 = $material->ip;
            $data['is_reform']          = $state;
            $data['state']              = $material->state;
            $result                     = $this->materialService->updateMaterial($material, $data);


            if ($result)
                return Redirect::route('materials.index')->with('success', "Opération fait avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('materials.index')->with('error', "Une erreur technique est survenue pendant la modification (réforme opération) du material de matériel");
        }
    }

    public function situation(string $id) {
        $material = $this->materialService->getOneMaterialById($id);
        if (!$material)
            return Redirect::route('materials.index')->with('error', "Le material est introuvable");

        return view("materials.materials.situation", [
            'material' => $material
        ]);
    }

    public function change(Request $request, string $id) {
        try {
            $material = $this->materialService->getOneMaterialById($id);
            if (!$material)
                return Redirect::route('materials.situation', $id)->with('error', "Le material est introuvable");

            $state                      = $request->get('state');
            $deployed                   = $request->get('is_deployed');

            $data['serial']             = $material->serial;
            $data['delivery_material_id']  = $material->delivery_material_id;
            $data['ip']                 = $material->ip;
            $data['inventory_number']   = $material->inventory_number;
            $data['is_reform']          = $material->is_reform;
            $data['state']              = $state;
            $data['is_deployed']        = $deployed;
            $result                     = $this->materialService->updateMaterial($material, $data);

            if ($result)
                return Redirect::route('materials.show', $id)->with('success', "Le material est modifié avec succès !");
        }catch (\Exception $exception) {
            return Redirect::route('materials.situation', $id)->with('error', "Une erreur technique est survenue pendant la modification (changer la situation) de matériel");
        }

    }

    public function import(Request $request, string $delivery_id){

        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                foreach ($rows[0] as $rr) {
                    $data['serial']             = $rr[0];
                    $data['delivery_material_id']  = $delivery_id;
                    $data['ip']                 = $rr[1] ?? null;
                    $data['inventory_number']   = $rr[2] ?? null;
                    $data['is_reform']          = false;
                    $data['state']              = 1;
                    $data['is_deployed']        = false;

                    $this->materialService->createNewMaterial($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('materials.index')->with('success', "Nouveaux matériels ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('materials.index')->with('error', "Nouveaux matériels ajouté ".$count."/".count($rows[0])." !");
                }

            }else{
                return Redirect::route('models.show', $delivery_id)->with('error', "Merci de spécifier le fichier excel contenant les matériels");
            }

        }catch (\Exception $exception) {
            return Redirect::route('models.show', $delivery_id)->with('error', "Une erreur technique est survenue pendant la création de matériel");
        }
    }

    public function prepare(string $delivery_id){
        try {
            $delivery = $this->deliveryMaterialService->getOneDeliveryById($delivery_id);

            return view('materials.materials.import')->with('delivery', $delivery);

        }catch (\Exception $exception) {
            return Redirect::route('materials.materials.import', $delivery_id)->with('error', "Une erreur technique est survenue pendant la modification (changer la situation) de matériel");
        }
    }

    public function export() {

        return $this->exportMaterials($this->materialService, null);
    }

    public function search_export() {
        session()->forget('materials_filtered');
        return $this->exportMaterials($this->materialService, null);
    }

    public function filter(string $filter, string $value) {
        try {
            $materials = $this->materialService->filterMaterial($filter, $value, 10);

            $types = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);

            return view("materials.materials.index", [
                'materials'      => $materials,
                'types' => $types,
                'brands' => $brands,
                'models' => $models,
                'marchs' => $marchs,
                'total' => $materials->total()
            ]);

        }catch(\Exception $exception) {

        }
    }

    public function advance(Request $request) {
        try {

            $type_id = null;
            $brand_id = null;
            $model_id = null;
            $march_id = null;
            $searchedSerial = null;
            $materials = null;
            $materials_download = null;
            $stateValue = null;

            $types = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);

            //?type=4&brand=2&march=4&model=2

            if ($request->has('type')){
                $type_id = $request->query('type');

                $brands = $this->brandMaterialService->getAllBrandsByType($type_id, 0);
                $models = $this->modelMaterialService->getAllModelsByType($type_id, 0);
                $marchs = $this->marchMaterialService->getAllMarchsByType($type_id, 0);

                $materials = $this->materialService->filterMaterial('type', $type_id, $this->pages);
                $materials_download = $this->materialService->filterMaterial('type', $type_id, 0);
            }

            if ($request->has('brand')){
                $brand_id = $request->query('brand');

                if ($request->has('type')) {
                    $type_id = $request->query('type');
                    $models = $this->modelMaterialService->getAllModelsByBrandAndType($type_id, $brand_id, 0);

                    $materials = $this->materialService->filterMaterialByTypeAndBrand($type_id, $brand_id, $this->pages);
                    $materials_download = $this->materialService->filterMaterialByTypeAndBrand($type_id, $brand_id, 0);
                }else{
                    $models = $this->modelMaterialService->getAllModelsByType($type_id, 0);

                    $materials = $this->materialService->filterMaterial('brand', $brand_id, $this->pages);
                    $materials_download = $this->materialService->filterMaterial('brand', $brand_id, 0);
                }

                $marchs = $this->marchMaterialService->getAllMaterialMarchsByBrand($brand_id, 0);

            }

            if ($request->has('model')){
                $model_id = $request->query('model');

                $marchs = $this->marchMaterialService->getAllMarchsByModel($model_id, 0);

                $materials = $this->materialService->filterMaterialByTypeAndBrandAndModel($type_id, $brand_id, $model_id, $this->pages);
                $materials_download = $this->materialService->filterMaterialByTypeAndBrandAndModel($type_id, $brand_id, $model_id, 0);
            }

            if ($request->has('march')){
                $march_id = $request->query('march');

                $materials = $this->materialService->getAllMaterialsByFilter($type_id, $brand_id, $model_id, $march_id, $this->pages);
                $materials_download = $this->materialService->getAllMaterialsByFilter($type_id, $brand_id, $model_id, $march_id, 0);
            }

            if ($request->has('sr')) {
                $searchedSerial = $request->query('sr');
                $materials = $this->materialService->filterMaterial('serial', $searchedSerial, $this->pages);
                $materials_download = $this->materialService->filterMaterial('serial', $searchedSerial, 0);
            }

             if ($request->has('state')) {
                $stateValue = $request->query('state');
                $materials =  $this->materialService->filterMaterial('state', $stateValue, $this->pages);
                $materials_download = $this->materialService->filterMaterial('state', $stateValue, 0);
            }

            if ($request->has('fr')) {
                $stateValue = $request->query('fr');
                //$materials =  $this->materialService->getMaterialsNotAffectedToUser($this->pages);
                $materials =  $this->materialService->getMaterialsNotAffectedToUserWithoutBigPrinters($this->pages);
                $materials_download = $this->materialService->getMaterialsNotAffectedToUserWithoutBigPrinters(0);
            }

            session()->put('materials_filtered', $materials_download);

            return view("materials.materials.advance", [
                'types' => $types,
                'brands' => $brands,
                'models' => $models,
                'marchs' => $marchs,
                'type_id' => $type_id,
                'brand_id' => $brand_id,
                'model_id' => $model_id,
                'march_id' => $march_id,
                'materials' => $materials,
                'searchedSerial' => $searchedSerial,
                'stateValue' => $stateValue,
            ]);

        }catch(\Exception $exception) {

        }
    }

    public function fresult(Request $request) {
        try {

            $type_id = $request->query('adv_type_material_id');
            $brand_id = $request->query('adv_brand_material_id');
            $model_id = $request->query('adv_model_material_id');
            $march_id = $request->query('adv_march_material_id');

            $materials = $this->materialService->getAllMaterialsByFilter($type_id, $brand_id, $model_id, $march_id, $this->pages);

            dd($materials);

            return Redirect::route('materials.advance', $materials);

        }catch (\Exception $exception) {

        }
    }

    public function search($value) {

    }

    public function history($id) {
        $material = $this->materialService->getOneMaterialById($id);

        $inventories = $this->inventoryService->getInventoryHistoryByMaterial($id, $this->pages);

        return view('materials.materials.history', [
            'material' => $material,
            'inventories' => $inventories
        ]);
    }

    public function import_ip() {

        return view('materials.materials.ip');
    }

    public function import_ip_store(Request $request) {
        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                $serials_err = "";
                foreach ($rows[0] as $rr) {
                    $serial = trim($rr[0]);
                    $ip = trim($rr[01]);
                    $material = $this->materialService->getOneMaterialBySerial($serial);
                    if (is_null($material)) {
                        $serials_err .= "[ ".$serial." ] - ";
                        continue;
                    }


                    $data['ip']  = $ip;

                    $this->materialService->updateMaterial($material, $data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('materials.ip.import')->with('success', "Nouveaux IP matériels ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('materials.ip.import')->with('error', "Nouveaux matériels ajouté ".$count."/".count($rows[0])." {$serials_err}!");
                }

            }else{
                return Redirect::route('materials.ip.import')->with('error', "Merci de spécifier le fichier excel contenant les dresses ip");
            }

        }catch (\Exception $exception) {
            return Redirect::route('materials.ip.import')->with('error', "Une erreur technique est survenue pendant la création de matériel");
        }
    }

    public function observations(Request $request) {

        $observations = $this->observationMaterialService->getAllMaterialObservations($this->pages);
        $titles = $this->observationMaterialService->getallDistinctTitles(0);

        if ($request->has('fltr')) {
            $title = $request->query('fltr');
            $observations = $this->observationMaterialService->getAllMaterialObservationsByTitle($title, $this->pages);
        }

        return view('materials.observations.index', [
            'observations' => $observations,
            'titles' => $titles
        ]);
    }

}
