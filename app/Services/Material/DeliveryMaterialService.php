<?php

namespace App\Services\Material;

use App\Models\DeliveryMaterial;
use App\Repositories\Material\DeliveryMaterialRepository;

class DeliveryMaterialService {

    private DeliveryMaterialRepository $deliveryMaterialRepository;

    /**
     * @param DeliveryMaterialRepository $deliveryMaterialRepository
     */
    public function __construct(DeliveryMaterialRepository $deliveryMaterialRepository)
    {
        $this->deliveryMaterialRepository = $deliveryMaterialRepository;
    }

    public function affect($model_id, $march_id){
        try {
            return $this->deliveryMaterialRepository->affect($model_id, $march_id);
        }catch (\Exception $exception) {

        }
    }

    public function delete(DeliveryMaterial $deliveryMaterial){
        try {
            return $this->deliveryMaterialRepository->delete($deliveryMaterial);
        }catch (\Exception $exception) {

        }
    }

    public function getOneDeliveryById(int $id) {
        try {
            return $this->deliveryMaterialRepository->getOneDeliveryMaterial($id);
        }catch (\Exception $exception) {

        }
    }

    public function getAllDeliveries() {
        try {
            return $this->deliveryMaterialRepository->all();
        }catch (\Exception $exception) {

        }
    }


}
