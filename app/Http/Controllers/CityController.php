<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use App\Services\Local\CityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CityController extends Controller
{
    private int $pages = 10;
    private CityService $cityService;
    private InventoryService $inventoryService;
    private array $rules = [
        'title'     => 'required|max:255',
    ];

    /**
     * @param CityService $cityService
     */
    public function __construct(CityService $cityService, InventoryService $inventoryService)
    {
        $this->cityService = $cityService;
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $cities = $this->cityService->getAllCities($this->pages);
            return view("locals.cities.index", [
                'cities'      => $cities,
                'editedCity' => null,
                'id'         => null,
                'url'        => 'cities.store',
                'title'      => 'Nouvelle Ville'
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
            $result     = $this->cityService->createNewCity($data);

            if ($result)
                return Redirect::route('cities.index')->with('success', "La nouvelle ville est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('cities.index')->with('error', "Une erreur technique est survenue pendant la création de la ville");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $city = $this->cityService->getOneCityById($id);
            $data = array();
            $dataFilter['filter'] = 'city';
            $dataFilter['value'] = $id;
            $data[] = $dataFilter;
            $inventories = $this->inventoryService->getAllInventoriesByAdvanceFilter($data, $this->pages);
            if (!$city)
                return Redirect::route('cities.index')->with('error', "La ville est introuvable");

            return view('locals.cities.show', [
                'city' => $city,
                'inventories' => $inventories,
                'total' => $inventories->total()
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('cities.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $city  = $this->cityService->getOneCityById($id);
            $cities = $this->cityService->getAllCities($this->pages);
            return view("locals.cities.index", [
                'cities'       => $cities,
                'editedCity'  => $city,
                'id'          => $id,
                'url'         => "cities.update",
                'title'       => 'Modifier la ville'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('cities.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $city = $this->cityService->getOneCityById($id);
            if (!$city)
                return Redirect::route('cities.index')->with('error', "La ville est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->cityService->updateCity($city, $data);

            if ($result)
                return Redirect::route('cities.index')->with('success', "La ville est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('cities.index')->with('error', "Une erreur technique est survenue pendant la modification de la ville");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $city = $this->cityService->getOneCityById($id);
            if (!$city)
                return Redirect::route('cities.index')->with('error', "La ville est introuvable");

            $result = $this->cityService->deleteCity($city);
            if ($result)
                return Redirect::route('cities.index')->with('success', "La ville est supprimé avec succès !");
            else
                return Redirect::route('cities.index')->with('error', "Une erreur technique est survenue pendant la suppression de la ville ");


        }catch (\Exception $exception) {
            return Redirect::route('cities.index')->with('error', $exception->getMessage());
        }
    }
}
