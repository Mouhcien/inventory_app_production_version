<?php

namespace App\Services\Material;

use App\Exceptions\ObjectNotFoundException;
use App\Models\ObservationMaterial;
use App\Repositories\Material\ObservationMaterialRepository;

class ObservationMaterialService {

    private ObservationMaterialRepository $observationMaterialRepository;

    /**
     * @param ObservationMaterialRepository $observationMaterialRepository
     */
    public function __construct(ObservationMaterialRepository $observationMaterialRepository)
    {
        $this->observationMaterialRepository = $observationMaterialRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllMaterialObservations($pages){
        try {
            return $this->observationMaterialRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return ObservationMaterial
     * @throws ObjectNotFoundException
     */
    public function getOneMaterialObservationById($id): ObservationMaterial
    {
        $observation = $this->observationMaterialRepository->findOneById($id);
        if (is_null($observation)){
            throw new ObjectNotFoundException("La marque du matériel introuvable!!");
        }
        return $observation;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewMaterialObservation($data){
        try {
            return $this->observationMaterialRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param ObservationMaterial $observationMaterial
     * @param $data
     * @return bool|void
     */
    public function updateMaterialObservation(ObservationMaterial $observationMaterial, $data){
        try {
            return $this->observationMaterialRepository->update($observationMaterial, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param ObservationMaterial $observationMaterial
     * @return bool|void|null
     */
    public function deleteMaterialObservation(ObservationMaterial $observationMaterial){
        try {
            return $this->observationMaterialRepository->delete($observationMaterial);
        }catch (Exception $exception){

        }
    }

}
