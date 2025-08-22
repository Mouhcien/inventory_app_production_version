<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\TypeMaterial;
use App\Repositories\Material\TypeMaterialRepository;

class TypeMaterialService {

    private TypeMaterialRepository $typeMaterialRepository;

    /**
     * @param TypeMaterialRepository $typeMaterialRepository
     */
    public function __construct(TypeMaterialRepository $typeMaterialRepository)
    {
        $this->typeMaterialRepository = $typeMaterialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterialTypes($pages){
        try {
            return $this->typeMaterialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return TypeMaterial
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialById($id): TypeMaterial
    {
        $type = $this->typeMaterialRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le type du matériel introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterialType($data){
        try {
            return $this->typeMaterialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param TypeMaterial $typeMaterial
     * @param $data
     * @return bool|void
     */
    public function updateMaterialType(TypeMaterial $typeMaterial, $data){
        try {
            return $this->typeMaterialRepository->update($typeMaterial, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param TypeMaterial $typeMaterial
     * @return bool|void|null
     */
    public function deleteMaterialType(TypeMaterial $typeMaterial){
        try {
            return $this->typeMaterialRepository->delete($typeMaterial);
        }catch (Exception $exception){

        }
    }

    public function getTotalTypes() {
        try {
            return $this->typeMaterialRepository->getTotalTypes();
        }catch (Exception $exception){

        }
    }
}
