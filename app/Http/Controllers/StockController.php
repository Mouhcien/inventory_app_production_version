<?php

namespace App\Http\Controllers;

use App\Models\ModelMaterial;
use App\Services\Furniture\ConsumableService;
use App\Services\Furniture\ConsummationService;
use App\Services\Furniture\StockService;
use App\Services\Furniture\DeliveryService;
use App\Services\Furniture\TypeConsumableService;
use App\Services\Material\ModelMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mockery\Exception;

class StockController extends Controller
{
    private int $pages = 10;
    private ConsumableService $consumableService;
    private DeliveryService $deliveryService;
    private StockService $stockService;
    private ConsummationService $consummationService;
    private TypeConsumableService $typeConsumableService;
    private ModelMaterialService $modelMaterialService;
    private array $rules = [
        'consumable_id' => 'required',
        'quantity_received' => 'required'
    ];

    /**
     * @param ConsumableService $consumableService
     */
    public function __construct(ConsumableService $consumableService,
                                DeliveryService $deliveryService,
                                StockService $stockService,
                                ConsummationService $consummationService,
                                TypeConsumableService $typeConsumableService,
                                ModelMaterialService $modelMaterialService)
    {
        $this->consumableService = $consumableService;
        $this->deliveryService = $deliveryService;
        $this->stockService = $stockService;
        $this->consummationService = $consummationService;
        $this->typeConsumableService = $typeConsumableService;
        $this->modelMaterialService = $modelMaterialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $types = $this->typeConsumableService->getAllConsumableTypes(0);
            $consumables = $this->consumableService->getAllConsumables(0);
            $models_printers = $this->modelMaterialService->getAllModelsByTypeTitle("Imprimante", 0);
            $models_big_printers = $this->modelMaterialService->getAllModelsByTypeTitle("Photocopie", 0);

            $stocks = $this->stockService->getAllStockConsumables($this->pages);

            $years = $this->deliveryService->getDeliveryYears();
            $selectedYear = null;

            if ($request->has('year')) {
                $selectedYear = $request->query('year');
                $stocks = $this->stockService->getAllStockConsumablesByYear($selectedYear, $this->pages);
            }


            return view("funitures.stocks.index", [
                'types' => $types,
                'consumables' => $consumables,
                'models_printers' => $models_printers,
                'models_big_printers' => $models_big_printers,
                'stocks'      => $stocks,
                'filter' => null,
                'value' => null,
                'years' => $years,
                'selectedYear' => $selectedYear
            ]);

        }catch (\Exception $exception) {

        }
    }



    public function filter($filter, $value) {

        $stocks = $this->stockService->getAllStockConsumablesByFilter($filter, $value, $this->pages);

        $types = $this->typeConsumableService->getAllConsumableTypes(0);
        $consumables = $this->consumableService->getAllConsumables(0);
        $models_printers = $this->modelMaterialService->getAllModelsByTypeTitle("Imprimante", 0);
        $models_big_printers = $this->modelMaterialService->getAllModelsByTypeTitle("Photocopie", 0);

        return view("funitures.stocks.index", [
            'types' => $types,
            'consumables' => $consumables,
            'models_printers' => $models_printers,
            'models_big_printers' => $models_big_printers,
            'stocks'      => $stocks,
            'filter' => $filter,
            'value' => $value
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $delivery_id)
    {
        try {

            $data       = $request->validate($this->rules);
            $data['delivery_id'] = $delivery_id;

            if ($data['quantity_received'] > 0) {
                $result     = $this->stockService->createNewStockConsumable($data);

                if ($result)
                    return Redirect::route('deliveries.show', $delivery_id)->with('success', "Nouveau consommable ajouté avec succès !");
            }else
                return Redirect::route('deliveries.show', $delivery_id)->with('error', "La quantité doit être plus de 0");


        }catch (\Exception $exception) {
            return Redirect::route('deliveries.show', $delivery_id)->with('error', "Une erreur technique est survenue pendant la création du consumable de consommable");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $consumable = $this->consumableService->getOneConsumableById($id);
            $models = $this->modelMaterialService->getAllMaterialModels(0);

            if (!$consumable)
                return Redirect::route('consumables.index')->with('error', "Le consumable est introuvable");

            return view('funitures.consumables.show', [
                'consumable' => $consumable,
                'models' => $models
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    public function consummation(string $id)
    {
        try {

            $stock = $this->stockService->getOneStockConsumableById($id);
            $consummations = $this->consummationService->getConsummationsByStock($id, $this->pages);

            if (!$stock)
                return Redirect::route('consumables.index')->with('error', "Le consumable est introuvable");

            return view('funitures.stocks.consummation', [
                'stock' => $stock,
                'consummations' => $consummations
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $stock = $this->stockService->getOneStockConsumableById($id);
            if (!$stock)
                return Redirect::route('deliveries.show', $stock->delivery->id)->with('error', "Le stock est introuvable");

            $result = $this->stockService->deleteStockConsumable($stock);
            if ($result)
                return Redirect::route('deliveries.show', $stock->delivery->id)->with('success', "Les données de la livrasion est supprimé avec succès !");
            else
                return Redirect::route('deliveries.show', $stock->delivery->id)->with('error', "Une erreur technique est survenue pendant la suppression du consumable de consommable");


        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', $exception->getMessage());
        }
    }

    public function export($filter = null, $value = null) {
        try {

            return $this->exportStockConsumables($this->stockService, $filter, $value);


        }catch (Exception $exception) {

        }
    }
}
