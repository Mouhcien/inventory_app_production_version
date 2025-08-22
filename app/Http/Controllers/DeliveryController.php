<?php

namespace App\Http\Controllers;

use App\Models\Consumable;
use App\Services\Furniture\ConsumableService;
use App\Services\Furniture\ConsummationService;
use App\Services\Furniture\DeliveryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DeliveryController extends Controller
{

    private int $pages = 10;
    private DeliveryService $deliveryService;
    private ConsumableService $consumableService;
    private ConsummationService $consummationService;
    private array $rules = [
        'title'     => 'required|max:255',
        'delivery_date' => 'required'
    ];

    /**
     * @param DeliveryService $deliveryService
     */
    public function __construct(DeliveryService $deliveryService, ConsumableService $consumableService, ConsummationService $consummationService)
    {
        $this->deliveryService = $deliveryService;
        $this->consumableService = $consumableService;
        $this->consummationService = $consummationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $deliveries = $this->deliveryService->getAllDeliveries($this->pages);
            $years = $this->deliveryService->getDeliveryYears();
            $selectedYear = null;

            if ($request->has('year')) {
                $selectedYear = $request->query('year');
                $deliveries = $this->deliveryService->getAllDeliveriesByYear($selectedYear, $this->pages);
            }
            return view("funitures.deliveries.index", [
                'deliveries'     => $deliveries,
                'editedDelivery' => null,
                'id'             => null,
                'url'            => 'deliveries.store',
                'title'          => 'Nouvelle livrasion du consommmable',
                'years'          => $years,
                'selectedYear'   => $selectedYear
            ]);

        }catch (\Exception $exception) {

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data       = $request->validate($this->rules);
            $data['observation'] = $request->get('observation');
            $result     = $this->deliveryService->createNewDelivery($data);

            if ($result)
                return Redirect::route('deliveries.index')->with('success', "Nouvelle livraison de consommable ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', "Une erreur technique est survenue pendant la création de la livrasion de consommable");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $delivery = $this->deliveryService->getOneDeliveryById($id);
            $consumables = $this->consumableService->getAllConsumables(0);

            if (!$delivery)
                return Redirect::route('deliveries.index')->with('error', "La livarsion est introuvable");

            return view('funitures.deliveries.show', [
                'delivery' => $delivery,
                'consumables' => $consumables
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $delivery  = $this->deliveryService->getOneDeliveryById($id);
            $deliveries = $this->deliveryService->getAllDeliveries($this->pages);
            return view("funitures.deliveries.index", [
                'deliveries'       => $deliveries,
                'editedDelivery'  => $delivery,
                'id'          => $id,
                'url'         => "deliveries.update",
                'title'       => 'Modifier la livrasion du consommable'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $delivery = $this->deliveryService->getOneDeliveryById($id);
            if (!$delivery)
                return Redirect::route('deliveries.index')->with('error', "La livrasion est introuvable");

            $data       = $request->validate($this->rules);
            $data['observation'] = $request->get('observation');
            $result     = $this->deliveryService->updateDelivery($delivery, $data);

            if ($result)
                return Redirect::route('deliveries.index')->with('success', "Le delivery du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', "Une erreur technique est survenue pendant la création du delivery de matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $delivery = $this->deliveryService->getOneDeliveryById($id);
            if (!$delivery)
                return Redirect::route('deliveries.index')->with('error', "La livrasion est introuvable");

            $result = $this->deliveryService->deleteDelivery($delivery);
            if ($result)
                return Redirect::route('deliveries.index')->with('success', "La livrasion du consommable est supprimé avec succès !");
            else
                return Redirect::route('deliveries.index')->with('error', "Une erreur technique est survenue pendant la suppression de la livrasion du consommablle");


        }catch (\Exception $exception) {
            return Redirect::route('deliveries.index')->with('error', $exception->getMessage());
        }
    }

    public function valid($delivery_id){
        try {
            $delivery = $this->deliveryService->getOneDeliveryById($delivery_id);
            if (!$delivery)
                return Redirect::route('deliveries.show', $delivery_id)->with('error', "La livrasion est introuvable");

            $data['title'] = $delivery['title'];
            $data['delivery_date'] = $delivery['delivery_date'];
            $data['observation'] = $delivery['observation'];
            $data['is_valid'] = true;

            $result = $this->deliveryService->updateDelivery($delivery, $data);

            if ($result)
                return Redirect::route('deliveries.show', $delivery_id)->with('success', "La livrasion du consommable est modifié avec succès !");
            else
                return Redirect::route('deliveries.show', $delivery_id)->with('error', "Une erreur technique est survenue pendant la suppression de la livrasion du consommablle");


        }catch (\Exception $exception) {
            return Redirect::route('deliveries.show', $delivery_id)->with('error', $exception->getMessage());
        }
    }

    public function stock(int $delivery_id, int $consumable_id=null) {

        $delivery = $this->deliveryService->getOneDeliveryById($delivery_id);
        if (is_null($delivery))
            return Redirect::route('deliveries.stock', $delivery_id)->with('error', "La livrasion est introuvable");

        if (is_null($consumable_id))
            $consummations = $this->consummationService->getConsummationsByDelivery($delivery_id, $this->pages);
        else
            $consummations = $this->consummationService->getConsummationsByDeliveryAndConsumable($delivery_id, $consumable_id, $this->pages);

        return view('funitures.deliveries.stock', [
            'delivery' => $delivery,
            'consummations' => $consummations
        ]);
    }
}
