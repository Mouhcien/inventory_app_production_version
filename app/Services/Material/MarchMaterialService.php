<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\MarchMaterial;
use App\Repositories\Material\MarchMaterialRepository;

class MarchMaterialService {

    private MarchMaterialRepository $marchMaterialRepository;

    /**
     * @param MarchMaterialRepository $marchMaterialRepository
     */
    public function __construct(MarchMaterialRepository $marchMaterialRepository)
    {
        $this->marchMaterialRepository = $marchMaterialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterialMarchs($pages){
        try {
            return $this->marchMaterialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllMaterialMarchsByBrand($brand, $pages){
        try {
            return $this->marchMaterialRepository->allByBrand($brand, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllMaterialMarchsByBrandAndModel($brand, $model, $pages){
        try {
            return $this->marchMaterialRepository->allByBrandAndModel($brand, $model, $pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return MarchMaterial
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialMarchById($id): MarchMaterial
    {
        $march = $this->marchMaterialRepository->findOneById($id);
        if (is_null($march)){
            throw new ObjectNotFoundException("Le marché du matériel introuvable!!");
        }
        return $march;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterialMarch($data){
        try {
            return $this->marchMaterialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param MarchMaterial $marchMaterial
     * @param $data
     * @return bool|void
     */
    public function updateMaterialMarch(MarchMaterial $marchMaterial, $data){
        try {
            return $this->marchMaterialRepository->update($marchMaterial, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param MarchMaterial $marchMaterial
     * @return bool|void|null
     */
    public function deleteMaterialMarch(MarchMaterial $marchMaterial){
        try {
            return $this->marchMaterialRepository->delete($marchMaterial);
        }catch (Exception $exception){

        }
    }

    public function getAllMarchsByType($type, $pages) {
        try {
            return $this->marchMaterialRepository->getAllMarchsByType($type, $pages);
        }catch (Exception $exception){

        }
    }

    public function getAllMarchsByModel($model, $pages) {
        try {
            return $this->marchMaterialRepository->getAllMarchsByModel($model, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalMarchs() {
        try {
            return $this->marchMaterialRepository->getTotalMarchs();
        }catch (Exception $exception){

        }
    }


}
