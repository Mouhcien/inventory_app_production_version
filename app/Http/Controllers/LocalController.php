<?php

namespace App\Http\Controllers;

use App\Services\InventoryService;
use App\Services\Local\CityService;
use App\Services\Local\LocalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocalController extends Controller
{
    private int $pages = 10;
    private LocalService $localService;
    private CityService $cityService;
    private InventoryService $inventoryService;
    private array $rules = [
        'title'     => 'required|max:255',
        'city_id'   => 'required'
    ];

    /**
     * @param LocalService $localService
     */
    public function __construct(LocalService $localService, CityService $cityService, InventoryService $inventoryService)
    {
        $this->localService = $localService;
        $this->cityService = $cityService;
        $this->inventoryService = $inventoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $locals = $this->localService->getAllLocals($this->pages);
            $cities = $this->cityService->getAllCities(0);
            return view("locals.locals.index", [
                'locals'      => $locals,
                'cities'      => $cities,
                'editedLocal' => null,
                'id'         => null,
                'url'        => 'locals.store',
                'title'      => 'Nouveau local'
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
            $result     = $this->localService->createNewLocal($data);

            if ($result)
                return Redirect::route('locals.index')->with('success', "Le nouveau local est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('locals.index')->with('error', "Une erreur technique est survenue pendant la création du local");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $local = $this->localService->getOneLocalById($id);
            $data = array();
            $dataFilter['filter'] = 'local';
            $dataFilter['value'] = $id;
            $data[] = $dataFilter;
            $inventories = $this->inventoryService->getAllInventoriesByAdvanceFilter($data, $this->pages);

            if (!$local)
                return Redirect::route('locals.index')->with('error', "Le local est introuvable");

            return view('locals.locals.show', [
                'local' => $local,
                'inventories' => $inventories,
                'total' => $inventories->total()
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('locals.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $local  = $this->localService->getOneLocalById($id);
            $locals = $this->localService->getAllLocals($this->pages);
            $cities = $this->cityService->getAllCities(0);
            return view("locals.locals.index", [
                'locals'       => $locals,
                'editedLocal'  => $local,
                'cities'        => $cities,
                'id'          => $id,
                'url'         => "locals.update",
                'title'       => 'Modifier la ville'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('locals.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $local = $this->localService->getOneLocalById($id);
            if (!$local)
                return Redirect::route('locals.index')->with('error', "Le local est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->localService->updateLocal($local, $data);

            if ($result)
                return Redirect::route('locals.index')->with('success', "Le local est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('locals.index')->with('error', "Une erreur technique est survenue pendant la modification du local");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $local = $this->localService->getOneLocalById($id);
            if (!$local)
                return Redirect::route('locals.index')->with('error', "Le local est introuvable");

            $result = $this->localService->deleteLocal($local);
            if ($result)
                return Redirect::route('locals.index')->with('success', "Le local est supprimé avec succès !");
            else
                return Redirect::route('locals.index')->with('error', "Une erreur technique est survenue pendant la suppression du local ");


        }catch (\Exception $exception) {
            return Redirect::route('locals.index')->with('error', $exception->getMessage());
        }
    }
}
