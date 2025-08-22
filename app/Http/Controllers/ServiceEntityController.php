<?php

namespace App\Http\Controllers;

use App\Services\Employee\ServiceEntityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ServiceEntityController extends Controller
{

    private int $pages = 10;
    private ServiceEntityService $serviceEntityService;
    private array $rules = [
        'title'     => 'required|max:255',
    ];

    /**
     * @param ServiceEntityService $serviceEntityService
     */
    public function __construct(ServiceEntityService $serviceEntityService)
    {
        $this->serviceEntityService = $serviceEntityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $services = $this->serviceEntityService->getAllServiceEntities($this->pages);
            return view("entities.services.index", [
                'services'      => $services,
                'editedService' => null,
                'id'         => null,
                'url'        => 'services.store',
                'title'      => 'Nouveau service'
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
            $result     = $this->serviceEntityService->createNewServiceEntity($data);

            if ($result)
                return Redirect::route('services.index')->with('success', "Le nouveau service est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', "Une erreur technique est survenue pendant la création du service");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $serviceEntity = $this->serviceEntityService->getOneServiceEntityById($id);
            if (!$serviceEntity)
                return Redirect::route('services.index')->with('error', "Le service est introuvable");

            return view('entities.services.show')->with('serviceEntity', $serviceEntity);

        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $serviceEntity  = $this->serviceEntityService->getOneServiceEntityById($id);
            $services = $this->serviceEntityService->getAllServiceEntities($this->pages);
            return view("entities.services.index", [
                'services'       => $services,
                'editedService'  => $serviceEntity,
                'id'          => $id,
                'url'         => "services.update",
                'title'       => 'Modifier le service'
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $serviceEntity = $this->serviceEntityService->getOneServiceEntityById($id);
            if (!$serviceEntity)
                return Redirect::route('services.index')->with('error', "Le service est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->serviceEntityService->updateServiceEntity($serviceEntity, $data);

            if ($result)
                return Redirect::route('services.index')->with('success', "Le service est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', "Une erreur technique est survenue pendant la modification du service");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $serviceEntity = $this->serviceEntityService->getOneServiceEntityById($id);
            if (!$serviceEntity)
                return Redirect::route('services.index')->with('error', "Le service est introuvable");

            $result = $this->serviceEntityService->deleteServiceEntity($serviceEntity);
            if ($result)
                return Redirect::route('services.index')->with('success', "Le service est supprimé avec succès !");
            else
                return Redirect::route('services.index')->with('error', "Une erreur technique est survenue pendant la suppression du service ");


        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', $exception->getMessage());
        }
    }

    public function import(Request $request) {
        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                foreach ($rows[0] as $rr) {
                    $data['title']             = $rr[0];

                    $this->serviceEntityService->createNewServiceEntity($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('services.index')->with('success', "Nouveaux services ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('services.index')->with('error', "Nouveaux services ajouté ".$count."/".count($rows[0])." !");
                }

            }else{
                return Redirect::route('services.index')->with('error', "Merci de spécifier le fichier excel contenant les matériels");
            }

        }catch (\Exception $exception) {
            return Redirect::route('services.index')->with('error', "Une erreur technique est survenue pendant la création du service");
        }
    }
}
