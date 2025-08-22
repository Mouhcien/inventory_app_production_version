<?php

namespace App\Repositories\Material;

use App\Models\ObservationMaterial;

class ObservationMaterialRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return ObservationMaterial::with('material')->get()->all();

            return ObservationMaterial::with('material')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return ObservationMaterial
     */
    public function findOneById($id): ?ObservationMaterial {
        return ObservationMaterial::with('material')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new ObservationMaterial();
        $obj->material_id   = $data['material_id'];
        $obj->title         = $data['title'];
        $obj->object        = $data['object'];
        return $obj->save();
    }

    /***
     * @param ObservationMaterial $brand
     * @param $data
     * @return bool
     */
    function update(ObservationMaterial $brand, $data): bool {
        $brand->title           = $data['title'];
        $brand->material_id     = $data['material_id'];
        $brand->object          = $data['object'];
        return $brand->save();
    }

    /***
     * @param ObservationMaterial $brand
     * @return bool|null
     */
    function delete(ObservationMaterial $brand) {
        return $brand->delete();
    }
}
