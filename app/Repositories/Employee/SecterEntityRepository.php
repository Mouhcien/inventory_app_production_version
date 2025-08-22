<?php

namespace App\Repositories\Employee;

use App\Models\SecterEntity;

class SecterEntityRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = SecterEntity::with('entity')
                        ->orderBy('id', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return SecterEntity
     */
    public function findOneById($id): ?SecterEntity {
        return SecterEntity::with('entity')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new SecterEntity();
        $obj->title = $data['title'];
        $obj->entity_id = $data['entity_id'];
        return $obj->save();
    }

    /***
     * @param SecterEntity $secter
     * @param $data
     * @return bool
     */
    function update(SecterEntity $secter, $data): bool {
        $secter->title = $data['title'];
        $secter->entity_id = $data['entity_id'];
        return $secter->save();
    }

    /***
     * @param SecterEntity $secter
     * @return bool|null
     */
    function delete(SecterEntity $secter) {
        return $secter->delete();
    }

    function getSectersByService($id, $pages) {
        $query = SecterEntity::with('entity')
                    ->join('entities', 'entities.id', '=', 'secter_entities.entity_id')
                    ->where('entities.service_entity_id', '=', $id)
                    ->select('secter_entities.*');

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    function getSectersByEntity($id, $pages) {
        $query = SecterEntity::with('entity')
                    ->where('entity_id', '=', $id)
                    ->orderBy('id', 'ASC');

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    function getTotalSecter() {
        return SecterEntity::count();
    }

}
