<?php

namespace App\Repositories;

use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class InventoryRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return Inventory::with(['material', 'employee'])
                    ->where('is_active', '=', true)
                    ->get();

            return Inventory::with(['material', 'employee'])
                ->where('is_active', '=', true)
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return Inventory
     */
    public function findOneById($id): ?Inventory {
        return Inventory::with(['material', 'employee'])
            ->where('is_active', '=', true)
            ->find($id);
    }

    public function findOneBySerial($serial): ?Inventory {
        return Inventory::with(['material', 'employee'])
            ->join('materials', 'materials.id', '=', 'inventories.material_id')
            ->where('is_active', '=', true)
            ->where('materials.serial', '=', $serial)
            ->select('inventories.*')
            ->get();
    }

    public function findAllByEmployee($employee_id) {
        return Inventory::with(['material', 'employee'])
            ->where('inventories.employee_id', '=', $employee_id)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Inventory();
        $obj->material_id     = $data['material_id'];
        $obj->employee_id      = $data['employee_id'];
        return $obj->save();
    }

    /***
     * @param Inventory $inventory
     * @param $data
     * @return bool
     */
    function update(Inventory $inventory, $data): bool {
        $inventory->material_id     = $data['material_id'];
        $inventory->employee_id      = $data['employee_id'];
        $inventory->is_active      = $data['is_active'];
        return $inventory->save();
    }

    /***
     * @param Inventory $inventory
     * @return bool|null
     */
    function delete(Inventory $inventory) {
        return $inventory->delete();
    }

    public function allByTypeMaterial($type, $pages) {
        try {

            if ($pages == 0)
                return Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('model_materials.type_material_id', $type)
                    ->where('is_active', true)
                    ->select('inventories.*')
                    ->get();

            return Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('model_materials.type_material_id', $type)
                ->where('is_active', true)
                ->select('inventories.*')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByBrandMaterial($brand, $pages) {
        try {

            if ($pages == 0)
                return Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('model_materials.brand_material_id', $brand)
                    ->where('is_active', true)
                    ->select('inventories.*')
                    ->get();

            return Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('model_materials.brand_material_id', $brand)
                ->where('is_active', true)
                ->select('inventories.*')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByModelMaterial($model, $pages) {
        try {

            if ($pages == 0)
                return Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->where('delivery_materials.model_material_id', '=', $model)
                    ->where('is_active', '=', true)
                    ->select('inventories.*')
                    ->get();

            return Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->where('delivery_materials.model_material_id', '=', $model)
                ->where('is_active', '=', true)
                ->select('inventories.*')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByModelMarch($march, $pages) {
        try {

            if ($pages == 0)
                return Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->where('delivery_materials.march_material_id', $march)
                    ->where('is_active', true)
                    ->select('inventories.*')
                    ->get();

            return Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->where('delivery_materials.march_material_id', $march)
                ->where('is_active', true)
                ->select('inventories.*')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByFilter($filter, $pages) {
        try {

            $req = Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('employees', 'employees.id', '=', 'inventories.employee_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->join('march_materials', 'march_materials.id', '=', 'delivery_materials.march_material_id')
                ->join('type_materials', 'type_materials.id', '=', 'model_materials.type_material_id')
                ->join('brand_materials', 'brand_materials.id', '=', 'model_materials.brand_material_id')
                ->join('locals', 'locals.id', '=', 'employees.local_id')
                ->join('service_entities', 'service_entities.id', '=', 'employees.service_entity_id')
                ->join('entities', 'entities.id', '=', 'employees.entity_id')
                ->join('secter_entities', 'secter_entities.id', '=', 'employees.secter_entity_id')
                ->where(function($query) use ($filter) {
                    $query->Where('model_materials.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('march_materials.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('type_materials.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('brand_materials.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('materials.serial', 'LIKE', '%'.$filter.'%')
                        ->orWhere('employees.firstname', 'LIKE', '%'.$filter.'%')
                        ->orWhere('employees.lastname', 'LIKE', '%'.$filter.'%')
                        ->orWhere('locals.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('service_entities.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('entities.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('secter_entities.title', 'LIKE', '%'.$filter.'%');
                })
                ->Where('inventories.is_active', '=', 1)
                ->select('inventories.*')
                ->orderBy('inventories.id', 'ASC');

            if ($pages == 0)
                return $req->get();

            return $req->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    function allByAdvanceFilter($dataFilter, $pages) {
        try {
            $req = Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->join('employees', 'employees.id', '=', 'inventories.employee_id')
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id');

            foreach ($dataFilter as $data) {
                $value = $data['value'];
                $filter = $data['filter'];
                if ($filter == 'type') {
                    $req->where('model_materials.type_material_id', '=', $value);
                }elseif ($filter == 'brand') {
                    $req->where('model_materials.brand_material_id', '=', $value);
                }elseif ($filter == 'march') {
                    $req->where('delivery_materials.march_material_id', '=', $value);
                }elseif ($filter == 'model') {
                    $req->where('delivery_materials.model_material_id', '=', $value);
                }elseif ($filter == 'service') {
                    $req->where('employees.service_entity_id', '=', $value);
                }elseif ($filter == 'entity') {
                    $req->where('employees.entity_id', '=', $value);
                }elseif ($filter == 'secter') {
                    $req->where('employees.secter_entity_id', '=', $value);
                }elseif ($filter == 'section') {
                    $req->where('employees.section_entity_id', '=', $value);
                }elseif ($filter == 'local') {
                    $req->where('employees.local_id', '=', $value);
                }elseif ($filter == 'city') {
                    $req->join('locals', 'locals.id', '=', 'employees.local_id');
                    $req->join('cities', 'cities.id', '=', 'locals.city_id');
                    $req->where('cities.id', '=', $value);
                }elseif ($filter == 'serial') {
                    $req->where('materials.serial', 'LIKE', '%'.$value.'%');
                }elseif ($filter == 'state') {
                    $req->where('materials.state', '=', $value);
                }elseif ($filter == 'fltrEmp'){
                    $req->where(function($query) use ($value) {
                        $query->orWhere('employees.ppr', 'LIKE', '%'.$value.'%')
                            ->orWhere('employees.firstname', 'LIKE', '%'.$value.'%')
                            ->orWhere('employees.lastname', 'LIKE', '%'.$value.'%');
                    });
                }
            }

            if ($pages == 0){
                return $req
                    ->where('inventories.is_active', '=', 1)
                    ->select('inventories.*')
                    ->orderBy('inventories.id', 'ASC')
                    ->get();
            }

            return $req
                ->where('inventories.is_active', '=', 1)
                ->select('inventories.*')
                ->orderBy('inventories.id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    function getTotalInventories() {
        return Inventory::query()->where('inventories.is_active', '=', 1)->count();
    }

    function getInventoriesGroupByService(){
        $inventories =  DB::table('inventories')
            ->join('employees', 'employees.id', '=', 'inventories.employee_id')
            ->join('service_entities', 'service_entities.id', '=', 'employees.service_entity_id')
            ->where('inventories.is_active', '=', 1)
            ->select(
                DB::raw('COUNT(inventories.id) as nbr'),
                'employees.service_entity_id',
                'service_entities.title',
                'inventories.is_active'
            )
            ->groupBy('employees.service_entity_id', 'service_entities.title', 'inventories.is_active')
            ->orderBy('nbr', 'DESC')
            ->get();

        $employees =  DB::table('employees')
            ->join('service_entities', 'service_entities.id', '=', 'employees.service_entity_id')
            ->select(
                DB::raw('COUNT(employees.id) as nbr'),
                'employees.service_entity_id',
                'service_entities.title'
            )
            ->groupBy('employees.service_entity_id', 'service_entities.title')
            ->orderBy('nbr', 'DESC')
            ->get();

        $combinedResults = [];

        foreach ($inventories as $inventory) {
            // Find matching employee data for each inventory result
            $employeeData = $employees->firstWhere('service_entity_id', $inventory->service_entity_id);

            // If a match exists, combine the data
            if ($employeeData) {
                $combinedResults[] = [
                    'title' => $inventory->title,
                    'employees_nbr' => $employeeData->nbr,
                    'inventories_nbr' => $inventory->nbr,
                ];
            }
        }

        return $combinedResults;
    }

    function getInventoriesGroupByEntity(){
        $inventories =  DB::table('inventories')
            ->join('employees', 'employees.id', '=', 'inventories.employee_id')
            ->join('entities', 'entities.id', '=', 'employees.entity_id')
            ->where('inventories.is_active', '=', 1)
            ->select(
                DB::raw('COUNT(inventories.id) as nbr'),
                'employees.entity_id',
                'entities.title',
                'inventories.is_active'
            )
            ->groupBy('employees.entity_id', 'entities.title', 'inventories.is_active')
            ->orderBy('nbr', 'DESC')
            ->get();

        $employees =  DB::table('employees')
            ->join('entities', 'entities.id', '=', 'employees.entity_id')
            ->select(
                DB::raw('COUNT(employees.id) as nbr'),
                'employees.entity_id',
                'entities.title'
            )
            ->groupBy('employees.entity_id', 'entities.title')
            ->orderBy('nbr', 'DESC')
            ->get();

        $combinedResults = [];

        foreach ($inventories as $inventory) {
            // Find matching employee data for each inventory result
            $employeeData = $employees->firstWhere('entity_id', $inventory->entity_id);

            // If a match exists, combine the data
            if ($employeeData) {
                $combinedResults[] = [
                    'title' => $inventory->title,
                    'employees_nbr' => $employeeData->nbr,
                    'inventories_nbr' => $inventory->nbr,
                ];
            }
        }

        return $combinedResults;
    }

    function getInventoriesGroupBySecter(){
        $inventories = DB::table('inventories')
            ->join('employees', 'employees.id', '=', 'inventories.employee_id')
            ->join('secter_entities', 'secter_entities.id', '=', 'employees.secter_entity_id')
            ->where('inventories.is_active', '=', 1)
            ->select(
                DB::raw('COUNT(inventories.id) as nbr'),
                'employees.secter_entity_id',
                'secter_entities.title',
                'inventories.is_active'
            )
            ->groupBy('employees.secter_entity_id', 'secter_entities.title', 'inventories.is_active')
            ->orderBy('nbr', 'DESC')
            ->get();

        $employees =  DB::table('employees')
            ->join('secter_entities', 'secter_entities.id', '=', 'employees.secter_entity_id')
            ->select(
                DB::raw('COUNT(employees.id) as nbr'),
                'employees.secter_entity_id',
                'secter_entities.title'
            )
            ->groupBy('employees.secter_entity_id', 'secter_entities.title')
            ->orderBy('nbr', 'DESC')
            ->get();

        $combinedResults = [];

        foreach ($inventories as $inventory) {
            // Find matching employee data for each inventory result
            $employeeData = $employees->firstWhere('secter_entity_id', $inventory->secter_entity_id);

            // If a match exists, combine the data
            if ($employeeData) {
                $combinedResults[] = [
                    'title' => $inventory->title,
                    'employees_nbr' => $employeeData->nbr,
                    'inventories_nbr' => $inventory->nbr,
                ];
            }
        }

        return $combinedResults;
    }

    function getInventoriesGroupBySection(){
        $inventories = DB::table('inventories')
            ->join('employees', 'employees.id', '=', 'inventories.employee_id')
            ->join('section_entities', 'section_entities.id', '=', 'employees.section_entity_id')
            ->where('inventories.is_active', '=', 1)
            ->select(
                DB::raw('COUNT(inventories.id) as nbr'),
                'employees.section_entity_id',
                'section_entities.title',
                'inventories.is_active'
            )
            ->groupBy('employees.section_entity_id', 'section_entities.title', 'inventories.is_active')
            ->orderBy('nbr', 'DESC')
            ->get();

        $employees =  DB::table('employees')
            ->join('section_entities', 'section_entities.id', '=', 'employees.section_entity_id')
            ->select(
                DB::raw('COUNT(employees.id) as nbr'),
                'employees.section_entity_id',
                'section_entities.title'
            )
            ->groupBy('employees.section_entity_id', 'section_entities.title')
            ->orderBy('nbr', 'DESC')
            ->get();

        $combinedResults = [];

        foreach ($inventories as $inventory) {
            // Find matching employee data for each inventory result
            $employeeData = $employees->firstWhere('section_entity_id', $inventory->section_entity_id);

            // If a match exists, combine the data
            if ($employeeData) {
                $combinedResults[] = [
                    'title' => $inventory->title,
                    'employees_nbr' => $employeeData->nbr,
                    'inventories_nbr' => $inventory->nbr,
                ];
            }
        }

        return $combinedResults;
    }

    function getInventoryHistoryByMaterial($material, $pages) {
        $req = Inventory::with(['material', 'employee'])
                ->where('inventories.material_id', '=', $material)
                ->orderBy('created_at', 'DESC');

        if ($pages == 0)
            return $req->get();

        return $req->paginate($pages);
    }

    function getAllDuplicateSerialInInventory() {

        return Inventory::with(['material', 'employee'])
                    ->join('materials', 'materials.id', '=', 'inventories.material_id')
                    ->select('inventories.material_id', 'materials.serial')
                    ->where('inventories.is_active', '=', true)
                    ->groupBy('inventories.material_id', 'materials.serial')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();

    }

    function materialsForEachEmployees($nbr) {

        return Inventory::with(['material', 'employee'])
            ->select(
                'inventories.employee_id as employee_id',
                'employees.lastname as lastname',
                'employees.firstname as firstname',
                DB::raw('COUNT(inventories.material_id) as material_count'))
            ->join('employees', 'employees.id', '=', 'inventories.employee_id')
            ->groupBy('inventories.employee_id', 'employees.lastname', 'employees.firstname')
            ->havingRaw('COUNT(inventories.material_id) > '.$nbr)
            ->get();

    }

    function employeesWithMoreThanOneMaterialForEachType() {

        return Inventory::with(['material', 'employee'])
                ->join('materials', 'materials.id', '=', 'inventories.material_id')
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->join('type_materials', 'type_materials.id', '=', 'model_materials.type_material_id')
                ->join('employees', 'employees.id', '=', 'inventories.employee_id')
                ->select(
                    'inventories.employee_id as employee_id',
                    'employees.lastname as lastname',
                    'employees.firstname as firstname',
                    'model_materials.type_material_id as type_id',
                    'type_materials.title as type_title',
                    DB::raw('COUNT(inventories.material_id) as material_count'))
                ->where('inventories.is_active', '=', 1)
                ->groupBy('model_materials.type_material_id', 'inventories.employee_id', 'employees.lastname', 'employees.firstname', 'type_materials.title')
                ->havingRaw('COUNT(inventories.material_id) > 1')
                ->get();
    }

}
