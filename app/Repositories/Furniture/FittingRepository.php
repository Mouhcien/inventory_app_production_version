<?php

namespace App\Repositories\Furniture;

use App\Models\Fitting;

class FittingRepository{

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return Fitting::with(['model_material', 'consumable'])->get()->all();

            return Fitting::with(['model_material', 'consumable'])->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return Fitting
     */
    public function findOneById($id): ?Fitting {
        return Fitting::with(['model_material', 'consumable'])->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Fitting();
        $obj->model_material_id = $data['model_material_id'];
        $obj->consumable_id = $data['consumable_id'];
        return $obj->save();
    }

    /***
     * @param Fitting $fitting
     * @param $data
     * @return bool
     */
    function update(Fitting $fitting, $data): bool {
        $fitting->model_material_id = $data['model_material_id'];
        $fitting->consumable_id = $data['consumable_id'];
        return $fitting->save();
    }

    /***
     * @param Fitting $fitting
     * @return bool|null
     */
    function delete(Fitting $fitting) {
        return $fitting->delete();
    }
}

