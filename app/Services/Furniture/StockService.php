<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\StockConsumable;
use App\Repositories\Furniture\StockRepository;

class StockService {

    private StockRepository $stockRepository;

    /**
     * @param StockRepository $stockRepository
     */
    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllStockConsumables($pages){
        try {
            return $this->stockRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    public function allTotalExistingStock($filter, $value, $pages){
        try {
            return $this->stockRepository->allTotalExistingStock($filter, $value, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumablesByYear($year, $pages){
        try {
            return $this->stockRepository->allByDeliveryYear($year, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllExistingStockConsumables($pages){
        try {
            return $this->stockRepository->allExistingConsumable($pages);
        }catch (Exception $ex) {

        }
    }
    public function getAllStockConsumablesByFilter($filter, $value, $pages){
        try {
            return $this->stockRepository->allStockConsumablesByFilter($filter, $value, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumablesGroupedByYear($year){
        try {
            return $this->stockRepository->allGroupedByYear($year);
        }catch (Exception $ex) {

        }
    }



    public function getAllStockConsumableByTypeGroupedByYear($year){
        try {
            return $this->stockRepository->allDetailByTypeGroupedByYear($year);
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumableDetailGroupedByYear($year){
        try {
            return $this->stockRepository->allDetailGroupedByYear($year);
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumablesGroupedByDelivery(){
        try {
            return $this->stockRepository->allGroupedByDelivery();
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumablesByTypeConsumable($type, $pages){
        try {
            return $this->stockRepository->allByTypeConsumable($type, $pages);
        }catch (Exception $ex) {

        }
    }

    public function getAllStockConsumablesByConsumable($consumable, $pages){
        try {
            return $this->stockRepository->allByConsumable($consumable, $pages);
        }catch (Exception $ex) {

        }
    }

    public function allByConsumableStillInStock($consumable, $pages){
        try {
            return $this->stockRepository->allByConsumableStillInStock($consumable, $pages);
        }catch (Exception $ex) {

        }
    }
    /***
     * @param $id
     * @return StockConsumable
     * @throws ObjectNotFoundException
     */
    public function getOneStockConsumableById($id): StockConsumable
    {
        $stock = $this->stockRepository->findOneById($id);
        if (is_null($stock)){
            throw new ObjectNotFoundException("Le stock du consommable introuvable!!");
        }
        return $stock;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewStockConsumable($data){
        try {
            return $this->stockRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param StockConsumable $stock
     * @param $data
     * @return bool|void
     */
    public function updateStockConsumable(StockConsumable $stock, $data){
        try {
            return $this->stockRepository->update($stock, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param StockConsumable $stock
     * @return bool|void|null
     */
    public function deleteStockConsumable(StockConsumable $stock){
        try {
            return $this->stockRepository->delete($stock);
        }catch (Exception $exception){

        }
    }
}

