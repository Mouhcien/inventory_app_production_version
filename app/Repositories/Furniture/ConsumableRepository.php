<?php

namespace App\Repositories\Furniture;

use App\Models\Consumable;

class ConsumableRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])->get()->all();

            return Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByType($type, $pages) {
        try {

            if ($pages == 0)
                return Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])
                    ->where('type_consumable_id', $type)
                    ->get();

            return Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])
                ->where('type_consumable_id', $type)
                ->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByTypeStillInStock($type, $pages) {
        try {
            $query = Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])
                ->join('stock_consumables', 'stock_consumables.consumable_id', '=', 'consumables.id')
                ->where('consumables.type_consumable_id', $type)
                ->where('stock_consumables.quantity_rest', '>', 0)
                ->distinct();

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return Consumable
     */
    public function findOneById($id): ?Consumable {
        return Consumable::with(['type_consumable', 'fittings', 'stocks_consumables'])->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Consumable();
        $obj->ref = $data['ref'];
        $obj->type_consumable_id = $data['type_consumable_id'];
        $obj->image = $data['image'];
        $obj->description = $data['description'];
        return $obj->save();
    }

    /***
     * @param Consumable $consumable
     * @param $data
     * @return bool
     */
    function update(Consumable $consumable, $data): bool {
        $consumable->ref = $data['ref'];
        $consumable->type_consumable_id = $data['type_consumable_id'];
        $consumable->image = $data['image'];
        $consumable->description = $data['description'];
        return $consumable->save();
    }

    /***
     * @param Consumable $consumable
     * @return bool|null
     */
    function delete(Consumable $consumable) {
        return $consumable->delete();
    }

    function getTotalConsumable() {
        return Consumable::count();
    }

}
