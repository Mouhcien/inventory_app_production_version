<?php

namespace App\Repositories\Furniture;

use App\Models\StockConsumable;
use Illuminate\Support\Facades\DB;

class StockRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return StockConsumable::with(['consumable', 'delivery', 'consummations'])->orderBy('delivery_id', 'DESC')->get();

            return StockConsumable::with('consumable', 'delivery', 'consummations')->orderBy('delivery_id', 'DESC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByDeliveryYear($year, $pages) {
        try {
            $query = StockConsumable::with(['consumable', 'delivery', 'consummations'])
                        ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                        ->whereYear('deliveries.delivery_date', '=', $year)
                        ->orderBy('delivery_id', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allExistingConsumable($pages) {
        try {
            $query = StockConsumable::with(['consumable', 'delivery', 'consummations']);
            $query->where('stock_consumables.quantity_rest', '>', 0);

            $query->orderBy('delivery_id', 'DESC');
            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allStockConsumablesByFilter($filter, $value, $pages) {
        try {

            $query = StockConsumable::with(['consumable', 'delivery', 'consummations'])
                        ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id');

            switch ($filter) {
                case 'type':
                    $query
                        ->join('type_consumables', 'type_consumables.id', '=', 'consumables.type_consumable_id')
                        ->where('type_consumables.id', '=', $value);
                    break;
                case 'consumable':
                    $query->where('consumables.id', '=', $value);
                    break;
                case 'model':
                    $query
                        ->join('fittings', 'fittings.consumable_id', '=', 'stock_consumables.consumable_id')
                        ->where('fittings.model_material_id', '=', $value);
                    break;
            }

            $query->orderBy('delivery_id', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }


    public function allGroupedByYear($year) {
        try {

            return StockConsumable::query()
                ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                ->select(
                    DB::raw('SUM(stock_consumables.quantity_received) as quantity_received'),
                    DB::raw('SUM(stock_consumables.quantity_rest) as quantity_reset'),
                    DB::raw('YEAR(deliveries.delivery_date) as delivery_year')
                )
                ->whereYear('deliveries.delivery_date', $year)
                ->groupBy(DB::raw('YEAR(deliveries.delivery_date)'))
                ->get();

        }catch (\Exception $exception) {

        }
    }


    public function allDetailByTypeGroupedByYear($year) {
        try {

            return StockConsumable::query()
                ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id')
                ->join('type_consumables', 'type_consumables.id', '=', 'consumables.type_consumable_id')
                ->select(
                    DB::raw('SUM(stock_consumables.quantity_received) as quantity_received'),
                    DB::raw('SUM(stock_consumables.quantity_rest) as quantity_reset'),
                    DB::raw('YEAR(deliveries.delivery_date) as delivery_year'),
                    'consumables.type_consumable_id',
                    'type_consumables.title'
                )
                ->whereYear('deliveries.delivery_date', $year)
                ->groupBy(DB::raw('YEAR(deliveries.delivery_date)'), 'consumables.type_consumable_id')
                ->get();

        }catch (\Exception $exception) {

        }
    }

    public function allDetailGroupedByYear($year) {
        try {

            return StockConsumable::query()
                ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id')
                ->join('type_consumables', 'type_consumables.id', '=', 'consumables.type_consumable_id')
                ->select(
                    DB::raw('SUM(stock_consumables.quantity_received) as quantity_received'),
                    DB::raw('SUM(stock_consumables.quantity_rest) as quantity_reset'),
                    DB::raw('YEAR(deliveries.delivery_date) as delivery_year'),
                    'consumables.ref as ref',
                    'type_consumables.title as title'
                )
                ->whereYear('deliveries.delivery_date', $year)
                ->groupBy(DB::raw('YEAR(deliveries.delivery_date)'), 'consumables.ref', 'type_consumables.title')
                ->get();

        }catch (\Exception $exception) {

        }
    }

    public function allGroupedByDelivery() {
        try {

            return StockConsumable::query()
                ->join('deliveries', 'deliveries.id', '=', 'stock_consumables.delivery_id')
                ->select(
                    DB::raw('SUM(stock_consumables.quantity_received) as quantity_received'),
                    DB::raw('SUM(stock_consumables.quantity_rest) as quantity_reset'),
                    'deliveries.delivery_date'
                )
                ->groupBy('deliveries.delivery_date')
                ->get();

        }catch (\Exception $exception) {

        }
    }

    public function allByTypeConsumable($type, $pages) {
        try {

            if ($pages == 0)
                return StockConsumable::with(['consumable', 'delivery', 'consummations'])
                    ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id')
                    ->where('consumables.type_consumable_id', $type)
                    ->orderBy('delivery_id', 'DESC')
                    ->get();

            return StockConsumable::with('consumable', 'delivery', 'consummations')
                ->join('consumables', 'consumables.id', '=', 'stock_consumables.consumable_id')
                ->where('consumables.type_consumable_id', $type)
                ->orderBy('delivery_id', 'DESC')
                ->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByConsumable($consumable, $pages) {
        try {
            $query = StockConsumable::with(['consumable', 'delivery', 'consummations'])
                ->where(['consumable_id' => $consumable]);

            $query->orderBy('delivery_id', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    public function allByConsumableStillInStock($consumable, $pages) {
        try {
            $query = StockConsumable::with(['consumable', 'delivery', 'consummations'])
                ->where(['consumable_id' => $consumable])
                ->where('quantity_rest', '>', 0);

            $query->orderBy('delivery_id', 'DESC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return StockConsumable
     */
    public function findOneById($id): ?StockConsumable {
        return StockConsumable::with(['consumable', 'delivery', 'consummations'])->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new StockConsumable();
        $obj->delivery_id = $data['delivery_id'];
        $obj->consumable_id = $data['consumable_id'];
        $obj->quantity_received = $data['quantity_received'];
        $obj->quantity_rest = $data['quantity_received'];
        return $obj->save();
    }

    /***
     * @param StockConsumable $stock
     * @param $data
     * @return bool
     */
    function update(StockConsumable $stock, $data): bool {
        $stock->delivery_id = $data['delivery_id'];
        $stock->consumable_id = $data['consumable_id'];
        $stock->quantity_received = $data['quantity_received'];
        $stock->quantity_rest = $data['quantity_rest'];
        return $stock->save();
    }

    /***
     * @param StockConsumable $stock
     * @return bool|null
     */
    function delete(StockConsumable $stock) {
        return $stock->delete();
    }

}
