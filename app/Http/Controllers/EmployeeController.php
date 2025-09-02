<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use App\Services\Employee\EntityService;
use App\Services\Employee\SecterEntityService;
use App\Services\Employee\SectionEntityService;
use App\Services\Employee\ServiceEntityService;
use App\Services\Furniture\ConsummationService;
use App\Services\InventoryService;
use App\Services\Local\LocalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    private int $pages = 10;
    private EmployeeService $employeeService;
    private ServiceEntityService $serviceEntityService;
    private LocalService $localService;
    private EntityService $entityService;
    private SecterEntityService $secterEntityService;
    private SectionEntityService $sectionEntityService;
    private InventoryService $inventoryService;
    private ConsummationService $consummationService;
    private array $rules = [
        'ppr' => 'required|max:255',
        'lastname' => 'required|max:255',
        'firstname' => 'required|max:255',
        'local_id' => 'required'
    ];

    /**
     * @param EmployeeService $employeeService
     */
    public function __construct(EmployeeService $employeeService,
                                ServiceEntityService $serviceEntityService,
                                LocalService $localService,
                                EntityService $entityService,
                                SecterEntityService $secterEntityService,
                                SectionEntityService $sectionEntityService,
                                InventoryService $inventoryService,
                                ConsummationService $consummationService)
    {
        $this->employeeService = $employeeService;
        $this->serviceEntityService = $serviceEntityService;
        $this->localService = $localService;
        $this->entityService = $entityService;
        $this->secterEntityService = $secterEntityService;
        $this->sectionEntityService = $sectionEntityService;
        $this->inventoryService = $inventoryService;
        $this->consummationService = $consummationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $employees = $this->employeeService->getAllEmployees($this->pages);
            return view("employees.index", [
                'employees'      => $employees,
                'total' => $employees->total()
            ]);

        }catch (\Exception $exception) {

        }
    }

    public function create(Request $request)
    {

        try {

            $service_entity_id = null;
            $entity_id = null;

            $services = $this->serviceEntityService->getAllServiceEntities(0);
            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities(0);
            $locals = $this->localService->getAllLocals(0);

            if ($request->query()) {
                if ($request->has('srv')) {
                    $service_entity_id = $request->query('srv');
                    $entities = $this->entityService->getAllEntitiesByService($service_entity_id, 0);
                    $secters = $this->secterEntityService->getSectersByService($service_entity_id, 0);
                    $sections = $this->sectionEntityService->getSectionsByService($service_entity_id, 0);

                }

                if ($request->has('ent')) {
                    $entity_id = $request->query('ent');
                    $secters = $this->secterEntityService->getSectersByEntity($entity_id, 0);
                    $sections = $this->sectionEntityService->getSectionsByEntity($entity_id, 0);

                }
            }

            return view("employees.create", [
                'services' => $services,
                'entities' => $entities,
                'secters' => $secters,
                'sections' => $sections,
                'locals' => $locals,
                'editedEmployee' => null,
                'service_entity_id' => $service_entity_id,
                'entity_id' => $entity_id
            ]);
        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', "Une erreur technique est survenue pendant la création de l'employée");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $data = $request->validate($this->rules);

            $data['email'] = $request->get('email');
            $data['tel'] = $request->get('tel');

            $data['service_entity_id'] = null;
            $data['entity_id'] = null;
            $data['secter_entity_id'] = null;
            $data['section_entity_id'] = null;

            $section_id = $request->get('section_entity_id');
            $secter_id = $request->get('secter_entity_id');
            $entity_id = $request->get('entity_id');
            $service_id = $request->get('service_entity_id');


            if ($service_id != 0)
                $data['service_entity_id'] = $service_id;

            if ($entity_id != 0)
                $data['entity_id'] = $entity_id;

            if ($section_id != 0) {
                $section = $this->sectionEntityService->getOneSectionEntityById($section_id);
                $data['service_entity_id'] = $section->entity->service_entity->id;
                $data['entity_id'] = $section->entity->id;
                $data['section_entity_id'] = $section_id;
            }

            if ($secter_id != 0) {
                $secter = $this->secterEntityService->getOneSecterEntityById($secter_id);
                $data['service_entity_id'] = $secter->entity->service_entity->id;
                $data['entity_id'] = $secter->entity->id;
                $data['secter_entity_id'] = $secter_id;
            }

            $result     = $this->employeeService->createNewEmployee($data);

            if ($result)
                return Redirect::route('employees.index')->with('success', "Le nouveau employée est ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', "Une erreur technique est survenue pendant la création de l'employée [".$exception->getMessage()."]");
        }
    }

    public function prepare(Request $request) {

        try {

            $service_entity_id = null;
            $entity_id = null;
            $local_id = null;

            $services = $this->serviceEntityService->getAllServiceEntities(0);
            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities(0);
            $locals = $this->localService->getAllLocals(0);

            if ($request->query()) {
                if ($request->has('srv')) {
                    $service_entity_id = $request->query('srv');
                    $entities = $this->entityService->getAllEntitiesByService($service_entity_id, 0);
                    $secters = $this->secterEntityService->getSectersByService($service_entity_id, 0);
                    $sections = $this->sectionEntityService->getSectionsByService($service_entity_id, 0);
                }

                if ($request->has('ent')) {
                    $entity_id = $request->query('ent');
                    $secters = $this->secterEntityService->getSectersByEntity($entity_id, 0);
                    $sections = $this->sectionEntityService->getSectionsByEntity($entity_id, 0);

                }

                if ($request->has('loc')) {
                    $local_id = $request->query('loc');
                }

            }

            return view("employees.prepare", [
                'services' => $services,
                'entities' => $entities,
                'secters' => $secters,
                'sections' => $sections,
                'locals' => $locals,
                'editedEmployee' => null,
                'service_entity_id' => $service_entity_id,
                'entity_id' => $entity_id,
                'local_id' => $local_id
            ]);
        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', "Une erreur technique est survenue pendant la création de l'employée");
        }

    }

    public function import(Request $request) {

        $data['service_entity_id'] = null;
        $data['entity_id'] = null;
        $data['secter_entity_id'] = null;
        $data['section_entity_id'] = null;

        $section_id = $request->get('section_entity_id');
        $secter_id = $request->get('secter_entity_id');
        $entity_id = $request->get('entity_id');
        $service_id = $request->get('service_entity_id');
        $local_id = $request->get('local_id');

        if ($service_id != 0)
            $data['service_entity_id'] = $service_id;

        if ($entity_id != 0)
            $data['entity_id'] = $entity_id;

        if ($section_id != 0) {
            $section = $this->sectionEntityService->getOneSectionEntityById($section_id);
            $data['service_entity_id'] = $section->entity->service_entity->id;
            $data['entity_id'] = $section->entity->id;
            $data['section_entity_id'] = $section_id;
        }

        if ($secter_id != 0) {
            $secter = $this->secterEntityService->getOneSecterEntityById($secter_id);
            $data['service_entity_id'] = $secter->entity->service_entity->id;
            $data['entity_id'] = $secter->entity->id;
            $data['secter_entity_id'] = $secter_id;
        }

        $data['local_id'] = $local_id;


        if ($request->hasFile('file')) {

            $request->validate([
                'file' => 'required|file|mimes:xlsx,csv,xls'
            ]);

            // Read data into array
            $rows = Excel::toArray([], $request->file('file'));

            $count = 0;
            foreach ($rows[0] as $rr) {
                $data['ppr']        = $rr[0];
                $data['firstname']  = $rr[1];
                $data['lastname']   = $rr[2];
                $data['email']      = $rr[3] ?? null;
                $data['tel']        = $rr[4] ?? null;

                $this->employeeService->createNewEmployee($data);
                $count++;
            }

            if ($count == count($rows[0])) {
                return Redirect::route('employees.index')->with('success', "Nouvealles employées sont ajoutés avec succès  ".$count."/".count($rows[0])." !");
            }else{
                return Redirect::route('employees.index')->with('error', "Nouvealles employées ajouté ".$count."/".count($rows[0])." !");
            }

        }else{
            return Redirect::route('employee.prepare')->with('error', "Merci de spécifier le fichier excel contenant les matériels");
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $employee = $this->employeeService->getOneEmployeeById($id);
            $inventories = $this->inventoryService->getAllInventoryByEmployee($id);
            $consummations = $this->consummationService->getAllConsummationsByFilter('employee', $id, $this->pages);
            if (!$employee)
                return Redirect::route('employees.index')->with('error', "L'employée est introuvable");

            return view('employees.show', [
                'employee' => $employee,
                'inventories' => $inventories,
                'consummations' => $consummations
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id, string $cat)
    {
        try {
            $services = $this->serviceEntityService->getAllServiceEntities(0);
            $entities = $this->entityService->getAllEntities(0);
            $secters = $this->secterEntityService->getAllSecterEntities(0);
            $sections = $this->sectionEntityService->getAllSectionEntities(0);
            $locals = $this->localService->getAllLocals(0);
            $service_entity_id = null;
            $entity_id = null;

            $employee  = $this->employeeService->getOneEmployeeById($id);

            if ($cat == 'person') {
                return view("employees.edit-pers", [
                    'editedEmployee' => $employee,
                    'locals' => $locals,
                    'cat' => 'person'
                ]);

            }elseif($cat == 'prof') {

                if ($request->query()) {

                    if ($request->has('srv')) {
                        $service_entity_id = $request->query('srv');
                        $entities = $this->entityService->getAllEntitiesByService($service_entity_id, 0);
                        $secters = $this->secterEntityService->getSectersByService($service_entity_id, 0);
                        $sections = $this->sectionEntityService->getSectionsByService($service_entity_id, 0);

                    }

                    if ($request->has('ent')) {
                        $entity_id = $request->query('ent');
                        $secters = $this->secterEntityService->getSectersByEntity($entity_id, 0);
                        $sections = $this->sectionEntityService->getSectionsByEntity($entity_id, 0);
                    }
                }

                return view("employees.edit-prof", [
                    'editedEmployee' => $employee,
                    'services' => $services,
                    'entities' => $entities,
                    'secters' => $secters,
                    'sections' => $sections,
                    'cat' => 'prof',
                    'service_entity_id' => $service_entity_id,
                    'entity_id' => $entity_id,
                ]);
            }





        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, string $cat)
    {
        try {
            $employee = $this->employeeService->getOneEmployeeById($id);
            if (!$employee)
                return Redirect::route('employees.index')->with('error', "L'employée est introuvable");

            if ($cat == "person") {
                $data               = $request->validate($this->rules);
                $data['email']      = $request->get('email');
                $data['tel']        = $request->get('tel');
                $data['situation']  = $request->get('employee_situation');
                $result             = $this->employeeService->updateEmployeePersonnelInfo($employee, $data);
            }elseif ($cat = "prof") {

                $data = array();

                $section_id = $request->get('section_entity_id');
                $secter_id = $request->get('secter_entity_id');
                $entity_id = $request->get('entity_id');
                $service_id = $request->get('service_entity_id');


                if ($service_id != 0)
                    $data['service_entity_id'] = $service_id;

                if ($entity_id != 0)
                    $data['entity_id'] = $entity_id;

                if ($section_id != 0) {
                    $section = $this->sectionEntityService->getOneSectionEntityById($section_id);
                    $data['service_entity_id'] = $section->entity->service_entity->id;
                    $data['entity_id'] = $section->entity->id;
                    $data['section_entity_id'] = $section_id;
                    $data['secter_entity_id'] = null;
                }else{
                    $data['section_entity_id'] = null;
                    $data['secter_entity_id'] = null;
                }

                if ($secter_id != 0) {
                    $secter = $this->secterEntityService->getOneSecterEntityById($secter_id);
                    $data['service_entity_id'] = $secter->entity->service_entity->id;
                    $data['entity_id'] = $secter->entity->id;
                    $data['secter_entity_id'] = $secter_id;
                    $data['section_entity_id'] = null;
                }else{
                    $data['section_entity_id'] = null;
                    $data['secter_entity_id'] = null;
                }
                $result     = $this->employeeService->updateEmployeeProfInfo($employee, $data);
            }

            if ($result)
                return Redirect::route('employees.index')->with('success', "Le service est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('employees.edit', ['employee' => $id, 'cat' => $cat])->with('error', "Une erreur technique est survenue pendant la modification du service");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $employee = $this->employeeService->getOneEmployeeById($id);
            if (!$employee)
                return Redirect::route('employees.index')->with('error', "L'employée est introuvable");

            $result = $this->employeeService->deleteEmployee($employee);
            if ($result)
                return Redirect::route('employees.index')->with('success', "Le service est supprimé avec succès !");
            else
                return Redirect::route('employees.index')->with('error', "Une erreur technique est survenue pendant la suppression du service ");


        }catch (\Exception $exception) {
            return Redirect::route('employees.index')->with('error', $exception->getMessage());
        }
    }

    public function search(Request $request) {

        $selectedLocal = null;
        $selectedService = null;
        $selectedEntity = null;
        $selectedSecter = null;
        $selectedSection = null;
        $filterValue = null;
        $employees = null;
        $selectedSituation = null;

        $services = $this->serviceEntityService->getAllServiceEntities(0);
        $entities = $this->entityService->getAllEntities(0);
        $secters = $this->secterEntityService->getAllSecterEntities(0);
        $sections = $this->sectionEntityService->getAllSectionEntities(0);
        $locals = $this->localService->getAllLocals(0);

        if ($request->has('fltr')) {
            $filterValue = $request->query('fltr');
            $employees = $this->employeeService->getAllEmployeeByFilter($filterValue, $this->pages);
        }

        if ($request->has('loc')) {
            $selectedLocal = $request->query('loc');
            $employees = $this->employeeService->getAllEmployeeByLocal($selectedLocal, $this->pages);
        }

        if ($request->has('srv')) {
            $selectedService = $request->query('srv');
            $employees = $this->employeeService->getAllEmployeeByService($selectedService, $this->pages);
            $entities = $this->entityService->getAllEntitiesByService($selectedService, 0);
            $secters = $this->secterEntityService->getSectersByService($selectedService, 0);
            $sections = $this->sectionEntityService->getSectionsByService($selectedService, 0);
        }

        if ($request->has('ent')) {
            $selectedEntity = $request->query('ent');
            $employees = $this->employeeService->getAllEmployeeByEentity($selectedEntity, $this->pages);
            $entities = $this->entityService->getAllEntitiesByService($selectedService, 0);
            $secters = $this->secterEntityService->getSectersByEntity($selectedEntity, 0);
            $sections = $this->sectionEntityService->getSectionsByEntity($selectedEntity, 0);
        }

        if ($request->has('sectr')) {
            $selectedSecter = $request->query('sectr');
            $employees = $this->employeeService->getAllEmployeeBySecter($selectedSecter, $this->pages);
        }

        if ($request->has('sect')) {
            $selectedSection = $request->query('sect');
            $employees = $this->employeeService->getAllEmployeeBySection($selectedSection, $this->pages);
        }

        if ($request->has('sit')) {
            $selectedSituation = $request->query('sit');
            $employees = $this->employeeService->getAllEmployeeBySituation($selectedSituation, $this->pages);
        }

        return view('employees.search', [
            'services' => $services,
            'entities' => $entities,
            'secters' => $secters,
            'sections' => $sections,
            'locals' => $locals,
            'selectedLocal' => $selectedLocal,
            'selectedService' => $selectedService,
            'selectedEntity' => $selectedEntity,
            'selectedSecter' => $selectedSecter,
            'selectedSection' => $selectedSection,
            'filterValue' => $filterValue,
            'employees' => $employees
        ]);
    }
}
