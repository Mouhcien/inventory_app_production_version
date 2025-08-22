<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Models\Delivery;
use App\Models\StockConsumable;
use App\Models\TypeConsumable;
use App\Services\Employee\EmployeeService;
use App\Services\Employee\EntityService;
use App\Services\Employee\SecterEntityService;
use App\Services\Employee\SectionEntityService;
use App\Services\Employee\ServiceEntityService;
use App\Services\Furniture\ConsumableService;
use App\Services\Furniture\DeliveryService;
use App\Services\Furniture\StockService;
use App\Services\Furniture\TypeConsumableService;
use App\Services\InventoryService;
use App\Services\Local\CityService;
use App\Services\Local\LocalService;
use App\Services\Material\BrandMaterialService;
use App\Services\Material\MarchMaterialService;
use App\Services\Material\MaterialService;
use App\Services\Material\ModelMaterialService;
use App\Services\Material\TypeMaterialService;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    private MaterialService $materialService;
    private ModelMaterialService $modelMaterialService;
    private TypeMaterialService $typeMaterialService;
    private BrandMaterialService $brandMaterialService;
    private MarchMaterialService $marchMaterialService;
    private InventoryService $inventoryService;
    private EmployeeService $employeeService;
    private ServiceEntityService $serviceEntityService;
    private EntityService $entityService;
    private SecterEntityService $secterEntityService;
    private SectionEntityService $sectionEntityService;
    private LocalService $localService;
    private CityService $cityService;
    private TypeConsumableService $typeConsumableService;
    private ConsumableService $consumableService;
    private DeliveryService $deliveryService;

    private StockService $stockService;

    /**
     * @param MaterialService $materialService
     * @param ModelMaterialService $modelMaterialService
     * @param TypeMaterialService $typeMaterialService
     * @param BrandMaterialService $brandMaterialService
     * @param MarchMaterialService $marchMaterialService
     * @param InventoryService $inventoryService
     * @param EmployeeService $employeeService
     * @param ServiceEntityService $serviceEntityService
     * @param EntityService $entityService
     * @param SecterEntityService $secterEntityService
     * @param SectionEntityService $sectionEntityService
     * @param LocalService $localService
     * @param CityService $cityService
     * @param StockService $stockService
     * @param DeliveryService $deliveryService
     */
    public function __construct(MaterialService $materialService,
                                ModelMaterialService $modelMaterialService,
                                TypeMaterialService $typeMaterialService,
                                BrandMaterialService $brandMaterialService,
                                MarchMaterialService $marchMaterialService,
                                InventoryService $inventoryService,
                                EmployeeService $employeeService,
                                ServiceEntityService $serviceEntityService,
                                EntityService $entityService,
                                SecterEntityService $secterEntityService,
                                SectionEntityService $sectionEntityService,
                                LocalService $localService,
                                CityService $cityService,
                                TypeConsumableService $typeConsumableService,
                                ConsumableService $consumableService,
                                StockService $stockService,
                                DeliveryService $deliveryService)
    {
        $this->materialService = $materialService;
        $this->modelMaterialService = $modelMaterialService;
        $this->typeMaterialService = $typeMaterialService;
        $this->brandMaterialService = $brandMaterialService;
        $this->marchMaterialService = $marchMaterialService;
        $this->inventoryService = $inventoryService;
        $this->employeeService = $employeeService;
        $this->serviceEntityService = $serviceEntityService;
        $this->entityService = $entityService;
        $this->secterEntityService = $secterEntityService;
        $this->sectionEntityService = $sectionEntityService;
        $this->localService = $localService;
        $this->cityService = $cityService;
        $this->typeConsumableService = $typeConsumableService;
        $this->consumableService = $consumableService;
        $this->stockService = $stockService;
        $this->deliveryService = $deliveryService;
    }


    public function index() {

        $total_materials = $this->materialService->getTotalMaterials();
        $total_models = $this->modelMaterialService->getTotalModels();
        $total_types = $this->typeMaterialService->getTotalTypes();
        $total_brands = $this->brandMaterialService->getTotalBrands();
        $total_marchs = $this->marchMaterialService->getTotalMarchs();
        $total_inventories = $this->inventoryService->getTotalInventories();
        $total_employees = $this->employeeService->getTotalEmployees();
        $total_services = $this->serviceEntityService->getTotalServices();
        $total_entities = $this->entityService->getTotalEntities();
        $total_secters = $this->secterEntityService->getTotalSecter();
        $total_sections = $this->sectionEntityService->getTotalSections();
        $total_cities = $this->cityService->getTotalCities();
        $total_locals = $this->localService->getTotalLocals();
        $total_types_consumables = $this->typeConsumableService->getTotalTypeConsumable();
        $total_consumable = $this->consumableService->getTotalConsumable();

        $total_materials_Damaged  = count($this->materialService->getAllDamagedMaterials());
        $total_materials_Broke  = count($this->materialService->getAllBrokeMaterials());

        $total_materials_non_affected = count($this->materialService->getMaterialsNotAffectedToUser());

        $stocks_by_deliveries = $this->stockService->getAllStockConsumablesGroupedByDelivery();


        return view('statistics.index', [
            'total_materials' => $total_materials,
            'total_models' => $total_models,
            'total_types' => $total_types,
            'total_brands' => $total_brands,
            'total_marchs' => $total_marchs,
            'total_inventories' => $total_inventories,
            'total_employees' => $total_employees,
            'total_services' => $total_services-1,
            'total_entities' => $total_entities,
            'total_secters' => $total_secters,
            'total_sections' => $total_sections,
            'total_cities' => $total_cities,
            'total_locals' => $total_locals,
            'total_types_consumables' => $total_types_consumables,
            'total_consumable' => $total_consumable,
            'total_materials_Damaged' => $total_materials_Damaged,
            'total_materials_Broke' => $total_materials_Broke,
            'total_materials_non_affected' => $total_materials_non_affected,
            'stocks_by_deliveries' => $stocks_by_deliveries,
        ]);
    }

    public function material()
    {
        $total_models = $this->modelMaterialService->getTotalModels();
        $total_types = $this->typeMaterialService->getTotalTypes();
        $total_brands = $this->brandMaterialService->getTotalBrands();
        $total_marchs = $this->marchMaterialService->getTotalMarchs();

        $total_materials = $this->materialService->getTotalMaterials();
        $total_employees = $this->employeeService->getTotalEmployees();

        $total_materials_by_type = $this->materialService->getTotalMaterialsByType();

        $total_inventory = $this->inventoryService->getTotalInventories();

        $total_materials_non_affected = count($this->materialService->getMaterialsNotAffectedToUser());
        $total_materials_Damaged  = count($this->materialService->getAllDamagedMaterials());
        $total_materials_Broke  = count($this->materialService->getAllBrokeMaterials());

        $total_pc = 0;
        $total_laptops = 0;
        $total_printers = 0;
        $total_scanners = 0;
        $total_big_printers = 0;

        foreach ($total_materials_by_type as $item) {
            if ($item->title == "PC Fixe" || $item->title == "PC") {
                $total_pc = $item->nbr;
            } elseif ($item->title == "Imprimante") {
                $total_printers = $item->nbr;
            } elseif ($item->title == "PC Portable") {
                $total_laptops = $item->nbr;
            } elseif ($item->title == "Scanner") {
                $total_scanners = $item->nbr;
            } elseif ($item->title == "Photocopie") {
                $total_big_printers = $item->nbr;
            }
        }

        $models = $this->modelMaterialService->getAllMaterialModels(0);
        $types = $this->typeMaterialService->getAllMaterialTypes(0);
        $marchs = $this->marchMaterialService->getAllMaterialMarchs(0);
        $brands = $this->brandMaterialService->getAllMaterialBrands(0);

        return view('statistics.materials.index', [
            'total_materials' => $total_materials,
            'total_models' => $total_models,
            'total_types' => $total_types,
            'total_brands' => $total_brands,
            'total_marchs' => $total_marchs,
            'total_inventory' => $total_inventory,
            'models' => $models,
            'types' => $types,
            'brands' => $brands,
            'marchs' => $marchs,
            'total_employees' => $total_employees,
            'total_pc' => $total_pc,
            'total_printers' => $total_printers,
            'total_laptops' => $total_laptops,
            'total_scanners' => $total_scanners,
            'total_big_printers' => $total_big_printers,
            'total_materials_non_affected' => $total_materials_non_affected,
            'total_materials_Broke' => $total_materials_Broke,
            'total_materials_Damaged' => $total_materials_Damaged,
        ]);
    }

    public function employee()
    {
        $inventories_services = $this->inventoryService->getInventoriesGroupByService();
        $inventories_entities = $this->inventoryService->getInventoriesGroupByEntity();
        $inventories_sections = $this->inventoryService->getInventoriesGroupBySection();
        $inventories_secters = $this->inventoryService->getInventoriesGroupBySecter();


        return view('statistics.employees.static-employee', [
            'inventories_services' => $inventories_services,
            'inventories_entities' => $inventories_entities,
            'inventories_secters' => $inventories_secters,
            'inventories_sections' => $inventories_sections
        ]);
    }

    public function furniture(Request $request, int $year=2022)
    {
        $selectedYear = $year;
        $years  = $this->deliveryService->getDeliveryYears();
        $stocks_by_year = $this->stockService->getAllStockConsumablesGroupedByYear($year);
        $stocks_detail_by_year = $this->stockService->getAllStockConsumableDetailGroupedByYear($year);
        $stocks_detail_type_by_year = $this->stockService->getAllStockConsumableByTypeGroupedByYear($year);

        return view('statistics.furnitures.static-furniture', [
            'selectedYear' => $selectedYear,
            'years' => $years,
            'stocks_by_year' => $stocks_by_year,
            'stocks_detail_by_year' => $stocks_detail_by_year,
            'stocks_detail_type_by_year' => $stocks_detail_type_by_year
        ]);
    }


}
