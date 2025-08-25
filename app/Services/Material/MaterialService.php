<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Material;
use App\Repositories\Material\MaterialRepository;

class MaterialService {


    private MaterialRepository $materialRepository;

    /**
     * @param MaterialRepository $materialRepository
     */
    public function __construct(MaterialRepository $materialRepository)
    {
        $this->materialRepository = $materialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterials($pages){
        try {
            return $this->materialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllMaterialsByDelivery($delivery, $pages){
        try {
            return $this->materialRepository->allByDelivery($delivery, $pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Material
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialById($id): Material
    {
        $brand = $this->materialRepository->findOneById($id);
        if (is_null($brand)){
            throw new ObjectNotFoundException("La marque du matériel introuvable!!");
        }
        return $brand;
    }

    public function getOneMaterialBySerial($serial)
    {
        $brand = $this->materialRepository->findOneBySerial($serial);
        return $brand;
    }

    public function getDuplicateSerial()
    {
        $brand = $this->materialRepository->getDuplicateSerial();
        return $brand;
    }

    public function getAllDamagedMaterials()
    {
        $brand = $this->materialRepository->findOneByState(-2);
        return $brand;
    }

    public function getAllBrokeMaterials()
    {
        $brand = $this->materialRepository->findOneByState(-1);
        return $brand;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterial($data){
        try {
            return $this->materialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Material $material
     * @param $data
     * @return bool|void
     */
    public function updateMaterial(Material $material, $data){
        try {
            return $this->materialRepository->update($material, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Material $material
     * @return bool|void|null
     */
    public function deleteMaterial(Material $material){
        try {
            return $this->materialRepository->delete($material);
        }catch (Exception $exception){

        }
    }

    public function filterMaterial($filter, $value, $pages) {
        try {
            return $this->materialRepository->filter($filter, $value, $pages);
        }catch (\Exception $exception) {

        }
    }

    public function filterMaterialByTypeAndBrand($type, $brand, $pages) {
        try {
            return $this->materialRepository->filterMaterialByTypeAndBrand($type, $brand, $pages);
        }catch (\Exception $exception) {

        }
    }

    public function filterMaterialByTypeAndBrandAndModel($type, $brand, $model, $pages) {
        try {
            return $this->materialRepository->filterMaterialByTypeAndBrandAndModel($type, $brand, $model, $pages);
        }catch (\Exception $exception) {

        }
    }


    public function getAllMaterialsByFilter($type, $brand, $model, $march, $pages) {
        try {
            return $this->materialRepository->allByFilter($type, $brand, $model, $march, $pages);
        }catch (\Exception $exception) {

        }
    }

    public function getTotalMaterials() {
        try {
            return $this->materialRepository->getTotalMaterials();
        }catch (\Exception $exception) {

        }
    }

    public function getMaterialsNotAffectedToUser($pages=0) {
        try {
            return $this->materialRepository->getMaterialsNotAffectedToUser($pages);
        }catch (\Exception $exception) {

        }
    }

    public function getPhotocopiesNotAffectedToUser($pages=0) {
        try {
            return $this->materialRepository->getPhotocopiesNotAffectedToUser($pages);
        }catch (\Exception $exception) {

        }
    }

    public function getMaterialsNotAffectedToUserWithoutBigPrinters($pages=0) {
        try {
            return $this->materialRepository->getMaterialsNotAffectedToUserWithoutBigPrinters($pages);
        }catch (\Exception $exception) {

        }
    }

    public function getTotalMaterialsByType() {
        return $this->materialRepository->getTotalMaterialsByType();
    }
}
