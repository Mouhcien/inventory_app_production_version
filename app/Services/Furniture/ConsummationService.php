<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Consummation;
use App\Repositories\Furniture\ConsummationRepository;

class ConsummationService {

    private ConsummationRepository $consummationRepository;

    /**
     * @param ConsummationRepository $consummationRepository
     */
    public function __construct(ConsummationRepository $consummationRepository)
    {
        $this->consummationRepository = $consummationRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllConsummations($pages){
        try {
            return $this->consummationRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllConsummationsByFilter($filter, $value, $pages){
        try {
            return $this->consummationRepository->allByFilter($filter, $value, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllEmployeesFromConsummations($pages){
        try {
            return $this->consummationRepository->allEmployeesFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllServicesFromConsummations($pages){
        try {
            return $this->consummationRepository->allServicesFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllEntitiesFromConsummations($pages){
        try {
            return $this->consummationRepository->allEntitiesFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllSectersFromConsummations($pages){
        try {
            return $this->consummationRepository->allSectersFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllSectionsFromConsummations($pages){
        try {
            return $this->consummationRepository->allSectionsFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllLocalsFromConsummations($pages){
        try {
            return $this->consummationRepository->allLocalsFromConsummations($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Consummation
     * @throws ObjectNotFoundException
     */
    public function getOneConsummationById($id): Consummation
    {
        $type = $this->consummationRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("La consommation introuvable!!");
        }
        return $type;
    }

    public function getConsummationsByDelivery($id, $pages)
    {
        return $this->consummationRepository->getConsummationsByDelivery($id, $pages);
    }

    public function getConsummationsByConsumable($consumable, $pages)
    {
        return $this->consummationRepository->getConsummationsByConsumable($consumable, $pages);
    }

    public function getConsummationsByStock($stock, $pages)
    {
        return $this->consummationRepository->getConsummationsByStock($stock, $pages);
    }

    public function getConsummationsByDeliveryAndConsumable($delivery, $consumable, $pages)
    {
        return $this->consummationRepository->getConsummationsByDeliveryAndConsumable($delivery, $consumable, $pages);
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewConsummation($data){
        try {
            return $this->consummationRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Consummation $consummation
     * @param $data
     * @return bool|void
     */
    public function updateConsummation(Consummation $consummation, $data){
        try {
            return $this->consummationRepository->update($consummation, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Consummation $consummation
     * @return bool|void|null
     */
    public function deleteConsummation(Consummation $consummation){
        try {
            return $this->consummationRepository->delete($consummation);
        }catch (Exception $exception){

        }
    }

}
