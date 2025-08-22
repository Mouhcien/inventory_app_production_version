<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\SectionEntity;
use App\Repositories\Employee\SectionEntityRepository;

class SectionEntityService {

    private SectionEntityRepository $sectionEntityRepository;

    /**
     * @param SectionEntityRepository $sectionEntityRepository
     */
    public function __construct(SectionEntityRepository $sectionEntityRepository)
    {
        $this->sectionEntityRepository = $sectionEntityRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllSectionEntities($pages){
        try {
            return $this->sectionEntityRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return SectionEntity
     * @throws ObjectNotFoundException
     */
    public function getOneSectionEntityById($id): SectionEntity
    {
        $type = $this->sectionEntityRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("La section introuvable!!");
        }
        return $type;
    }

    /***
     * @param $data
     * @return bool|void
     */
    public function createNewSectionEntity($data){
        try {
            return $this->sectionEntityRepository->create($data);
        }catch (Exception $exception) {

        }
    }

    /***
     * @param SectionEntity $sectionEntity
     * @param $data
     * @return bool|void
     */
    public function updateSectionEntity(SectionEntity $sectionEntity, $data){
        try {
            return $this->sectionEntityRepository->update($sectionEntity, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param SectionEntity $sectionEntity
     * @return bool|void|null
     */
    public function deleteSectionEntity(SectionEntity $sectionEntity){
        try {
            return $this->sectionEntityRepository->delete($sectionEntity);
        }catch (Exception $exception){

        }
    }

    public function getSectionsByEntity($id, $pages) {
        try {
            return $this->sectionEntityRepository->getSectionByEntity($id, $pages);
        }catch (Exception $exception){

        }
    }

    public function getSectionsByService($id, $pages) {
        try {
            return $this->sectionEntityRepository->getSectionsByService($id, $pages);
        }catch (Exception $exception){

        }
    }

    public function getTotalSections() {
        try {
            return $this->sectionEntityRepository->getTotalSection();
        }catch (Exception $exception){

        }
    }
}
