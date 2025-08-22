<?php

namespace App\Http\Controllers;

use App\Services\Employee\EmployeeService;
use App\Services\Employee\EntityService;
use App\Services\Employee\SecterEntityService;
use App\Services\Employee\SectionEntityService;
use App\Services\Employee\ServiceEntityService;
use App\Services\Furniture\ConsumableService;
use App\Services\Furniture\ConsummationService;
use App\Services\Furniture\StockService;
use App\Services\Furniture\TypeConsumableService;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;

class ConsummationController extends Controller
{

    private int $pages = 10;
    private ConsumableService $consumableService;
    private ConsummationService $consummationService;
    private EmployeeService $employeeService;
    private TypeConsumableService $typeConsumableService;
    private StockService $stockService;
    private array $rules = [
        'stock_consumable_id' => 'required',
        'employee_id' => 'required',
        'quantity_required' => 'required'
    ];

    /**
     * @param ConsummationService $consummationService
     */
    public function __construct(ConsumableService $consumableService,
                                ConsummationService $consummationService,
                                EmployeeService $employeeService,
                                TypeConsumableService $typeConsumableService,
                                StockService $stockService
    )
    {
        $this->consumableService = $consumableService;
        $this->employeeService = $employeeService;
        $this->consummationService = $consummationService;
        $this->typeConsumableService = $typeConsumableService;
        $this->stockService = $stockService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $types = $this->typeConsumableService->getAllConsumableTypes(0);
            $consumables = $this->consumableService->getAllConsumables(0);
            $employees = $this->consummationService->getAllEmployeesFromConsummations(0);
            $consummations = $this->consummationService->getAllConsummations($this->pages);
            $services = $this->consummationService->getAllServicesFromConsummations(0);
            $entities = $this->consummationService->getAllEntitiesFromConsummations(0);
            $secters = $this->consummationService->getAllSectersFromConsummations(0);
            $sections = $this->consummationService->getAllSectionsFromConsummations(0);
            $locals = $this->consummationService->getAllLocalsFromConsummations(0);

            return view("funitures.consummations.index", [
                'types' => $types,
                'consumables' => $consumables,
                'employees' => $employees,
                'consummations' => $consummations,
                'services' => $services,
                'entities' => $entities,
                'secters' => $secters,
                'sections' => $sections,
                'locals' => $locals,
                'filter' => null,
                'value' => null,
            ]);

        }catch (\Exception $exception) {

        }
    }

    public function filter($filter, $value) {

        $consummations = $this->consummationService->getAllConsummationsByFilter($filter, $value, $this->pages);

        $types = $this->typeConsumableService->getAllConsumableTypes(0);
        $consumables = $this->consumableService->getAllConsumables(0);
        $employees = $this->consummationService->getAllEmployeesFromConsummations(0);
        $services = $this->consummationService->getAllServicesFromConsummations(0);
        $entities = $this->consummationService->getAllEntitiesFromConsummations(0);
        $secters = $this->consummationService->getAllSectersFromConsummations(0);
        $sections = $this->consummationService->getAllSectionsFromConsummations(0);
        $locals = $this->consummationService->getAllLocalsFromConsummations(0);

        return view("funitures.consummations.index", [
            'types' => $types,
            'consumables' => $consumables,
            'employees' => $employees,
            'consummations' => $consummations,
            'services' => $services,
            'entities' => $entities,
            'secters' => $secters,
            'sections' => $sections,
            'locals' => $locals,
            'filter' => $filter,
            'value' => $value
        ]);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $data               = $request->validate($this->rules);
            $consummation_date  = $request->get('consummation_date');
            if (!is_null($consummation_date))
                $data['consummation_date'] = $consummation_date;
            else
                $data['consummation_date'] =  now()->toDateString();

            $result     = $this->consummationService->createNewConsummation($data);

            if ($result)
                return Redirect::route('consummations.index')->with('success', "Consommation ajouté avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consummations.index')->with('error', "Une erreur technique est survenue pendant la création de la consommation");
        }
    }

    public function create(Request $request){

        $employeeSelected = null;
        $stockSelected = null;
        $typeSelected = null;

        $consumables = null;
        $types = $this->typeConsumableService->getAllConsumableTypes(0);
        $employees = $this->employeeService->getAllEmployees(0);

        if ($request->has('emp')) {
            $employeeSelected = $this->employeeService->getOneEmployeeById($request->query('emp'));
        }

        if ($request->has('tpc')) {
            $typeSelected = $request->query('tpc');
            $consumables = $this->consumableService->getAllConsumablesByType($typeSelected, 0);
        }

        if ($request->has('cns')) {
            $stockSelected = $this->stockService->allByConsumableStillInStock($request->query('cns'), 0);
            $consumables = null;
        }

        return view('funitures.consummations.create', [
            'types' => $types,
            'employees' => $employees,
            'consumables' => $consumables,
            'employeeSelected' => $employeeSelected,
            'stockSelected' => $stockSelected,
            'typeSelected' => $typeSelected
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {

            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");

            return view('funitures.consummations.show', [
                'consummation' => $consummation
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consummations.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        try {
            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");


            return view("funitures.consummations.index", [
                'consummations'       => $consummation,
            ]);

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");

            $data   = $request->validate($this->rules);

            $result = $this->consummationService->updateConsummation($consummation, $data);

            if ($result)
                return Redirect::route('consumables.index')->with('success', "La consommation est modifié avec succès !");

        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', "Une erreur technique est survenue pendant la modification de la consommation");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");

            $result = $this->consummationService->deleteConsummation($consummation);
            if ($result)
                return Redirect::route('consummations.index')->with('success', "La consommation est supprimé avec succès !");
            else
                return Redirect::route('consummations.index')->with('error', "Une erreur technique est survenue pendant la suppression de la consommation");


        }catch (\Exception $exception) {
            return Redirect::route('consumables.index')->with('error', $exception->getMessage());
        }
    }

    public function valid(string $id)
    {

        try {

            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");

            $dataC['stock_consumable_id'] = $consummation->stock_consumable_id;
            $dataC['employee_id'] = $consummation->employee_id;
            $dataC['quantity_required'] = $consummation->quantity_required;
            $dataC['consummation_date'] = $consummation->consummation_date;
            $dataC['is_done'] = true;

            $result = $this->consummationService->updateConsummation($consummation, $dataC);
            if ($result) {
                //decrement the quantity rest
                $stock = $this->stockService->getOneStockConsumableById($consummation->stock_consumable_id);
                $data['delivery_id'] =$stock->delivery_id;
                $data['consumable_id'] =$stock->consumable_id;
                $data['quantity_received'] =$stock->quantity_received;
                $data['quantity_rest'] =$stock->quantity_rest-1;

                $resultStock = $this->stockService->updateStockConsumable($stock, $data);
                if ($result) {
                    return Redirect::route('consummations.index')->with('success', "La validation est bien faite!!");
                }else{
                    $dataC['is_done'] = false;
                    $this->consummationService->updateConsummation($consummation, $dataC);
                    return Redirect::route('consummations.index')->with('error', "Problème lors de la validation");
                }
            }

        }catch (\Exception $exception) {
            return Redirect::route('consummations.index')->with('error', $exception->getMessage());
        }
    }

    public function prepare() {

        $stocks = $this->stockService->getAllExistingStockConsumables(0);

        return view('funitures.consummations.prepare', [
            'stocks' => $stocks
        ]);
    }

    public function import(Request $request) {

        if ($request->hasFile('file')) {

            $request->validate([
                'file' => 'required|file|mimes:xlsx,csv,xls'
            ]);

            // Read data into array
            $rows = Excel::toArray([], $request->file('file'));

            $count = 0;
            foreach ($rows[0] as $rr) {
                $employee = $this->employeeService->getOneEmployeeByPPR($rr[0]);
                if (is_null($employee))
                    continue;
                $data['employee_id'] = $employee->id;
                $data['quantity_required'] = 1;
                $data['is_done'] = 1;
                $carbonDate = Carbon::createFromFormat('Y-m-d', '1900-01-01')->addDays($rr[1] - 2);
                $data['consummation_date'] =  $carbonDate->format('Y-m-d');

                $data['stock_consumable_id'] = $request->get('stock_consumable_id');

                $result = $this->consummationService->createNewConsummation($data);
                if (!is_null($result)) {
                    //decrementer la quantité existant au stock
                    $stock = $this->stockService->getOneStockConsumableById($request->get('stock_consumable_id'));
                    $data['delivery_id'] =$stock->delivery_id;
                    $data['consumable_id'] =$stock->consumable_id;
                    $data['quantity_received'] =$stock->quantity_received;
                    $data['quantity_rest'] =$stock->quantity_rest-1;

                    $this->stockService->updateStockConsumable($stock, $data);
                }
                $count++;
            }

            if ($count == count($rows[0])) {
                return Redirect::route('consummations.index')->with('success', "Nouvealles consommation sont ajoutés avec succès  ".$count."/".count($rows[0])." !");
            }else {
                return Redirect::route('consummations.index')->with('error', "Nouvealles employées ajouté " . $count . "/" . count($rows[0]) . " !");
            }

        }
    }

    public function receipt($id) {
        try {
            $consummation = $this->consummationService->getOneConsummationById($id);

            if (!$consummation)
                return Redirect::route('consummations.index')->with('error', "La consommation est introuvable");

            $data = [
                'consummation' => $consummation
            ];

            $pdf = PDF::loadView('funitures.consummations.receipt', $data)->setPaper('A4', 'landscape');

            //return $pdf->download('sample.pdf');
            return $pdf->stream();


        }catch (Exception $exception) {

        }
    }

    public function export($filter = null, $value = null) {
        try {

            return $this->exportConsummations($this->consummationService, $filter, $value);


        }catch (Exception $exception) {

        }
    }

}
