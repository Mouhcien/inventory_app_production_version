<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Consumable;
use App\Repositories\Furniture\ConsumableRepository;

class ConsumableService {

    private ConsumableRepository $consumableRepository;

    /**
     * @param ConsumableRepository $consumableRepository
     */
    public function __construct(ConsumableRepository $consumableRepository)
    {
        $this->consumableRepository = $consumableRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllConsumables($pages){
        try {
            return $this->consumableRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllConsumablesByType($type, $pages){
        try {
            return $this->consumableRepository->allByType($type, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllConsumablesByTypeStillInStock($type, $pages){
        try {
            return $this->consumableRepository->allByTypeStillInStock($type, $pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Consumable
     * @throws ObjectNotFoundException
     */
    public function getOneConsumableById($id): Consumable
    {
        $type = $this->consumableRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le consommable introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewConsumable($data){
        try {
            return $this->consumableRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Consumable $consumable
     * @param $data
     * @return bool|void
     */
    public function updateConsumable(Consumable $consumable, $data){
        try {
            return $this->consumableRepository->update($consumable, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Consumable $consumable
     * @return bool|void|null
     */
    public function deleteConsumable(Consumable $consumable){
        try {
            return $this->consumableRepository->delete($consumable);
        }catch (Exception $exception){

        }
    }

    public function getTotalConsumable(){
        try {
            return $this->consumableRepository->getTotalConsumable();
        }catch (Exception $exception){

        }
    }

}
