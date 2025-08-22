<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\BrandMaterial;
use App\Repositories\Material\BrandMaterialRepository;

class BrandMaterialService {

    private BrandMaterialRepository $brandMaterialRepository;

    /**
     * @param BrandMaterialRepository $brandMaterialRepository
     */
    public function __construct(BrandMaterialRepository $brandMaterialRepository)
    {
        $this->brandMaterialRepository = $brandMaterialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterialBrands($pages){
        try {
            return $this->brandMaterialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return BrandMaterial
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialBrandById($id): BrandMaterial
    {
        $brand = $this->brandMaterialRepository->findOneById($id);
        if (is_null($brand)){
            throw new ObjectNotFoundException("La marque du matériel introuvable!!");
        }
        return $brand;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterialBrand($data){
        try {
            return $this->brandMaterialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param BrandMaterial $brandMaterial
     * @param $data
     * @return bool|void
     */
    public function updateMaterialBrand(BrandMaterial $brandMaterial, $data){
        try {
            return $this->brandMaterialRepository->update($brandMaterial, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param BrandMaterial $brandMaterial
     * @return bool|void|null
     */
    public function deleteMaterialBrand(BrandMaterial $brandMaterial){
        try {
            return $this->brandMaterialRepository->delete($brandMaterial);
        }catch (Exception $exception){

        }
    }

    public function getAllBrandsByType($type, $pages){
        try {
            return $this->brandMaterialRepository->getAllBrandsByType($type, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalBrands(){
        try {
            return $this->brandMaterialRepository->getTotalBrands();
        }catch (Exception $exception){

        }
    }


}
