<?php

namespace App\Services\Furniture;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Fitting;
use App\Repositories\Furniture\FittingRepository;

class FittingService {

    private FittingRepository $fittingRepository;

    /**
     * @param FittingRepository $fittingRepository
     */
    public function __construct(FittingRepository $fittingRepository)
    {
        $this->fittingRepository = $fittingRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllFittings($pages){
        try {
            return $this->fittingRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Fitting
     * @throws ObjectNotFoundException
     */
    public function getOneFittingById($id): Fitting
    {
        $type = $this->fittingRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le type du consommable introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewFitting($data){
        try {
            return $this->fittingRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Fitting $fitting
     * @param $data
     * @return bool|void
     */
    public function updateFitting(Fitting $fitting, $data){
        try {
            return $this->fittingRepository->update($fitting, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Fitting $fitting
     * @return bool|void|null
     */
    public function deleteFitting(Fitting $fitting){
        try {
            return $this->fittingRepository->delete($fitting);
        }catch (Exception $exception){

        }
    }
}
