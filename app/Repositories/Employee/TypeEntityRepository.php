<?php

namespace App\Repositories\Employee;

use App\Models\TypeEntity;

class TypeEntityRepository {



    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = TypeEntity::with('entities')
                        ->orderBy('id', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /***
     * @param $id
     * @return TypeEntity
     */
    public function findOneById($id): ?TypeEntity {
        return TypeEntity::with('entities')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new TypeEntity();
        $obj->title = $data['title'];
        return $obj->save();
    }

    /***
     * @param TypeEntity $type
     * @param $data
     * @return bool
     */
    function update(TypeEntity $type, $data): bool {
        $type->title = $data['title'];
        return $type->save();
    }

    /***
     * @param TypeEntity $type
     * @return bool|null
     */
    function delete(TypeEntity $type) {
        return $type->delete();
    }
}
