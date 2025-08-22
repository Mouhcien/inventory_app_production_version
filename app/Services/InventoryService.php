<?php

namespace App\Services;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use App\Services\Material\TypeMaterialService;

class InventoryService {

    private InventoryRepository $inventoryRepository;

    /**
     * @param InventoryRepository $inventoryRepository
     */
    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllInventories($pages){
        try {
            return $this->inventoryRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Inventory
     * @throws ObjectNotFoundException
     */
    public function getOneInventoryById($id): Inventory
    {
        return $this->inventoryRepository->findOneById($id);
    }

    public function getOneInventoryBySerial($serial): Inventory
    {
        return $this->inventoryRepository->findOneBySerial($serial);
    }

    public function getAllInventoryByEmployee($employee_id)
    {
        return $this->inventoryRepository->findAllByEmployee($employee_id);
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewInventory($data){
        return $this->inventoryRepository->create($data);
    }

    /***
     * @param Inventory $inventory
     * @param $data
     * @return bool|void
     */
    public function updateInventory(Inventory $inventory, $data){
        return $this->inventoryRepository->update($inventory, $data);
    }

    /***
     * @param Inventory $inventory
     * @return bool|void|null
     */
    public function deleteInventory(Inventory $inventory){
        return $this->inventoryRepository->delete($inventory);
    }

    public function getAllInventoriesByType($type, $pages){
        return $this->inventoryRepository->allByTypeMaterial($type, $pages);
    }

    public function getAllInventoriesByBrand($brand, $pages){
        return $this->inventoryRepository->allByBrandMaterial($brand, $pages);
    }

    public function getAllInventoriesByMarch($march, $pages){
        return $this->inventoryRepository->allByModelMarch($march, $pages);
    }

    public function getAllInventoriesByModel($model, $pages){
        return $this->inventoryRepository->allByModelMaterial($model, $pages);
    }

    public function getAllInventoriesByFilter($filter, $pages){
        return $this->inventoryRepository->allByFilter($filter, $pages);
    }

    public function getAllInventoriesByAdvanceFilter($filter, $pages){
        return $this->inventoryRepository->allByAdvanceFilter($filter, $pages);
    }

    public function getTotalInventories() {
        return $this->inventoryRepository->getTotalInventories();
    }

    public function getInventoriesGroupByService() {
        return$this->inventoryRepository->getInventoriesGroupByService();
    }

    public function getInventoriesGroupByEntity() {
        return$this->inventoryRepository->getInventoriesGroupByEntity();
    }

    public function getInventoriesGroupBySecter() {
        return$this->inventoryRepository->getInventoriesGroupBySecter();
    }

    public function getInventoriesGroupBySection() {
        return$this->inventoryRepository->getInventoriesGroupBySection();
    }

    public function getInventoryHistoryByMaterial($material, $pages) {
        return$this->inventoryRepository->getInventoryHistoryByMaterial($material, $pages);
    }

    public function getAllDuplicateSerialInInventory() {
        return$this->inventoryRepository->getAllDuplicateSerialInInventory();
    }

    public function materialsForEachEmployees($nbr) {
        return$this->inventoryRepository->materialsForEachEmployees($nbr);
    }

    public function employeesWithMoreThanOneMaterialForEachType() {
        return$this->inventoryRepository->employeesWithMoreThanOneMaterialForEachType();
    }
}
