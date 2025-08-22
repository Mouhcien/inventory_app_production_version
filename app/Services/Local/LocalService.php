<?php

namespace App\Services\Local;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Local;
use App\Repositories\Local\LocalRepository;

class LocalService {


    private LocalRepository $localRepository;

    /**
     * @param LocalRepository $localRepository
     */
    public function __construct(LocalRepository $localRepository)
    {
        $this->localRepository = $localRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllLocals($pages){
        try {
            return $this->localRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Local
     * @throws ObjectNotFoundException
     */
    public function getOneLocalById($id): Local
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
    public function createNewLocal($data){
        try {
            return $this->localRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param Local $local
     * @param $data
     * @return bool|void
     */
    public function updateLocal(Local $local, $data){
        try {
            return $this->localRepository->update($local, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Local $local
     * @return bool|void|null
     */
    public function deleteLocal(Local $local){
        try {
            return $this->localRepository->delete($local);
        }catch (Exception $exception){

        }
    }

    public function getTotalLocals() {
        try {
            return $this->localRepository->getTotalLocals();
        }catch (Exception $exception){

        }
    }
}
