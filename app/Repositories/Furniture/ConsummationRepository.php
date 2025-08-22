<?php

namespace App\Repositories\Furniture;

use App\Models\Consummation;

class ConsummationRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = Consummation::with(['employee', 'stock_consumable'])->orderBy('consummation_date', 'DESC');
            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByFilter($filter, $value, $pages) {
        try {
            $query = Consummation::with(['employee', 'stock_consumable'])
                        ->join('stock_consumables', 'stock_consumables.id', '=', 'consummations.stock_consumable_id')
                        ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id')
                        ->join('employees', 'employees.id', '=', 'consummations.employee_id');

            switch ($filter) {
                case 'type':
                    $query->join('type_consumables', 'type_consumables.id', '=', 'consumables.type_consumable_id')
                        ->where('type_consumables.id', '=', $value);
                    break;
                case 'consumable':
                    $query->where('consumables.id', '=', $value);
                    break;
                case 'employee':
                    $query->where('consummations.employee_id', '=', $value);
                    break;
                case 'service':
                    $query->where('employees.service_entity_id', '=', $value);
                    break;
                case 'entity':
                    $query->where('employees.entity_id', '=', $value);
                    break;
                case 'secter':
                    $query->where('employees.secter_entity_id', '=', $value);
                    break;
                case 'section':
                    $query->where('employees.section_entity_id', '=', $value);
                    break;
                case 'local':
                    $query->where('employees.local_id', '=', $value);
                    break;
            }

            $query->select('consummations.*')->orderBy('consummation_date', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allEmployeesFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                        ->join('employees', 'consummations.employee_id', '=', 'employees.id') // Assuming 'employee_id' is the foreign key
                        ->select('employees.*')
                        ->distinct()
                        ->orderBy('employees.lastname');

            if ($pages == 0)
                return $query->get();


            return $query
                    ->distinct()
                    ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allServicesFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                ->join('employees', 'consummations.employee_id', '=', 'employees.id')
                ->join('service_entities', 'service_entities.id', '=', 'employees.service_entity_id')
                ->select('service_entities.*')
                ->distinct()
                ->orderBy('service_entities.title');

            if ($pages == 0)
                return $query->get();


            return $query
                ->distinct()
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allEntitiesFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                ->join('employees', 'consummations.employee_id', '=', 'employees.id')
                ->join('entities', 'entities.id', '=', 'employees.entity_id')
                ->select('entities.*')
                ->distinct()
                ->orderBy('entities.title');

            if ($pages == 0)
                return $query->get();


            return $query
                ->distinct()
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allSectersFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                ->join('employees', 'consummations.employee_id', '=', 'employees.id')
                ->join('secter_entities', 'secter_entities.id', '=', 'employees.secter_entity_id')
                ->select('secter_entities.*')
                ->distinct()
                ->orderBy('secter_entities.title');

            if ($pages == 0)
                return $query->get();


            return $query
                ->distinct()
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allSectionsFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                ->join('employees', 'consummations.employee_id', '=', 'employees.id')
                ->join('section_entities', 'section_entities.id', '=', 'employees.section_entity_id')
                ->select('section_entities.*')
                ->distinct()
                ->orderBy('section_entities.title');

            if ($pages == 0)
                return $query->get();


            return $query
                ->distinct()
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allLocalsFromConsummations($pages) {
        try {

            $query = Consummation::with(['employee'])
                ->join('employees', 'consummations.employee_id', '=', 'employees.id')
                ->join('locals', 'locals.id', '=', 'employees.local_id')
                ->select('locals.*')
                ->distinct()
                ->orderBy('locals.title');

            if ($pages == 0)
                return $query->get();


            return $query
                ->distinct()
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return Consummation
     */
    public function findOneById($id): ?Consummation {
        return Consummation::with(['employee', 'stock_consumable'])->find($id);
    }

    public function getConsummationsByDelivery($id, $pages) {
        $req =  Consummation::with(['employee', 'stock_consumable'])
                    ->join('stock_consumables', 'stock_consumables.id', '=', 'consummations.stock_consumable_id')
                    ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                    ->where('deliveries.id', '=', $id)
                    ->select('consummations.*');

        if ($pages == 0)
            return $req->get();

        return $req->paginate($pages);
    }

    public function getConsummationsByConsumable($consumable, $pages) {
        $req =  Consummation::with(['employee', 'stock_consumable'])
            ->join('stock_consumables', 'stock_consumables.id', '=', 'consummations.stock_consumable_id')
            ->where('stock_consumables.consumable_id', '=', $consumable)
            ->select('consummations.*');

        if ($pages == 0)
            return $req->get();

        return $req->paginate($pages);
    }

    public function getConsummationsByStock($stock, $pages) {
        $req =  Consummation::with(['employee', 'stock_consumable'])
            ->join('stock_consumables', 'stock_consumables.id', '=', 'consummations.stock_consumable_id')
            ->where('consummations.stock_consumable_id', '=', $stock);

        if ($pages == 0)
            return $req->get();

        return $req->paginate($pages);
    }

    public function getConsummationsByDeliveryAndConsumable($delivery, $consumable, $pages) {
        $req =  Consummation::with(['employee', 'stock_consumable'])
            ->join('stock_consumables', 'stock_consumables.id', '=', 'consummations.stock_consumable_id')
            ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
            ->where('deliveries.id', '=', $delivery)
            ->where('stock_consumables.consumable_id', '=', $consumable)
            ->select('consummations.*');

        if ($pages == 0)
            return $req->get();

        return $req->paginate($pages);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Consummation();
        $obj->stock_consumable_id = $data['stock_consumable_id'];
        $obj->employee_id = $data['employee_id'];
        $obj->quantity_required = $data['quantity_required'];
        $obj->consummation_date = $data['consummation_date'];
        if (isset($data['is_done']))
            $obj->is_done = $data['is_done'];
        return $obj->save();
    }

    /***
     * @param Consummation $consummation
     * @param $data
     * @return bool
     */
    function update(Consummation $consummation, $data): bool {
        $consummation->stock_consumable_id = $data['stock_consumable_id'];
        $consummation->employee_id = $data['employee_id'];
        $consummation->quantity_required = $data['quantity_required'];
        $consummation->consummation_date = $data['consummation_date'];
        $consummation->is_done = $data['is_done'];
        return $consummation->save();
    }

    /***
     * @param Consummation $consummation
     * @return bool|null
     */
    function delete(Consummation $consummation) {
        return $consummation->delete();
    }

}
