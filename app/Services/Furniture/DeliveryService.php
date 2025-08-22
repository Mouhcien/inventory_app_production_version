<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Delivery;
use App\Repositories\Furniture\DeliveryRepository;

class DeliveryService {

    private DeliveryRepository $deliveryRepository;

    /**
     * @param DeliveryRepository $deliveryRepository
     */
    public function __construct(DeliveryRepository $deliveryRepository)
    {
        $this->deliveryRepository = $deliveryRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllDeliveries($pages){
        try {
            return $this->deliveryRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllDeliveriesByYear($year, $pages){
        try {
            return $this->deliveryRepository->allByYear($year, $pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Delivery
     * @throws ObjectNotFoundException
     */
    public function getOneDeliveryById($id): Delivery
    {
        $type = $this->deliveryRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("La livrasion introuvable!!");
        }
        return $type;
    }

    public function getDeliveryYears(){
        try {
            return $this->deliveryRepository->getDeliveryYears();
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewDelivery($data){
        try {
            return $this->deliveryRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Delivery $delivery
     * @param $data
     * @return bool|void
     */
    public function updateDelivery(Delivery $delivery, $data){
        try {
            return $this->deliveryRepository->update($delivery, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Delivery $delivery
     * @return bool|void|null
     */
    public function deleteDelivery(Delivery $delivery){
        try {
            return $this->deliveryRepository->delete($delivery);
        }catch (Exception $exception){

        }
    }
}
