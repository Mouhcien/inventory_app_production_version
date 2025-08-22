<?php

namespace App\Services;

use App\Exceptions\ObjectNotFoundException;
use App\Models\InventoryPhotocopy;
use App\Repositories\InventoryPhotocopyRepository;

class InventoryPhotocopyService {

    private InventoryPhotocopyRepository $inventoryPhotocopyRepository;

    /**
     * @param InventoryPhotocopyRepository $inventoryPhotocopyRepository
     */
    public function __construct(InventoryPhotocopyRepository $inventoryPhotocopyRepository)
    {
        $this->inventoryPhotocopyRepository = $inventoryPhotocopyRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllInventories($pages){
        try {
            return $this->inventoryPhotocopyRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return InventoryPhotocopy
     * @throws ObjectNotFoundException
     */
    public function getOneInventoryPhotocopyById($id): InventoryPhotocopy
    {
        return $this->inventoryPhotocopyRepository->findOneById($id);
    }

    public function getOneInventoryPhotocopyBySerial($serial): InventoryPhotocopy
    {
        return $this->inventoryPhotocopyRepository->findOneBySerial($serial);
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewInventoryPhotocopy($data){
        return $this->inventoryPhotocopyRepository->create($data);
    }

    /***
     * @param InventoryPhotocopy $inventory
     * @param $data
     * @return bool|void
     */
    public function updateInventoryPhotocopy(InventoryPhotocopy $inventory, $data){
        return $this->inventoryPhotocopyRepository->update($inventory, $data);
    }

    /***
     * @param InventoryPhotocopy $inventory
     * @return bool|void|null
     */
    public function deleteInventoryPhotocopy(InventoryPhotocopy $inventory){
        return $this->inventoryPhotocopyRepository->delete($inventory);
    }

    public function getAllInventoriesByType($type, $pages){
        return $this->inventoryPhotocopyRepository->allByTypeMaterial($type, $pages);
    }

    public function getAllInventoriesByBrand($brand, $pages){
        return $this->inventoryPhotocopyRepository->allByBrandMaterial($brand, $pages);
    }

    public function getAllInventoriesByMarch($march, $pages){
        return $this->inventoryPhotocopyRepository->allByModelMarch($march, $pages);
    }

    public function getAllInventoriesByModel($model, $pages){
        return $this->inventoryPhotocopyRepository->allByModelMaterial($model, $pages);
    }

    public function getAllInventoriesByFilter($filter, $pages){
        return $this->inventoryPhotocopyRepository->allByFilter($filter, $pages);
    }


    public function getTotalInventories() {
        return $this->inventoryPhotocopyRepository->getTotalInventories();
    }

    public function getInventoriesGroupByService() {
        return$this->inventoryPhotocopyRepository->getInventoriesGroupByService();
    }

    public function getInventoriesGroupByEntity() {
        return$this->inventoryPhotocopyRepository->getInventoriesGroupByEntity();
    }

    public function getInventoriesGroupBySecter() {
        return$this->inventoryPhotocopyRepository->getInventoriesGroupBySecter();
    }

    public function getInventoriesGroupBySection() {
        return$this->inventoryPhotocopyRepository->getInventoriesGroupBySection();
    }

    public function getInventoryPhotocopyHistoryByMaterial($material, $pages) {
        return$this->inventoryPhotocopyRepository->getInventoryPhotocopyHistoryByMaterial($material, $pages);
    }

    public function getAllDuplicateSerialInInventoryPhotocopy() {
        return$this->inventoryPhotocopyRepository->getAllDuplicateSerialInInventoryPhotocopy();
    }

    public function materialsForEachEmployees($nbr) {
        return$this->inventoryPhotocopyRepository->materialsForEachEmployees($nbr);
    }

    public function employeesWithMoreThanOneMaterialForEachType() {
        return$this->inventoryPhotocopyRepository->employeesWithMoreThanOneMaterialForEachType();
    }
}
