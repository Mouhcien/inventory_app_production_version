<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\ModelMaterial;
use App\Repositories\Material\ModelMaterialRepository;

class ModelMaterialService {

    private ModelMaterialRepository $modelMaterialRepository;

    /**
     * @param ModelMaterialRepository $modelMaterialRepository
     */
    public function __construct(ModelMaterialRepository $modelMaterialRepository)
    {
        $this->modelMaterialRepository = $modelMaterialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterialModels($pages){
        try {
            return $this->modelMaterialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return ModelMaterial
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialModelById($id): ModelMaterial
    {
        $model = $this->modelMaterialRepository->findOneById($id);
        if (is_null($model)){
            throw new ObjectNotFoundException("La marque du matériel introuvable!!");
        }
        return $model;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterialModel($data){
        try {
            return $this->modelMaterialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param ModelMaterial $modelMaterial
     * @param $data
     * @return bool|void
     */
    public function updateMaterialModel(ModelMaterial $modelMaterial, $data){
        try {
            return $this->modelMaterialRepository->update($modelMaterial, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param ModelMaterial $modelMaterial
     * @return bool|void|null
     */
    public function deleteMaterialModel(ModelMaterial $modelMaterial){
        try {
            return $this->modelMaterialRepository->delete($modelMaterial);
        }catch (Exception $exception){

        }
    }

    public function getAllModelsByType($type, $pages) {
        try {
            return $this->modelMaterialRepository->getAllModelsByType($type, $pages);
        }catch (Exception $exception){

        }
    }

    public function getAllModelsByBrandAndType($type, $brand, $pages) {
        try {
            return $this->modelMaterialRepository->getAllModelsByBrandAndType($type, $brand, $pages);
        }catch (Exception $exception){

        }
    }

    public function getAllModelsByBrand($brand, $pages) {
        try {
            return $this->modelMaterialRepository->getAllModelsByBrand($brand, $pages);
        }catch (Exception $exception){

        }
    }

    public function getAllModelsByMarch($march, $pages) {
        try {
            return $this->modelMaterialRepository->getAllModelsByMarch($march, $pages);
        }catch (Exception $exception){

        }
    }

    public function getAllModelsByTypeTitle($title, $pages) {
        try {
            return $this->modelMaterialRepository->getAllModelsByTypeTitle($title, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalModels() {
        try {
            return $this->modelMaterialRepository->getTotalModels();
        }catch (\Exception $exception) {

        }
    }
}
