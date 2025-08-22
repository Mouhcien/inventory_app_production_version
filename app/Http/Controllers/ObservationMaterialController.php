<?php

namespace App\Http\Controllers;

use App\Services\Material\MaterialService;
use App\Services\Material\ObservationMaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ObservationMaterialController extends Controller
{
    private int $pages = 10;
    private ObservationMaterialService $observationMaterialService;
    private MaterialService $materialService;
    private array $rules = [
        'title'     => 'required|max:255',
        'object' => 'required|max:255'
    ];

    /**
     * @param ObservationMaterialService $observationMaterialService
     */
    public function __construct(ObservationMaterialService $observationMaterialService, MaterialService $materialService)
    {
        $this->observationMaterialService = $observationMaterialService;
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $observations = $this->observationMaterialService->getAllMaterialObservations($this->pages);
            return view("materials.observations.index", [
                'observations'      => $observations,
                'editedObservation' => null,
                'id'         => null,
                'url'        => 'observations.store',
                'title'      => 'Nouvelle Observation du matériel'
            ]);

        }catch (\Exception $exception) {

        }
    }

    public function create(string $material_id) {
        try {
            $material = $this->materialService->getOneMaterialById($material_id);
            if (!$material)
                return Redirect::route('materials.show', $material_id)->with('error', "Le material est introuvable");

            return view('materials.observations.create', [
                'material' => $material
            ]);

        }catch (\Exception $exception) {
            //return Redirect::route('observations.index')->with('error', "Une erreur technique est survenue pendant la création du observation de matériel");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $material_id)
    {
        try {
            $data                   = $request->validate($this->rules);
            $data['material_id']    = $material_id;
            $result                 = $this->observationMaterialService->createNewMaterialObservation($data);

            if ($result)
                return Redirect::route('materials.show', $material_id)->with('success', "Nouvelle observation de matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('observations.create', $material_id)->with('error', "Une erreur technique est survenue pendant la création du observation de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $observation = $this->observationMaterialService->getOneMaterialObservationById($id);
            if (!$observation)
                return Redirect::route('observations.index')->with('error', "Le observation est introuvable");

            return view('observations.show')->with('observation', $observation);

        }catch (\Exception $exception) {
            return Redirect::route('observations.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $observation  = $this->observationMaterialService->getOneMaterialObservationById($id);
            $observations = $this->observationMaterialService->getAllMaterialObservations($this->pages);
            return view("materials.observations.index", [
                'observations'       => $observations,
                'editedObservation'  => $observation,
                'id'          => $id,
                'url'         => "observations.update",
                'title'       => 'Modifier le observation du matériel'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('observations.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $observation = $this->observationMaterialService->getOneMaterialObservationById($id);
            if (!$observation)
                return Redirect::route('observations.index')->with('error', "Le observation est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->observationMaterialService->updateMaterialObservation($observation, $data);

            if ($result)
                return Redirect::route('observations.index')->with('success', "Le observation du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('observations.index')->with('error', "Une erreur technique est survenue pendant la création du observation de matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $observation = $this->observationMaterialService->getOneMaterialObservationById($id);
            if (!$observation)
                return Redirect::route('observations.index')->with('error', "Le observation est introuvable");

            $result = $this->observationMaterialService->deleteMaterialObservation($observation);
            if ($result)
                return Redirect::route('observations.index')->with('success', "Le observation du matériel est supprimé avec succès !");
            else
                return Redirect::route('observations.index')->with('error', "Une erreur technique est survenue pendant la suppression du observation de matériel");


        }catch (\Exception $exception) {
            return Redirect::route('observations.index')->with('error', $exception->getMessage());
        }
    }
}
