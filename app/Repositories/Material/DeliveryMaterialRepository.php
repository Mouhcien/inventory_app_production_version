<?php

namespace App\Repositories\Material;

use App\Models\DeliveryMaterial;

class DeliveryMaterialRepository {

    public function affect(int $model_id, int $march_id): bool
    {
        $obj = new DeliveryMaterial();
        $obj->model_material_id     = $model_id;
        $obj->march_material_id     = $march_id;
        return $obj->save();
    }

    public function delete(DeliveryMaterial $deliveryMaterial){
        return $deliveryMaterial->delete();
    }

    public function getOneDeliveryMaterial(int $id) {
        return DeliveryMaterial::with(['model_material', 'march_material'])->find($id);
    }

    public function all() {
        return DeliveryMaterial::with(['model_material', 'march_material'])->orderBy('model_material_id', 'ASC')->get();
    }

}
