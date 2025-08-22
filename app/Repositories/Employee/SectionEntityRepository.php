<?php

namespace App\Repositories\Employee;

use App\Models\SecterEntity;
use App\Models\SectionEntity;

class SectionEntityRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = SectionEntity::with('entity')
                        ->orderBy('id', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return SectionEntity
     */
    public function findOneById($id): ?SectionEntity {
        return SectionEntity::with('entity')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new SectionEntity();
        $obj->title = $data['title'];
        $obj->entity_id = $data['entity_id'];
        return $obj->save();
    }

    /***
     * @param SectionEntity $section
     * @param $data
     * @return bool
     */
    function update(SectionEntity $section, $data): bool {
        $section->title = $data['title'];
        $section->entity_id = $data['entity_id'];
        return $section->save();
    }

    /***
     * @param SectionEntity $section
     * @return bool|null
     */
    function delete(SectionEntity $section) {
        return $section->delete();
    }

    function getSectionsByService($id, $pages){
        $query = SectionEntity::with('entity')
                    ->join('entities', 'entities.id', '=', 'section_entities.entity_id')
                    ->where('entities.service_entity_id', '=', $id)
                    ->select('section_entities.*');

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }


    function getSectionByEntity($id, $pages) {
        $query = SectionEntity::with('entity')
                    ->where('entity_id', '=', $id)
                    ->orderBy('id', 'ASC');

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    function getTotalSection() {
        return SectionEntity::count();
    }
}
