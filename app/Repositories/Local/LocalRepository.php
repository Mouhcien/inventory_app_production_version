<?php

namespace App\Repositories\Local;

use App\Models\Local;

class LocalRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return Local::with('city')->get()->all();

            return Local::with('city')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return Local
     */
    public function findOneById($id): ?Local {
        return Local::with('city')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Local();
        $obj->title = $data['title'];
        $obj->city_id = $data['city_id'];
        return $obj->save();
    }

    /***
     * @param Local $local
     * @param $data
     * @return bool
     */
    function update(Local $local, $data): bool {
        $local->title = $data['title'];
        $local->city_id = $data['city_id'];
         return $local->save();
    }

    /***
     * @param Local $local
     * @return bool|null
     */
    function delete(Local $local) {
        return $local->delete();
    }

    function getTotalLocals() {
        return Local::count();
    }

}
