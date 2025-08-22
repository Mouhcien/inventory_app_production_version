<?php

namespace App\Http\Controllers;

use App\Services\Employee\EntityService;
use App\Services\Employee\SecterEntityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SecterEntityController extends Controller
{
    private int $pages = 10;
    private EntityService $entityService;
    private SecterEntityService $secterEntityService;
    private array $rules = [
        'title'             => 'required|max:255',
        'entity_id'    => 'required'
    ];

    /**
     * @param EntityService $secterEntityService
     */
    public function __construct(EntityService $entityService,
                                SecterEntityService $secterEntityService)
    {
        $this->secterEntityService = $secterEntityService;
        $this->entityService = $entityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities($this->pages);
            return view("entities.secters.index", [
                'entities' => $entities,
                'secters' => $secters,
                'editedSecter' => null,
                'id'         => null,
                'url'        => 'secters.store',
                'title'      => "Nouveau Secteur",
                'entity'    => null
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
            $result     = $this->secterEntityService->createNewSecterEntity($data);

            if ($result) {
                if ($request->has('operation'))
                    return Redirect::route('secters.secteurs', $data['entity_id'])->with('success', "Le nouveau secteur est ajouté avec succès !");

                return Redirect::route('secters.index')->with('success', "Le nouveau secteur est ajouté avec succès !");
            }

        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', "Une erreur technique est survenue pendant la création du secteur [".$exception->getMessage()."]");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $secter = $this->secterEntityService->getOneSecterEntityById($id);
            if (!$secter)
                return Redirect::route('secters.index')->with('error', "Le secteur est introuvable");

            return view('entities.secters.show')->with('secter', $secter);

        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $secter  = $this->secterEntityService->getOneSecterEntityById($id);
            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities($this->pages);
            return view("entities.secters.index", [
                'entities'       => $entities,
                'secters'       => $secters,
                'editedSecter'  => $secter,
                'id'            => $id,
                'url'            => "secters.update",
                'title'         => "Modifier le secteur",
                'entity' => null
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $secter = $this->secterEntityService->getOneSecterEntityById($id);
            if (!$secter)
                return Redirect::route('secters.index')->with('error', "Le secteur est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->secterEntityService->updateSecterEntity($secter, $data);

            if ($result)
                return Redirect::route('secters.index')->with('success', "Le secteur est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', "Une erreur technique est survenue pendant la modification de l'entité");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $secter = $this->secterEntityService->getOneSecterEntityById($id);
            if (!$secter)
                return Redirect::route('secters.index')->with('error', "Le secteur est introuvable");

            $result = $this->secterEntityService->deleteSecterEntity($secter);
            if ($result)
                return Redirect::route('secters.index')->with('success', "Le secteur est supprimé avec succès !");
            else
                return Redirect::route('secters.index')->with('error', "Une erreur technique est survenue pendant la suppression d'entité ");


        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', $exception->getMessage());
        }
    }

    public function secteurs(string $entity_id) {
        try {

            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getSectersByEntity($entity_id, $this->pages);
            $entity = $this->entityService->getOneEntityById($entity_id);

            return view("entities.secters.index", [
                'entities' => $entities,
                'secters' => $secters,
                'editedSecter' => null,
                'id'         => null,
                'url'        => 'secters.store',
                'title'      => "Nouveau Secteur",
                'entity'    => $entity
            ]);

        }catch (\Exception $exception) {

        }
    }

    public function import(Request $request) {
        try {

            if ($request->hasFile('file')) {

                $request->validate([
                    'file' => 'required|file|mimes:xlsx,csv,xls'
                ]);

                $data['entity_id'] = $request->get('entity_id');

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                foreach ($rows[0] as $rr) {
                    $data['title'] = $rr[0];

                    $this->secterEntityService->createNewSecterEntity($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('secters.index')->with('success', "Nouveaux secteurs ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('secters.index')->with('error', "Nouveaux secteurs ajouté ".$count."/".count($rows[0])." !");
                }

            }else{
                return Redirect::route('secters.index')->with('error', "Merci de spécifier le fichier excel contenant les secteurs");
            }

        }catch (\Exception $exception) {
            return Redirect::route('secters.index')->with('error', "Une erreur technique est survenue pendant la création des secteurs");
        }
    }
}
