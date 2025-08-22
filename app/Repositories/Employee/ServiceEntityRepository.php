<?php

namespace App\Repositories\Employee;

use App\Models\ServiceEntity;

class ServiceEntityRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = ServiceEntity::with('entities')
                        ->orderBy('title', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return ServiceEntity
     */
    public function findOneById($id): ?ServiceEntity {
        return ServiceEntity::with('entities')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new ServiceEntity();
        $obj->title = $data['title'];
        return $obj->save();
    }

    /***
     * @param ServiceEntity $service
     * @param $data
     * @return bool
     */
    function update(ServiceEntity $service, $data): bool {
        $service->title = $data['title'];
        return $service->save();
    }

    /***
     * @param ServiceEntity $service
     * @return bool|null
     */
    function delete(ServiceEntity $service) {
        return $service->delete();
    }

    function getTotalServices() {
        return ServiceEntity::count();
    }
}
