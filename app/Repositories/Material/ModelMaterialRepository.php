<?php

namespace App\Repositories\Material;

use App\Models\ModelMaterial;
use function Laravel\Prompts\select;

class ModelMaterialRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                    ->get();

            return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->orderBy('id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    /***
     * @param $id
     * @return ModelMaterial
     */
    public function findOneById($id): ?ModelMaterial {
        return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj                    = new ModelMaterial();
        $obj->title             = $data['title'];
        $obj->image             = $data['image'];
        $obj->image_data        = $data['image_data'];
        $obj->brand_material_id = $data['brand_material_id'];
        $obj->type_material_id  = $data['type_material_id'];
        $obj->password          = $data['password'];
        return $obj->save();
    }

    /***
     * @param ModelMaterial $model
     * @param $data
     * @return bool
     */
    function update(ModelMaterial $model, $data): bool {
        $model->title               = $data['title'];
        $model->image               = $data['image'];
        $model->image_data          = $data['image_data'];
        $model->is_reform           = $data['is_reform'];
        $model->brand_material_id   = $data['brand_material_id'];
        $model->type_material_id    = $data['type_material_id'];
        $model->password            = $data['password'];
        return $model->save();
    }

    /***
     * @param ModelMaterial $model
     * @return bool|null
     */
    function delete(ModelMaterial $model) {
        return $model->delete();
    }

    function getAllModelsByType($type, $pages){
        try {

            if ($pages == 0)
                return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                    ->where('type_material_id', '=', $type)
                    ->get();

            return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->where('type_material_id', '=', $type)
                ->orderBy('id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    function getAllModelsByBrandAndType($type, $brand, $pages) {
        try {

            if ($pages == 0)
                return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                    ->where('type_material_id', '=', $type)
                    ->where('brand_material_id', '=', $brand)
                    ->get();

            return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->where('type_material_id', '=', $type)
                ->where('brand_material_id', '=', $brand)
                ->orderBy('id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    function getAllModelsByBrand($brand, $pages){
        try {

            if ($pages == 0)
                return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                    ->where('brand_material_id', '=', $brand)
                    ->get();

            return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->where('brand_material_id', '=', $brand)
                ->orderBy('id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    function getAllModelsByMarch($march, $pages){
        try {

            if ($pages == 0)
                return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                    ->join('delivery_materials', 'delivery_materials.model_material_id', '=', 'model_materials.id')
                    ->where('march_material_id', '=', $march)
                    ->get();

            return ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->join('delivery_materials', 'delivery_materials.model_material_id', '=', 'model_materials.id')
                ->where('march_material_id', '=', $march)
                ->orderBy('id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
        return null;
    }

    function getAllModelsByTypeTitle($title, $pages) {
        try {

            $query = ModelMaterial::with(['type_material', 'brand_material', 'deliveries_material'])
                ->join('type_materials', 'type_materials.id', '=', 'model_materials.type_material_id')
                ->where('type_materials.title', '=', $title)
                ->select('model_materials.*');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getTotalModels() {
        return ModelMaterial::count();
    }

}
