<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Entity;
use App\Repositories\Employee\EntityRepository;

class EntityService {

    private EntityRepository $entityRepository;

    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllEntities($pages){
        try {
            return $this->entityRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllByType($type, $pages){
        try {
            return $this->entityRepository->allByType($type, $pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Entity
     * @throws ObjectNotFoundException
     */
    public function getOneEntityById($id): Entity
    {
        $type = $this->entityRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Entité introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewEntity($data){
        try {
            return $this->entityRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Entity $entity
     * @param $data
     * @return bool|void
     */
    public function updateEntity(Entity $entity, $data){
        try {
            return $this->entityRepository->update($entity, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Entity $entity
     * @return bool|void|null
     */
    public function deleteEntity(Entity $entity){
        try {
            return $this->entityRepository->delete($entity);
        }catch (Exception $exception){

        }
    }

    public function getAllEntitiesByService($service_entity_id, $pages) {
        try {
            return $this->entityRepository->getAllEntitiesByService($service_entity_id, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalEntities() {
        try {
            return $this->entityRepository->getTotalEntities();
        }catch (Exception $exception){

        }
    }
}
