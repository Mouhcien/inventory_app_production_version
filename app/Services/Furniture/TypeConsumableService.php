<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\TypeConsumable;
use App\Repositories\Furniture\TypeConsumableRepository;

class TypeConsumableService {

    private TypeConsumableRepository $typeConsumableRepository;

    /**
     * @param TypeConsumableRepository $typeConsumableRepository
     */
    public function __construct(TypeConsumableRepository $typeConsumableRepository)
    {
        $this->typeConsumableRepository = $typeConsumableRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllConsumableTypes($pages){
        try {
            return $this->typeConsumableRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return TypeConsumable
     * @throws ObjectNotFoundException
     */
    public function getOneConsumableById($id): TypeConsumable
    {
        $type = $this->typeConsumableRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le type du consommable introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewConsumableType($data){
        try {
            return $this->typeConsumableRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param TypeConsumable $typeConsumable
     * @param $data
     * @return bool|void
     */
    public function updateConsumableType(TypeConsumable $typeConsumable, $data){
        try {
            return $this->typeConsumableRepository->update($typeConsumable, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param TypeConsumable $typeConsumable
     * @return bool|void|null
     */
    public function deleteConsumableType(TypeConsumable $typeConsumable){
        try {
            return $this->typeConsumableRepository->delete($typeConsumable);
        }catch (Exception $exception){

        }
    }

    public function getTotalTypeConsumable(){
        try {
            return $this->typeConsumableRepository->getTotalTypeConsumable();
        }catch (Exception $exception){

        }
    }
}

