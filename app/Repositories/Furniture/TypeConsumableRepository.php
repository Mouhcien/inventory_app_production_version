<?php

namespace App\Repositories\Furniture;

use App\Models\TypeConsumable;

class TypeConsumableRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return TypeConsumable::with('consumables')->get();

            return TypeConsumable::with('consumables')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return TypeConsumable
     */
    public function findOneById($id): ?TypeConsumable {
        return TypeConsumable::with('consumables')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new TypeConsumable();
        $obj->title = $data['title'];
        return $obj->save();
    }

    /***
     * @param TypeConsumable $type
     * @param $data
     * @return bool
     */
    function update(TypeConsumable $type, $data): bool {
        $type->title = $data['title'];
        return $type->save();
    }

    /***
     * @param TypeConsumable $type
     * @return bool|null
     */
    function delete(TypeConsumable $type) {
        return $type->delete();
    }

    function getTotalTypeConsumable() {
        return TypeConsumable::count();
    }

}
