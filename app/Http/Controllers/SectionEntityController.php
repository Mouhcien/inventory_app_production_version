<?php

namespace App\Http\Controllers;

use App\Services\Employee\EntityService;
use App\Services\Employee\SectionEntityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SectionEntityController extends Controller
{
    private int $pages = 10;
    private EntityService $entityService;
    private SectionEntityService $sectionEntityService;
    private array $rules = [
        'title'             => 'required|max:255',
        'entity_id'    => 'required'
    ];

    /**
     * @param EntityService $sectionEntityService
     */
    public function __construct(EntityService $entityService,
                                SectionEntityService $sectionEntityService)
    {
        $this->sectionEntityService = $sectionEntityService;
        $this->entityService = $entityService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $entities = $this->entityService->getAllEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities($this->pages);
            return view("entities.sections.index", [
                'entities' => $entities,
                'sections' => $sections,
                'editedSection' => null,
                'id'         => null,
                'url'        => 'sections.store',
                'title'      => "Nouvelle Section",
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
            $result     = $this->sectionEntityService->createNewSectionEntity($data);

            if ($result) {
                if ($request->has('operation'))
                    return Redirect::route('sections.sections', $data['entity_id'])->with('success', "La nouvelle section est ajouté avec succès !");

                return Redirect::route('sections.index')->with('success', "La nouvelle section est ajouté avec succès !");
            }

        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', "Une erreur technique est survenue pendant la création de la section [".$exception->getMessage()."]");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $section = $this->sectionEntityService->getOneSectionEntityById($id);
            if (!$section)
                return Redirect::route('sections.index')->with('error', "La section est introuvable");

            return view('entities.sections.show')->with('section', $section);

        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $section  = $this->sectionEntityService->getOneSectionEntityById($id);
            $entities = $this->entityService->getAllEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities($this->pages);
            return view("entities.sections.index", [
                'entities'       => $entities,
                'sections'       => $sections,
                'editedSection'  => $section,
                'id'            => $id,
                'url'            => "sections.update",
                'title'         => "Modifier la section",
                'entity' => null
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $section = $this->sectionEntityService->getOneSectionEntityById($id);
            if (!$section)
                return Redirect::route('sections.index')->with('error', "La section est introuvable");

            $data       = $request->validate($this->rules);
            $result     = $this->sectionEntityService->updateSectionEntity($section, $data);

            if ($result)
                return Redirect::route('sections.index')->with('success', "La section est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', "Une erreur technique est survenue pendant la modification de l'entité");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $section = $this->sectionEntityService->getOneSectionEntityById($id);
            if (!$section)
                return Redirect::route('sections.index')->with('error', "La section est introuvable");

            $result = $this->sectionEntityService->deleteSectionEntity($section);
            if ($result)
                return Redirect::route('sections.index')->with('success', "La section est supprimé avec succès !");
            else
                return Redirect::route('sections.index')->with('error', "Une erreur technique est survenue pendant la suppression d'entité ");


        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', $exception->getMessage());
        }
    }

    public function sections(string $entity_id) {
        try {

            $entities = $this->entityService->getAllEntities(0);
            $sections = $this->sectionEntityService->getSectionsByEntity($entity_id, $this->pages);
            $entity = $this->entityService->getOneEntityById($entity_id);

            return view("entities.sections.index", [
                'entities' => $entities,
                'sections' => $sections,
                'editedSection' => null,
                'id'         => null,
                'url'        => 'sections.store',
                'title'      => "Nouvelle section",
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

                $data['entity_id']     = $request->get('entity_id');

                // Read data into array
                $rows = Excel::toArray([], $request->file('file'));

                $count = 0;
                foreach ($rows[0] as $rr) {
                    $data['title'] = $rr[0];

                    $this->sectionEntityService->createNewSectionEntity($data);
                    $count++;
                }

                if ($count == count($rows[0])) {
                    return Redirect::route('sections.index')->with('success', "Nouvelles sections ajouté avec succès  ".$count."/".count($rows[0])." !");
                }else{
                    return Redirect::route('sections.index')->with('error', "Nouvelles sections ajouté ".$count."/".count($rows[0])." !");
                }

            }else{
                return Redirect::route('sections.index')->with('error', "Merci de spécifier le fichier excel contenant les sections");
            }

        }catch (\Exception $exception) {
            return Redirect::route('sections.index')->with('error', "Une erreur technique est survenue pendant la création des sections");
        }
    }
}
