<?php

namespace App\Repositories\Employee;

use App\Models\Entity;

class EntityRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = Entity::with(['service_entity', 'type_entity', 'secters_entities', 'sections_entities'])
                        ->orderBy('title', 'ASC');
            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    public function allByType($type, $pages) {
        try {
            $query = Entity::with(['service_entity', 'type_entity', 'secters_entities', 'sections_entities'])
                        ->where('type_entity_id', '=', $type)
                        ->orderBy('title', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return Entity
     */
    public function findOneById($id): ?Entity {
        return Entity::with(['service_entity', 'type_entity', 'secters_entities', 'sections_entities'])->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Entity();
        $obj->title = $data['title'];
        $obj->service_entity_id = $data['service_entity_id'];
        $obj->type_entity_id = $data['type_entity_id'];
        return $obj->save();
    }

    /***
     * @param Entity $service
     * @param $data
     * @return bool
     */
    function update(Entity $service, $data): bool {
        $service->title = $data['title'];
        $service->service_entity_id = $data['service_entity_id'];
        $service->type_entity_id = $data['type_entity_id'];
        return $service->save();
    }

    /***
     * @param Entity $service
     * @return bool|null
     */
    function delete(Entity $service) {
        return $service->delete();
    }

    function getAllEntitiesByService($service_entity_id, $pages) {
        $query = Entity::with(['service_entity', 'type_entity', 'secters_entities', 'sections_entities'])
                    ->where('service_entity_id', '=', $service_entity_id);
        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    function getTotalEntities() {
        return Entity::count();
    }

}


