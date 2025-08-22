<?php

namespace App\Http\Controllers;

use App\Services\Employee\EntityService;
use App\Services\Employee\ServiceEntityService;
use App\Services\Employee\TypeEntityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class EntityController extends Controller
{

    private int $pages = 10;
    private EntityService $entityService;
    private ServiceEntityService $serviceEntityService;
    private TypeEntityService $typeEntityService;
    private array $rules = [
        'title'             => 'required|max:255',
        'type_entity_id'    => 'required',
        'service_entity_id' => 'required'
    ];

    /**
     * @param EntityService $entityService
     */
    public function __construct(EntityService $entityService,
                                ServiceEntityService $serviceEntityService,
                                TypeEntityService $typeEntityService)
    {
        $this->entityService = $entityService;
        $this->typeEntityService = $typeEntityService;
        $this->serviceEntityService = $serviceEntityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index($type=null)
    {
        try {

            if (is_null($type))
                $entities = $this->entityService->getAllEntities($this->pages);
            else
                $entities = $this->entityService->getAllByType($type, $this->pages);

            $types = $this->typeEntityService->getAllTypeEntities(0);
            $services = $this->serviceEntityService->getAllServiceEntities(0);
            return view("entities.entities.index", [
                'services' => $services,
                'entities' => $entities,
                'types'      => $types,
                'editedEntity' => null,
                'id'         => null,
                'url'        => 'entities.store',
                'title'      => "Nouvelle Entité"
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
            $result     = $this->entityService->createNewEntity($data);

            if ($result)
                return Redirect::route('entities.index')->with('success', "La nouvelle entité est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', "Une erreur technique est survenue pendant la création ");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $entity = $this->entityService->getOneEntityById($id);
            if (!$entity)
                return Redirect::route('entities.index')->with('error', "L'entité est introuvable");

            return view('entities.entities.show')->with('entity', $entity);

        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $entity  = $this->entityService->getOneEntityById($id);
            $entities = $this->entityService->getAllEntities($this->pages);
            $types = $this->typeEntityService->getAllTypeEntities(0);
            $services = $this->serviceEntityService->getAllServiceEntities(0);
            return view("entities.entities.index", [
                'services' => $services,
                'types'       => $types,
                'entities' => $entities,
                'editedEntity'  => $entity,
                'id'          => $id,
                'url'         => "entities.update",
                'title'       => "Modifier l'entité"
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $entity = $this->entityService->getOneEntityById($id);
            if (!$entity)
                return Redirect::route('entities.index')->with('error', "L'entité est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->entityService->updateEntity($entity, $data);

            if ($result)
                return Redirect::route('entities.index')->with('success', "L'entité est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', "Une erreur technique est survenue pendant la modification de l'entité");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $entity = $this->entityService->getOneEntityById($id);
            if (!$entity)
                return Redirect::route('entities.index')->with('error', "L'entité est introuvable");

            $result = $this->entityService->deleteEntity($entity);
            if ($result)
                return Redirect::route('entities.index')->with('success', "L'entité est supprimé avec succès !");
            else
                return Redirect::route('entities.index')->with('error', "Une erreur technique est survenue pendant la suppression d'entité ");


        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', $exception->getMessage());
        }
    }

    public function import(Request $request) {
        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                $data['type_entity_id']     = $request->get('type_entity_id');
                $data['service_entity_id']  = $request->get('service_entity_id');

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                foreach ($rows[0] as $rr) {
                    $data['title']             = $rr[0];

                    $this->entityService->createNewEntity($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('entities.index')->with('success', "Nouvelles entités ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('entities.index')->with('error', "Nouvelles entités ajouté ".$count."/".count($rows[0])." !");
                }

            }else{
                return Redirect::route('entities.index')->with('error', "Merci de spécifier le fichier excel contenant les entités");
            }

        }catch (\Exception $exception) {
            return Redirect::route('entities.index')->with('error', "Une erreur technique est survenue pendant la création des entités");
        }
    }
}
