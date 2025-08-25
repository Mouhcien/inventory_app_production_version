<?php

namespace App\Repositories;

use App\Models\InventoryPhotocopy;

class InventoryPhotocopyRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = InventoryPhotocopy::with(['material', 'service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                ->where('is_active', '=', true)
                ->orderBy('id', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return InventoryPhotocopy
     */
    public function findOneById($id) {
        return InventoryPhotocopy::with(['material', 'service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
            ->where('is_active', '=', true)
            ->find($id);
    }

    public function findOneBySerial($serial) {
        return InventoryPhotocopy::with(['material', 'service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
            ->join('materials', 'materials.id', '=', 'inventory_photocopies.material_id')
            ->where('is_active', '=', true)
            ->where('materials.serial', '=', $serial)
            ->select('inventory_photocopies.*')
            ->get();
    }


    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new InventoryPhotocopy();
        $obj->material_id     = $data['material_id'];
        if (isset($data['service_entity_id']))
            $obj->service_entity_id = $data['service_entity_id'];
        if (isset($data['entity_id']))
            $obj->entity_id = $data['entity_id'];
        if (isset($data['secter_entity_id']))
            $obj->secter_entity_id = $data['secter_entity_id'];
        if (isset($data['section_entity_id']))
            $obj->section_entity_id = $data['section_entity_id'];
        if (isset($data['local_id']))
            $obj->local_id = $data['local_id'];
        return $obj->save();
    }

    /***
     * @param InventoryPhotocopy $inventory
     * @param $data
     * @return bool
     */
    function update(InventoryPhotocopy $inventory, $data): bool {
        if (isset($data['material_id']))
            $inventory->material_id     = $data['material_id'];
        if (isset($data['employee_id']))
            $inventory->employee_id      = $data['employee_id'];
        if (isset($data['is_active']))
            $inventory->is_active      = $data['is_active'];
        if (isset($data['service_entity_id']))
            $inventory->service_entity_id = $data['service_entity_id'];
        if (isset($data['entity_id']))
            $inventory->entity_id = $data['entity_id'];
        if (isset($data['secter_entity_id']))
            $inventory->secter_entity_id = $data['secter_entity_id'];
        if (isset($data['section_entity_id']))
            $inventory->section_entity_id = $data['section_entity_id'];
        if (isset($data['local_id']))
            $inventory->local_id = $data['local_id'];

        return $inventory->save();
    }

    /***
     * @param InventoryPhotocopy $inventory
     * @return bool|null
     */
    function delete(InventoryPhotocopy $inventory) {
        return $inventory->delete();
    }

    public function allByFilter($filter, $pages) {
        try {

            $req = InventoryPhotocopy::with(['material', 'service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                ->join('materials', 'materials.id', '=', 'inventory_photocopies.material_id')
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
                        ->orWhere('locals.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('service_entities.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('entities.title', 'LIKE', '%'.$filter.'%')
                        ->orWhere('secter_entities.title', 'LIKE', '%'.$filter.'%');
                })
                ->Where('inventory_photocopies.is_active', '=', 1)
                ->select('inventory_photocopies.*')
                ->orderBy('inventory_photocopies.id', 'DESC');

            if ($pages == 0)
                return $req->get();

            return $req->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
