<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use App\Services\Employee\EntityService;
use App\Services\Employee\SecterEntityService;
use App\Services\Employee\SectionEntityService;
use App\Services\Employee\ServiceEntityService;
use App\Services\InventoryPhotocopyService;
use App\Services\InventoryService;
use App\Services\Local\LocalService;
use App\Services\Material\BrandMaterialService;
use App\Services\Material\DeliveryMaterialService;
use App\Services\Material\MarchMaterialService;
use App\Services\Material\MaterialService;
use App\Services\Material\ModelMaterialService;
use App\Services\Material\TypeMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
    private InventoryService $inventoryService;
    private TypeMaterialService $typeMaterialService;
    private BrandMaterialService $brandMaterialService;
    private ModelMaterialService $modelMaterialService;
    private MarchMaterialService $marchMaterialService;
    private MaterialService $materialService;
    private EmployeeService $employeeService;
    private ServiceEntityService $serviceEntityService;
    private LocalService $localService;
    private EntityService $entityService;
    private SecterEntityService $secterEntityService;
    private SectionEntityService $sectionEntityService;
    private DeliveryMaterialService $deliveryMaterialService;
    private InventoryPhotocopyService $inventoryPhotocopyService;
    private int $pages= 10;
    private array $rules = [
        'material_id' => 'required',
        'employee_id' => 'required'
    ];

    /**
     * @param InventoryService $inventoryService
     * @param TypeMaterialService $typeMaterialService
     * @param BrandMaterialService $brandMaterialService
     * @param ModelMaterialService $modelMaterialService
     * @param MarchMaterialService $marchMaterialService
     * @param MaterialService $materialService;
     * @param EmployeeService $employeeService
     */
    public function __construct(InventoryService $inventoryService,
                                TypeMaterialService $typeMaterialService,
                                BrandMaterialService $brandMaterialService,
                                ModelMaterialService $modelMaterialService,
                                MarchMaterialService $marchMaterialService,
                                MaterialService $materialService,
                                EmployeeService $employeeService,
                                ServiceEntityService $serviceEntityService,
                                LocalService $localService,
                                EntityService $entityService,
                                SecterEntityService $secterEntityService,
                                SectionEntityService $sectionEntityService,
                                DeliveryMaterialService $deliveryMaterialService,
                                InventoryPhotocopyService $inventoryPhotocopyService
    )
    {
        $this->inventoryService = $inventoryService;
        $this->typeMaterialService = $typeMaterialService;
        $this->brandMaterialService = $brandMaterialService;
        $this->modelMaterialService = $modelMaterialService;
        $this->marchMaterialService = $marchMaterialService;
        $this->materialService = $materialService;
        $this->employeeService = $employeeService;
        $this->serviceEntityService = $serviceEntityService;
        $this->localService = $localService;
        $this->entityService = $entityService;
        $this->secterEntityService = $secterEntityService;
        $this->sectionEntityService = $sectionEntityService;
        $this->deliveryMaterialService = $deliveryMaterialService;
        $this->inventoryPhotocopyService = $inventoryPhotocopyService;
    }

    public function index() {
        try {
            $inventories = $this->inventoryService->getAllInventories($this->pages);
            $types = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            return view('inventories.index', [
                'inventories' => $inventories,
                'types' => $types,
                'brands' => $brands,
                'marchs' => $marchs,
                'models' => $models,
                'is_filter' => null
            ]);
        }catch (\Exception $exception){

        }
    }

    public function search(Request $request) {
        try {
            $inventories = null;
            $filter = null;

            if ($request->has('fltr')) {
                $filter = $request->query('fltr');
                $inventories = $this->inventoryService->getAllInventoriesByFilter($filter, $this->pages);
            }

            return view('inventories.search', [
                'inventories' => $inventories,
                'filter' => $filter
            ]);
        }catch (\Exception $exception){

        }
    }

    public function advance(Request $request) {
        try {

            $type_id = null;
            $brand_id = null;
            $model_id = null;
            $march_id = null;
            $searchedSerial = null;
            $inventories = null;
            $selectedLocal = null;
            $selectedService= null;
            $selectedEntity= null;
            $selectedSecter= null;
            $selectedSection= null;
            $filterValue = null;
            $locals = null;
            $stateValue= null;

            $filter = [];


            $types = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            $models = $this->modelMaterialService->getAllMaterialModels(0);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);

            $services = $this->serviceEntityService->getAllServiceEntities(0);
            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities(0);
            $locals = $this->localService->getAllLocals(0);


            if ($request->has('srl')) {
                $searchedSerial = $request->query('srl');
                $dataFilter['filter'] = 'serial';
                $dataFilter['value'] = $searchedSerial;
                $filter[] = $dataFilter;
            }

            if ($request->has('fltr')) {
                $filterValue = $request->query('fltr');
                $dataFilter['filter'] = 'fltrEmp';
                $dataFilter['value'] = $filterValue;
                $filter[] = $dataFilter;
            }

            if ($request->has('loc')) {
                $selectedLocal = $request->query('loc');
                $dataFilter['filter'] = 'local';
                $dataFilter['value'] = $selectedLocal;
                $filter[] = $dataFilter;

            }

            if ($request->has('srv')) {
                $selectedService = $request->query('srv');
                $entities = $this->entityService->getAllEntitiesByService($selectedService, 0);
                $secters = $this->secterEntityService->getSectersByService($selectedService, 0);
                $sections = $this->sectionEntityService->getSectionsByService($selectedService, 0);

                $dataFilter['filter'] = 'service';
                $dataFilter['value'] = $selectedService;
                $filter[] = $dataFilter;
            }

            if ($request->has('ent')) {
                $selectedEntity = $request->query('ent');
                $entities = $this->entityService->getAllEntitiesByService($selectedService, 0);
                $secters = $this->secterEntityService->getSectersByEntity($selectedEntity, 0);
                $sections = $this->sectionEntityService->getSectionsByEntity($selectedEntity, 0);

                $dataFilter['filter'] = 'entity';
                $dataFilter['value'] = $selectedEntity;
                $filter[] = $dataFilter;
            }

            if ($request->has('sectr')) {
                $selectedSecter = $request->query('sectr');

                $dataFilter['filter'] = 'secter';
                $dataFilter['value'] = $selectedSecter;
                $filter[] = $dataFilter;

            }

            if ($request->has('sect')) {
                $selectedSection = $request->query('sect');

                $dataFilter['filter'] = 'section';
                $dataFilter['value'] = $selectedSection;
                $filter[] = $dataFilter;

            }

            if ($request->has('type')){
                $type_id = $request->query('type');

                $brands = $this->brandMaterialService->getAllBrandsByType($type_id, 0);
                $models = $this->modelMaterialService->getAllModelsByType($type_id, 0);
                $marchs = $this->marchMaterialService->getAllMarchsByType($type_id, 0);

                $dataFilter['filter'] = 'type';
                $dataFilter['value'] = $type_id;
                $filter[] = $dataFilter;
            }

            if ($request->has('brand')){
                $brand_id = $request->query('brand');

                if ($request->has('type')) {
                    $type_id = $request->query('type');
                    $models = $this->modelMaterialService->getAllModelsByBrandAndType($type_id, $brand_id, 0);
                }else{
                    $models = $this->modelMaterialService->getAllModelsByType($type_id, 0);
                }

                $marchs = $this->marchMaterialService->getAllMaterialMarchsByBrand($brand_id, 0);

                $dataFilter['filter'] = 'brand';
                $dataFilter['value'] = $brand_id;
                $filter[] = $dataFilter;

            }

            if ($request->has('model')){
                $model_id = $request->query('model');

                $marchs = $this->marchMaterialService->getAllMarchsByModel($model_id, 0);

                $dataFilter['filter'] = 'model';
                $dataFilter['value'] = $model_id;
                $filter[] = $dataFilter;
            }

            if ($request->has('march')){
                $march_id = $request->query('march');

                $dataFilter['filter'] = 'march';
                $dataFilter['value'] = $march_id;
                $filter[] = $dataFilter;
            }

            if ($request->has('state')){
                $stateValue = $request->query('state');

                $dataFilter['filter'] = 'state';
                $dataFilter['value'] = $stateValue;
                $filter[] = $dataFilter;
            }

            $inventories = $this->inventoryService->getAllInventoriesByAdvanceFilter($filter, $this->pages);
            session()->put('inventories_filtered', $inventories);

            return view("inventories.advance", [
                'types' => $types,
                'brands' => $brands,
                'models' => $models,
                'marchs' => $marchs,
                'type_id' => $type_id,
                'brand_id' => $brand_id,
                'model_id' => $model_id,
                'march_id' => $march_id,
                'inventories' => $inventories,
                'searchedSerial' => $searchedSerial,
                'selectedLocal' => $selectedLocal,
                'selectedService' => $selectedService,
                'selectedEntity' => $selectedEntity,
                'selectedSecter' => $selectedSecter,
                'selectedSection' => $selectedSection,
                'filterValue' => $filterValue,
                'services' => $services,
                'entities' => $entities,
                'secters' => $secters,
                'sections' => $sections,
                'locals' => $locals,
                'stateValue' => $stateValue,
                'filter' => null,
                'value' => null
            ]);

        }catch(\Exception $exception) {

        }
    }

    public function create(Request $request) {
        try {
            $employeeSelected = null;
            $materialSelected = null;
            $deliverySelected = null;

            $employees = $this->employeeService->getAllEmployees(0);

            $deliveries = $this->deliveryMaterialService->getAllDeliveries();
            $materials = $this->materialService->getAllMaterials(0);

            if ($request->has('delv')) {
                $deliverySelected = $request->query('delv');
                $materials = $this->materialService->getAllMaterialsByDelivery($deliverySelected, 0);
            }

            if ($request->has('emp')) {
                $employeeSelected = $this->employeeService->getOneEmployeeById($request->query('emp'));
            }

            if ($request->has('mat')) {
                $materialSelected = $this->materialService->getOneMaterialById($request->query('mat'));
            }

            return view('inventories.create', [
                'materials' => $materials,
                'employees' => $employees,
                'employeeSelected' => $employeeSelected,
                'materialSelected' => $materialSelected,
                'deliveries' => $deliveries,
                'deliverySelected' => $deliverySelected
            ]);
        }catch(\Exception $exception) {

        }
    }

    public function edit(Request $request, int $id) {
        try {

            $inventory = $this->inventoryService->getOneInventoryById($id);
            if (is_null($inventory))
                Redirect::route('inventories.index')->with('error', 'Inventaire introuvable !!!');

            return view('inventories.edit', [
                'inventory' => $inventory
            ]);
        }catch(\Exception $exception) {

        }
    }

    public function show(int $id) {
        try {

            $inventory = $this->inventoryService->getOneInventoryById($id);
            if (is_null($inventory))
                Redirect::route('inventories.index')->with('error', 'Inventaire introuvable !!!');

            return view('inventories.show', [
                'inventory' => $inventory
            ]);
        }catch(\Exception $exception) {

        }
    }

    public function update(Request $request, int $id) {
        try {

            $inventory = $this->inventoryService->getOneInventoryById($id);
            if (is_null($inventory))
                return Redirect::route('inventories.index')->with('error', 'Inventaire introuvable !!!');

            $data = $request->validate($this->rules);

            $data['employee_id'] = $inventory->employee_id;
            $data['material_id'] = $inventory->material_id;
            $data['is_active'] = false;

            $result = $this->inventoryService->updateInventory($inventory, $data);
            if (!$result)
                return Redirect::route('inventories.edit', $inventory->id)->with('error', 'Erreur lors de la modification !!!');

            return Redirect::route('inventories.create')->with('success', 'Inventaire est bien modifier, merci de créer une autre attribution !!!');

        }catch(\Exception $exception) {

        }
    }

    public function store(Request $request, $employee_id, $material_id) {
        try {

            $data["employee_id"] = $employee_id;
            $data["material_id"] = $material_id;

            $material = $this->materialService->getOneMaterialById($material_id);
            if(is_null($material))
                return Redirect::route("inventories.index")->with('error', "le matériel est introuvable !!");

            //Si le type du matériel est photocopie
            if ($material->delivery_material->model_material->type_material->id == "5") {

                $employee = $this->employeeService->getOneEmployeeById($employee_id);
                if (is_null($employee))
                    return Redirect::route('inventories.index')->with('error', "Employé est introuvable");
                if (!is_null($employee->service_entity_id))
                    $data['service_entity_id'] = $employee->service_entity_id;
                if (!is_null($employee->entity_id))
                    $data['entity_id'] = $employee->entity_id;
                if (!is_null($employee->secter_entity_id))
                    $data['secter_entity_id'] = $employee->secter_entity_id;
                if (!is_null($employee->section_entity_id))
                    $data['section_entity_id'] = $employee->section_entity_id;
                if (!is_null($employee->local_id))
                    $data['local_id'] = $employee->local_id;

                $result = $this->inventoryPhotocopyService->createNewInventoryPhotocopy($data);
            }else{
                $result = $this->inventoryService->createNewInventory($data);
            }

            if ($result)
                return Redirect::route('inventories.index')->with('success', "affectation ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('inventories.index')->with('error', "Une erreur technique est survenue pendant l affectation");
        }
    }

    public function prepare() {
        return view('inventories.prepare');
    }

    public function import(Request $request) {
        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $employee_error_data = null;
                $material_error_data = null;
                $count = 0;
                foreach ($rows[0] as $rr) {
                    $serial = $rr[0];
                    $ppr = $rr[1];

                    if ($ppr == null || $serial == null)
                        continue;

                    //get the employee by ppr
                    $employee = $this->employeeService->getOneEmployeeByPPR($ppr);

                    //get material by serial
                    $material = $this->materialService->getOneMaterialBySerial($serial);

                    if (is_null($employee) || is_null($material))
                    {
                        $employee_error_data .= " - ".$ppr;
                        $material_error_data .= " - ".$serial;
                        continue;
                    }

                    $data['material_id'] = $material->id;
                    $data['employee_id'] = $employee->id;

                    $this->inventoryService->createNewInventory($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('inventories.index')->with('success', "Liste d'inventaitaire ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('inventories.index')
                        ->with('error', "Liste d'inventaire ajouté ".$count."/".count($rows[0])." ! [vérifier les PPRs ($employee_error_data)] -- [vérifier les séries ($material_error_data)]");
                }

            }else{
                return Redirect::route('inventories.prepare')->with('error', "Merci de spécifier le fichier excel");
            }

        }catch (\Exception $exception) {
            return Redirect::route('inventories.prepare')->with('error', "Une erreur technique est survenue ".$exception->getMessage());
        }
    }

    public function export() {
        try {
            return $this->exportInventoryMaterials($this->inventoryService, null);
        }catch(\Exception $exception) {

        }
    }

    public function export_search($filter) {
        try {
            session()->forget('inventories_filtered');
            return $this->exportInventoryMaterials($this->inventoryService, $filter);
        }catch(\Exception $exception) {

        }
    }

    public function filter(string $filter, string $value) {
        try {
            switch ($filter) {
                case 'type':
                    $inventories = $this->inventoryService->getAllInventoriesByType($value, $this->pages);
                    break;
                case 'brand':
                    $inventories = $this->inventoryService->getAllInventoriesByBrand($value, $this->pages);
                    break;
                case 'march':
                    $inventories = $this->inventoryService->getAllInventoriesByMarch($value, $this->pages);
                    break;
                case 'model':
                    $inventories = $this->inventoryService->getAllInventoriesByModel($value, $this->pages);
                    break;
                default:
                    $inventories = $this->inventoryService->getAllInventories($this->pages);
                    break;
            }

            $types = $this->typeMaterialService->getAllMaterialTypes(0);
            $brands = $this->brandMaterialService->getAllMaterialBrands(0);
            $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);
            $models = $this->modelMaterialService->getAllMaterialModels(0);

            return view('inventories.index', [
                'inventories' => $inventories,
                'types' => $types,
                'brands' => $brands,
                'marchs' => $marchs,
                'models' => $models,
                'filter' => $filter,
                'value' => $value,
                'is_filter' => true
            ]);

        }catch(\Exception $exception) {

        }
    }

    public function export_filter(string $filter = null, string $value=null) {

        try {
            return $this->exportInventoryMaterials($this->inventoryService, $filter, $value);
        }catch(\Exception $exception) {

        }

    }

    public function check() {

        $results = [];
        $duplicateSerials = null;
        $duplicateInventorySerials = null;
        $materialNotAffected = null;
        $employeesWithMoreMaterials = null;
        $employeesWithMoreThanOneMaterialForEachType = null;
        $duplicateEmployeePPR = null;

        /*
         *
         *  Vérifier la duplication d'une série d'équipement.
         *  Vérifier si une série d'équipements est attribuée à plusieurs employés.
         *  Vérifier si une série d'équipements n'est attribuée à aucun employé.
         *  Vérifier que le nombre de matériels attribués à un employé ne dépasse pas 3.
         *  Vérifier si un employé dispose d'une seule série pour chaque type d'équipement.
         *  Vérifier la duplication du PPR d'un employé.
         *
         */

        // Vérifier la duplication d'une série d'équipement.
        $duplicateSerials = $this->materialService->getDuplicateSerial();

        // Vérifier si une série d'équipements est attribuée à plusieurs employés.
        $duplicateInventorySerials = $this->inventoryService->getAllDuplicateSerialInInventory();

        //Vérifier si une série d'équipements n'est attribuée à aucun employé.
        $materialNotAffected = $this->materialService->getMaterialsNotAffectedToUserWithoutBigPrinters();

        //Vérifier que le nombre de matériels attribués à un employé ne dépasse pas 3.
        $employeesWithMoreMaterials = $this->inventoryService->materialsForEachEmployees(5);

        //Vérifier si un employé dispose d'une seule série pour chaque type d'équipement.
        $employeesWithMoreThanOneMaterialForEachType = $this->inventoryService->employeesWithMoreThanOneMaterialForEachType();

        //Vérifier la duplication du PPR d'un employé.
        $duplicateEmployeePPR = $this->employeeService->getEmployeeWithDuplicatePPR();

        return view('inventories.check', [
            'results' => $results,
            'duplicateSerials' => $duplicateSerials,
            'duplicateInventorySerials' => $duplicateInventorySerials,
            'materialNotAffected' => $materialNotAffected,
            'employeesWithMoreMaterials' => $employeesWithMoreMaterials,
            'employeesWithMoreThanOneMaterialForEachType' => $employeesWithMoreThanOneMaterialForEachType,
            'duplicateEmployeePPR' => $duplicateEmployeePPR
        ]);
    }

    public function photocopies() {

        $photocopies = $this->inventoryPhotocopyService->getAllInventories($this->pages);

        return view('inventories.photocopies.index', [
            'photocopies' => $photocopies,
            'option' => null
        ]);
    }

    public function vacant_photocopies() {

        $photocopies = $this->materialService->getPhotocopiesNotAffectedToUser($this->pages);
        //dd($photocopies);

        return view('inventories.photocopies.index', [
            'photocopies' => $photocopies,
            'option' => 'photocopy_vacant'
        ]);
    }

    public function export_photocopies() {
        try {
            return $this->exportInventoryPhotocopy($this->inventoryPhotocopyService,$this->materialService, null);
        }catch(\Exception $exception) {

        }
    }

    public function export_vacant_photocopies() {
        try {
            return $this->exportInventoryPhotocopy($this->inventoryPhotocopyService, $this->materialService, 'vacant');
        }catch(\Exception $exception) {

        }
    }

    public function photocopies_show($id) {

        $photocopy = $this->inventoryPhotocopyService->getOneInventoryPhotocopyById($id);

        return view('inventories.photocopies.show', [
            'photocopy' => $photocopy
        ]);
    }

    public function photocopies_edit($id) {


        $photocopy = $this->inventoryPhotocopyService->getOneInventoryPhotocopyById($id);

        return view('inventories.photocopies.edit', [
            'photocopy' => $photocopy
        ]);
    }

    public function photocopies_update(Request $request, $id) {

        try {

            $photocopy = $this->inventoryPhotocopyService->getOneInventoryPhotocopyById($id);
            if (is_null($photocopy))
                return Redirect::route('inventories.photocopies.index')->with('error', 'Inventaire introuvable !!!');

            $data['is_active'] = false;

            $result = $this->inventoryPhotocopyService->updateInventoryPhotocopy($photocopy, $data);
            if (!$result)
                return Redirect::route('inventories.photocopies.edit', $photocopy->id)->with('error', 'Erreur lors de la modification !!!');

            return Redirect::route('inventories.photocopies')->with('success', 'Inventaire est bien modifier, merci de créer une autre attribution !!!');

        }catch(\Exception $exception) {

        }
    }




}
