<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\TypeEntity;
use App\Repositories\Employee\TypeEntityRepository;


class TypeEntityService {

    private TypeEntityRepository $typeEntityRepository;

    /**
     * @param TypeEntityRepository $typeEntityRepository
     */
    public function __construct(TypeEntityRepository $typeEntityRepository)
    {
        $this->typeEntityRepository = $typeEntityRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllTypeEntities($pages){
        try {
            return $this->typeEntityRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return TypeEntity
     * @throws ObjectNotFoundException
     */
    public function getOneTypeEntityById($id): TypeEntity
    {
        $type = $this->typeEntityRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le type introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewTypeEntity($data){
        try {
            return $this->typeEntityRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param TypeEntity $typeEntity
     * @param $data
     * @return bool|void
     */
    public function updateTypeEntity(TypeEntity $typeEntity, $data){
        try {
            return $this->typeEntityRepository->update($typeEntity, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param TypeEntity $typeEntity
     * @return bool|void|null
     */
    public function deleteTypeEntity(TypeEntity $typeEntity){
        try {
            return $this->typeEntityRepository->delete($typeEntity);
        }catch (Exception $exception){

        }
    }

}
