<?php

namespace App\Repositories\Furniture;

use App\Models\Delivery;
use Illuminate\Support\Facades\DB;

class DeliveryRepository {

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = Delivery::with('stocks_consumables')
                        ->orderBy('delivery_date', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByYear($year, $pages) {
        try {
            $query = Delivery::with('stocks_consumables')
                ->whereYear('delivery_date', '=', $year)
                ->orderBy('delivery_date', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function getDeliveryYears() {
        try {

            return Delivery::query()
                ->select(
                    DB::raw('YEAR(deliveries.delivery_date) as year')
                )
                ->distinct()
                ->get();

        }catch (\Exception $exception) {

        }
    }

    /***
     * @param $id
     * @return Delivery
     */
    public function findOneById($id): ?Delivery {
        return Delivery::with('stocks_consumables')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Delivery();
        $obj->title = $data['title'];
        $obj->delivery_date = $data['delivery_date'];
        $obj->observation = $data['observation'];
        return $obj->save();
    }

    /***
     * @param Delivery $delivery
     * @param $data
     * @return bool
     */
    function update(Delivery $delivery, $data): bool {
        $delivery->title = $data['title'];
        $delivery->delivery_date = $data['delivery_date'];
        $delivery->observation = $data['observation'];
        $delivery->is_valid = $data['is_valid'];

        return $delivery->save();
    }

    /***
     * @param Delivery $delivery
     * @return bool|null
     */
    function delete(Delivery $delivery) {
        return $delivery->delete();
    }
}
