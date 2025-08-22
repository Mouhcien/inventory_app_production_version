<?php

namespace App\Services\Local;

use App\Exceptions\ObjectNotFoundException;
use App\Models\City;
use App\Repositories\Local\CityRepository;

class CityService {

    private CityRepository $localRepository;

    /**
     * @param CityRepository $localRepository
     */
    public function __construct(CityRepository $localRepository)
    {
        $this->localRepository = $localRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllCities($pages){
        try {
            return $this->localRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return City
     * @throws ObjectNotFoundException
     */
    public function getOneCityById($id): City
    {
        $type = $this->localRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le local introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewCity($data){
        try {
            return $this->localRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param City $local
     * @param $data
     * @return bool|void
     */
    public function updateCity(City $local, $data){
        try {
            return $this->localRepository->update($local, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param City $local
     * @return bool|void|null
     */
    public function deleteCity(City $local){
        try {
            return $this->localRepository->delete($local);
        }catch (Exception $exception){

        }
    }

    public function getTotalCities() {
        try {
            return $this->localRepository->getTotalCities();
        }catch (Exception $exception){

        }
    }
}
