<?php

namespace App\Repositories\Material;

use App\Models\Material;
use Illuminate\Support\Facades\DB;

class MaterialRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = Material::with(['delivery_material', 'observations_material'])
                ->where('is_reform', '=', false)
                ->orderBy('serial', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByDelivery($delivery, $pages) {
        try {
            $query = Material::with(['delivery_material', 'observations_material'])
                ->where('is_reform', '=', false)
                ->where('delivery_material_id', '=', $delivery)
                ->orderBy('serial', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    public function getDuplicateSerial() {
        try {
            return Material::select('serial', DB::raw('MAX(id) as material_id'))
                    ->groupBy('serial')
                    ->havingRaw('COUNT(*) > 1')
                    ->get();

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return Material
     */
    public function findOneById($id): ?Material {
        return Material::with(['delivery_material', 'observations_material'])->where('is_reform', '=', false)->find($id);
    }

    public function findOneBySerial($serial): ?Material {
        return Material::with(['delivery_material', 'observations_material'])->where('serial', '=', $serial)->first();
    }

    public function findOneByState($state) {
        return Material::with(['delivery_material', 'observations_material'])->where('state', '=', $state)->get();
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj                    = new Material();
        $obj->serial            = $data['serial'];
        $obj->delivery_material_id = $data['delivery_material_id'];
        $obj->ip                = $data['ip'];
        $obj->inventory_number  = $data['inventory_number'];
        return $obj->save();
    }

    /***
     * @param Material $material
     * @param $data
     * @return bool
     */
    function update(Material $material, $data) {
        if (isset($data['serial']))
            $material->serial = $data['serial'];
        if (isset($data['serial']))
            $material->delivery_material_id = $data['delivery_material_id'];
        if (isset($data['serial']))
            $material->ip = $data['ip'];
        if (isset($data['serial']))
            $material->is_reform = $data['is_reform'];
        if (isset($data['serial']))
            $material->state = $data['state'];
        if (isset($data['serial']))
            $material->inventory_number  = $data['inventory_number'];
        if (isset($data['serial']))
            $material->is_deployed = $data['is_deployed'];
        return $material->save();
    }

    /***
     * @param Material $material
     * @return bool|null
     */
    function delete(Material $material) {
        return $material->delete();
    }

    function filter(string $filter, string $value, int $pages) {
        $query = Material::with(['delivery_material', 'observations_material'])
            ->join('delivery_materials', 'materials.delivery_material_id', '=', 'delivery_materials.id')
            ->join('model_materials', 'delivery_materials.model_material_id', '=', 'model_materials.id');

        switch ($filter) {
            case 'type':
                $query->where('model_materials.type_material_id', $value);
                break;
            case 'brand':
                $query->where('model_materials.brand_material_id', $value);
                break;
            case 'model':
                $query->where('model_materials.id', $value);
                break;
            case 'march':
                $query->where('delivery_materials.march_material_id', $value);
                break;
            case 'delivery':
                $query->where('delivery_materials.id', $value);
                break;
            case 'serial':
                $query->where('materials.serial', 'LIKE',  '%'.$value.'%');
                break;
            case 'state':
                $query->where('materials.state', '=',  $value);
                break;
        }

        $query->where('materials.is_reform', '=', false);
        $query->select('materials.*');

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    function filterMaterialByTypeAndBrand($type, $brand, $pages) {
        try {

            if ($pages == 0)
                return Material::with(['delivery_material', 'observations_material'])
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('materials.is_reform', '=', false)
                    ->where('model_materials.type_material_id', '=', $type)
                    ->where('model_materials.brand_material_id', '=', $brand)
                    ->select('materials.*')
                    ->distinct()
                    ->get();

            return Material::with(['delivery_material', 'observations_material'])
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('materials.is_reform', '=', false)
                ->where('model_materials.type_material_id', '=', $type)
                ->where('model_materials.brand_material_id', '=', $brand)
                ->select('materials.*')
                ->distinct()
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    public function allByFilter($type, $brand, $model, $march, $pages) {
        try {

            if ($pages == 0)
                return Material::with(['delivery_material', 'observations_material'])
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('materials.is_reform', '=', false)
                    ->where('delivery_materials.model_material_id', '=', $model)
                    ->where('delivery_materials.march_material_id', '=', $march)
                    ->where('model_materials.type_material_id', '=', $type)
                    ->where('model_materials.brand_material_id', '=', $brand)
                    ->select('materials.*')
                    ->distinct()
                    ->get();

            return Material::with(['delivery_material', 'observations_material'])
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('materials.is_reform', '=', false)
                ->where('delivery_materials.model_material_id', '=', $model)
                ->where('delivery_materials.march_material_id', '=', $march)
                ->where('model_materials.type_material_id', '=', $type)
                ->where('model_materials.brand_material_id', '=', $brand)
                ->select('materials.*')
                ->distinct()
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function filterMaterialByTypeAndBrandAndModel($type, $brand, $model, $pages) {
        try {

            if ($pages == 0)
                return Material::with(['delivery_material', 'observations_material'])
                    ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('materials.is_reform', '=', false)
                    ->where('delivery_materials.model_material_id', '=', $model)
                    ->where('model_materials.type_material_id', '=', $type)
                    ->where('model_materials.brand_material_id', '=', $brand)
                    ->select('materials.*')
                    ->distinct()
                    ->get();

            return Material::with(['delivery_material', 'observations_material'])
                ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('materials.is_reform', '=', false)
                ->where('delivery_materials.model_material_id', '=', $model)
                ->where('model_materials.type_material_id', '=', $type)
                ->where('model_materials.brand_material_id', '=', $brand)
                ->select('materials.*')
                ->distinct()
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    // Get the total of the materials
    public function getTotalMaterials()
    {
        return Material::count();
    }


    public function getMaterialsNotAffectedToUser($pages)
    {
        $query = Material::with(['delivery_material', 'observations_material'])
            ->leftJoin('inventories', 'inventories.material_id', '=', 'materials.id')
            ->whereNull('inventories.material_id')
            ->select('materials.*');

        if ($pages != 0)
            return $query->paginate($pages);

        return $query->get();
    }

    public function getMaterialsNotAffectedToUserWithoutBigPrinters($pages)
    {
        $query = Material::with(['delivery_material', 'observations_material'])
            ->join('delivery_materials', 'delivery_materials.id', '=', 'materials.delivery_material_id')
            ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
            ->leftJoin('inventories', 'inventories.material_id', '=', 'materials.id')
            ->whereNull('inventories.material_id')
            ->where('model_materials.type_material_id', '<>', 5) //photocopie a un id = 5
            ->select('materials.*');

        if ($pages != 0)
            return $query->paginate($pages);

        return $query->get();
    }

    public function getTotalMaterialsByType()
    {
        return DB::table('materials')
                    ->join('delivery_materials', 'materials.delivery_material_id', '=', 'delivery_materials.id')
                    ->join('model_materials', 'delivery_materials.model_material_id', '=', 'model_materials.id')
                    ->join('type_materials', 'type_materials.id', '=', 'model_materials.type_material_id')
                    ->select(
                        DB::raw('COUNT(materials.id) as nbr'),
                                'type_materials.title'
                    )
                    ->groupBy('type_materials.title')
                    ->get();

    }
}
