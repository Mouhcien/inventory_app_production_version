<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\ServiceEntity;
use App\Repositories\Employee\ServiceEntityRepository;

class ServiceEntityService {


    private ServiceEntityRepository $serviceEntityRepository;

    /**
     * @param ServiceEntityRepository $serviceEntityRepository
     */
    public function __construct(ServiceEntityRepository $serviceEntityRepository)
    {
        $this->serviceEntityRepository = $serviceEntityRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllServiceEntities($pages){
        try {
            return $this->serviceEntityRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return ServiceEntity
     * @throws ObjectNotFoundException
     */
    public function getOneServiceEntityById($id): ServiceEntity
    {
        $type = $this->serviceEntityRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le service introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewServiceEntity($data){
        try {
            return $this->serviceEntityRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param ServiceEntity $serviceEntity
     * @param $data
     * @return bool|void
     */
    public function updateServiceEntity(ServiceEntity $serviceEntity, $data){
        try {
            return $this->serviceEntityRepository->update($serviceEntity, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param ServiceEntity $serviceEntity
     * @return bool|void|null
     */
    public function deleteServiceEntity(ServiceEntity $serviceEntity){
        try {
            return $this->serviceEntityRepository->delete($serviceEntity);
        }catch (Exception $exception){

        }
    }

    public function getTotalServices() {
        return $this->serviceEntityRepository->getTotalServices();
    }
}
