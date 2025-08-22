<?php

namespace App\Repositories\Material;


use App\Models\BrandMaterial;

class BrandMaterialRepository
{

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return BrandMaterial::with('models_material')->get()->all();

            return BrandMaterial::with('models_material')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return BrandMaterial
     */
    public function findOneById($id): ?BrandMaterial {
        return BrandMaterial::with('models_material')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new BrandMaterial();
        $obj->title     = $data['title'];
        $obj->logo      = $data['logo'];
        $obj->logo_data = $data['logo_data'];
        return $obj->save();
    }

    /***
     * @param BrandMaterial $brand
     * @param $data
     * @return bool
     */
    function update(BrandMaterial $brand, $data): bool {
        $brand->title     = $data['title'];
        $brand->logo      = $data['logo'];
        $brand->logo_data = $data['logo_data'];
        return $brand->save();
    }

    /***
     * @param BrandMaterial $brand
     * @return bool|null
     */
    function delete(BrandMaterial $brand) {
        return $brand->delete();
    }

    function getAllBrandsByType($type, $pages) {
        try {

            if ($pages == 0)
                return BrandMaterial::with('models_material')
                    ->join('model_materials', 'model_materials.brand_material_id', '=', 'brand_materials.id')
                    ->where('model_materials.type_material_id', '=', $type)
                    ->select('brand_materials.*')
                    ->distinct('brand_materials.title')
                    ->get();

            return BrandMaterial::with('models_material')
                ->join('model_materials', 'model_materials.brand_material_id', '=', 'brand_materials.id')
                ->where('model_materials.type_material_id', '=', $type)
                ->select('brand_materials.*')
                ->distinct('brand_materials.title')
                ->orderBy('id', 'ASC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    function getTotalBrands() {
        return BrandMaterial::count();
    }

}
