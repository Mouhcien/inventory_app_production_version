<?php

namespace App\Repositories\Material;

use App\Models\MarchMaterial;

class MarchMaterialRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return MarchMaterial::with('deliveries_material')->get()->all();

            return MarchMaterial::with('deliveries_material')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByBrand($brand, $pages) {
        try {

            if ($pages == 0)
                return MarchMaterial::with('deliveries_material')
                    ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('model_materials.brand_material_id', '=', $brand)
                    ->select('march_materials.*')
                    ->get();

            return MarchMaterial::with('deliveries_material')
                ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('model_materials.brand_material_id', '=', $brand)
                ->select('march_materials.*')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByBrandAndModel($brand, $model, $pages) {
        try {

            if ($pages == 0)
                return MarchMaterial::with('deliveries_material')
                    ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('model_materials.id', '=', $model)
                    ->where('model_materials.brand_material_id', '=', $brand)
                    ->get();

            return MarchMaterial::with('deliveries_material')
                ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('model_materials.id', '=', $model)
                ->where('model_materials.brand_material_id', '=', $brand)
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }


    /***
     * @param $id
     * @return MarchMaterial
     */
    public function findOneById($id): ?MarchMaterial {
        return MarchMaterial::with('deliveries_material')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new MarchMaterial();
        $obj->title      = $data['title'];
        $obj->nbr_models = 0;
        return $obj->save();
    }

    /***
     * @param MarchMaterial $march
     * @param $data
     * @return bool
     */
    function update(MarchMaterial $march, $data): bool {
        $march->title       = $data['title'];
        $march->nbr_models  = $data['nbr_models'];
        $march->is_reform   = $data['is_reform'];
        return $march->save();
    }

    /***
     * @param MarchMaterial $march
     * @return bool|null
     */
    function delete(MarchMaterial $march) {
        return $march->delete();
    }

    function getAllMarchsByType($type, $pages) {
        try {

            if ($pages == 0)
                return MarchMaterial::with('deliveries_material')
                    ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                    ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                    ->where('model_materials.type_material_id', '=', $type)
                    ->select('march_materials.title')
                    ->distinct('march_materials.title')
                    ->get();

            return MarchMaterial::with('deliveries_material')
                ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                ->join('model_materials', 'model_materials.id', '=', 'delivery_materials.model_material_id')
                ->where('model_materials.type_material_id', '=', $type)
                ->select('march_materials.title')
                ->distinct('march_materials.title')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    function getAllMarchsByModel($model, $pages) {
        try {

            if ($pages == 0)
                return MarchMaterial::with('deliveries_material')
                    ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                    ->where('delivery_materials.model_material_id', '=', $model)
                    ->select('march_materials.*')
                    ->distinct()
                    ->get();

            return MarchMaterial::with('deliveries_material')
                ->join('delivery_materials', 'delivery_materials.march_material_id', '=', 'march_materials.id')
                ->where('delivery_materials.model_material_id', '=', $model)
                ->select('march_materials.*')
                ->distinct()
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    function getTotalMarchs() {
        return MarchMaterial::count();
    }
}
