<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\SecterEntity;
use App\Repositories\Employee\SecterEntityRepository;

class SecterEntityService {

    private SecterEntityRepository $secterEntityRepository;

    /**
     * @param SecterEntityRepository $secterEntityRepository
     */
    public function __construct(SecterEntityRepository $secterEntityRepository)
    {
        $this->secterEntityRepository = $secterEntityRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllSecterEntities($pages){
        try {
            return $this->secterEntityRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return SecterEntity
     * @throws ObjectNotFoundException
     */
    public function getOneSecterEntityById($id): SecterEntity
    {
        $type = $this->secterEntityRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le secteur introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewSecterEntity($data){
        try {
            return $this->secterEntityRepository->create($data);
        }catch (Exception $exception) {
            return  $exception->getMessage();
        }
    }

    /***
     * @param SecterEntity $secterEntity
     * @param $data
     * @return bool|void
     */
    public function updateSecterEntity(SecterEntity $secterEntity, $data){
        try {
            return $this->secterEntityRepository->update($secterEntity, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param SecterEntity $secterEntity
     * @return bool|void|null
     */
    public function deleteSecterEntity(SecterEntity $secterEntity){
        try {
            return $this->secterEntityRepository->delete($secterEntity);
        }catch (Exception $exception){

        }
    }

    public function getSectersByEntity($id, $pages) {
        try {
            return $this->secterEntityRepository->getSectersByEntity($id, $pages);
        }catch (Exception $exception){

        }
    }

    public function getSectersByService($id, $pages) {
        try {
            return $this->secterEntityRepository->getSectersByService($id, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalSecter() {
        try {
            return $this->secterEntityRepository->getTotalSecter();
        }catch (Exception $exception){

        }
    }

}
