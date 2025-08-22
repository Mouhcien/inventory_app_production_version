<?php

namespace App\Repositories\Local;

use App\Models\City;

class CityRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return City::with('locals')->get();

            return City::with('locals')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return City
     */
    public function findOneById($id): ?City {
        return City::with('locals')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new City();
        $obj->title = $data['title'];
        return $obj->save();
    }

    /***
     * @param City $city
     * @param $data
     * @return bool
     */
    function update(City $city, $data): bool {
        $city->title = $data['title'];
        return $city->save();
    }

    /***
     * @param City $city
     * @return bool|null
     */
    function delete(City $city) {
        return $city->delete();
    }

    function getTotalCities() {
        return City::count();
    }
}
