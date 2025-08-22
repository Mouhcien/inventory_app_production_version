<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use App\Services\InventoryService;
use App\Services\Material\MaterialService;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    private MaterialService $materialService;
    private EmployeeService $employeeService;
    private InventoryService  $inventoryService;

    /**
     * @param MaterialService $materialService
     */
    public function __construct(MaterialService $materialService,
                                EmployeeService $employeeService,
                                InventoryService  $inventoryService)
    {
        $this->materialService = $materialService;
        $this->employeeService = $employeeService;
        $this->inventoryService = $inventoryService;
    }


    public function index() {

        Log::channel('custom')->info("[ ".url()->current()." ]");

        $total_materials = $this->materialService->getTotalMaterials();
        $total_employees = $this->employeeService->getTotalEmployees();

        $total_materials_by_type = $this->materialService->getTotalMaterialsByType();

        $total_inventory = $this->inventoryService->getTotalInventories();

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

        return view('welcome', [
            'total_employees' => $total_employees,
            'total_materials' => $total_materials,
            'total_pc' => $total_pc,
            'total_printers' => $total_printers,
            'total_laptops' => $total_laptops,
            'total_inventory' => $total_inventory,
            'total_scanners' => $total_scanners,
            'total_big_printers' => $total_big_printers
        ]);
    }
}
