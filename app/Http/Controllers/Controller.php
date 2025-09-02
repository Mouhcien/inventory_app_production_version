<?php

namespace App\Http\Controllers;

use App\Exports\ConsummationExport;
use App\Exports\InventoryExport;
use App\Exports\InventoryPhotocopyExport;
use App\Exports\MaterialExport;
use App\Exports\ShortStockConsumable;
use App\Exports\StockConsumableExport;
use App\Services\Furniture\ConsummationService;
use App\Services\Furniture\StockService;
use App\Services\InventoryPhotocopyService;
use App\Services\InventoryService;
use App\Services\Material\MaterialService;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;

abstract class Controller
{

    public function exportMaterials(MaterialService $materialService, $filter=null, $value=null) {
        try {

            if (session()->has('materials_filtered')) {
                $materials = session()->get('materials_filtered');
                session()->forget('materials_filtered');
            }else {
                switch ($filter) {
                    case 'type':
                        $materials = $materialService->filterMaterial('type', $value, 0);
                        break;
                    case 'brand':
                        $materials = $materialService->filterMaterial('brand', $value, 0);
                        break;
                    case 'model':
                        $materials = $materialService->filterMaterial('model', $value, 0);
                        break;
                    case 'march':
                        $materials = $materialService->filterMaterial('march', $value, 0);
                        break;
                    case 'delivery':
                        $materials = $materialService->filterMaterial('delivery', $value, 0);
                        break;
                    case 'state':
                        $materials = $materialService->filterMaterial('state', $value, 0);
                        break;
                    default:
                        $materials = $materialService->getAllMaterials(0);
                        break;
                }
            }

            //['Série', 'Type', 'Modèle', 'Marque', 'Marché', 'N° Inventaire', 'IP', 'Etats', 'Déployé', 'Réformé', 'Obsérvations'];

            $materialData = [];
            $data = [];
            foreach ($materials as $material) {
                $materialData[0] = $material->serial;
                $materialData[1] = $material->delivery_material->model_material->type_material->title;
                $materialData[2] = $material->delivery_material->model_material->title;
                $materialData[3] = $material->delivery_material->model_material->brand_material->title ?? "";
                $materialData[4] = $material->delivery_material->march_material->title;
                $materialData[5] = $material->inventory_number;
                $materialData[6] = $material->ip;
                if ($material->state == 1)
                    $materialData[7] = "Opérationnel";
                elseif ($material->state == -1)
                    $materialData[7] = "En Panne";
                elseif ($material->state == -2)
                    $materialData[7] = "En Casse";
                $materialData[8] = $material->is_deployed ? 'OUI' : 'NON';
                $materialData[9] = $material->is_reform ? 'OUI' : 'NON';
                $materialData[10] = "";
                if(count($material->observations_material) != 0) {
                    $observations_object = "";
                    foreach ($material->observations_material as $observation) {
                        $observations_object .= "[".$observation->object."]".$observation->object." - ";
                    }
                    $materialData[10] = $observations_object;
                }
                $data[] = $materialData;
            }
            //dd($data);
            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new MaterialExport($data), 'liste_materials_'.$current_date.'.xlsx');

        }catch (\Exception $exception) {

        }
    }

    public function exportInventoryMaterials(InventoryService $inventoryService, $filter=null, $value=null) {
        try {

            //['Série', 'Type', 'Modèle', 'Marque', 'Marché', 'N° Inventaire','Utilisateur', 'Service', 'Entité', 'Secteur', 'Section', 'Local' 'IP', 'Etats', 'Déployé', 'Réformé', 'Obsérvations']

            if (session()->has('inventories_filtered')) {
                $inventories = session()->get('inventories_filtered');
                session()->forget('inventories_filtered');
            }else {

                if (is_null($filter))
                    $inventories = $inventoryService->getAllInventories(0);
                else {
                    if (is_null($value)) {
                        $inventories = $inventoryService->getAllInventoriesByFilter($filter, 0);
                    } else {
                        switch ($filter) {
                            case 'type':
                                $inventories = $inventoryService->getAllInventoriesByType($value, 0);
                                break;
                            case 'brand':
                                $inventories = $inventoryService->getAllInventoriesByBrand($value, 0);
                                break;
                            case 'march':
                                $inventories = $inventoryService->getAllInventoriesByMarch($value, 0);
                                break;
                            case 'model':
                                $inventories = $inventoryService->getAllInventoriesByModel($value, 0);
                                break;
                        }
                    }
                }
            }

            $materialData = [];
            $data = [];
            foreach ($inventories as $inventory) {
                $materialData[0] = $inventory->material->serial;
                $materialData[1] = $inventory->material->delivery_material->model_material->type_material->title;
                $materialData[2] = $inventory->material->delivery_material->model_material->title;
                $materialData[3] = $inventory->material->delivery_material->model_material->brand_material->title ?? "";
                $materialData[4] = $inventory->material->delivery_material->march_material->title;
                $materialData[5] = $inventory->material->inventory_number;
                $materialData[6] = $inventory->employee->firstname." ".$inventory->employee->lastname;
                $materialData[7] = $inventory->employee->service_entity->title;
                $materialData[8] = $inventory->employee->entity ? $inventory->employee->entity->title : '';
                $materialData[9] = $inventory->employee->secter_entity ? $inventory->employee->secter_entity->title : '';
                $materialData[10] = $inventory->employee->section_entity ? $inventory->employee->section_entity->title : '';
                $materialData[11] = $inventory->employee->local->title;
                $materialData[12] = $inventory->material->ip;
                if ($inventory->material->state == 1)
                    $materialData[13] = "Opérationnel";
                elseif ($inventory->material->state == -1)
                    $materialData[13] = "En Panne";
                elseif ($inventory->material->state == -2)
                    $materialData[13] = "En Casse";
                $materialData[14] = $inventory->material->is_deployed ? 'OUI' : 'NON';
                $materialData[15] = $inventory->material->is_reform ? 'OUI' : 'NON';
                $materialData[16] = "";
                if(count($inventory->material->observations_material) != 0) {
                    $observations_object = "";
                    foreach ($inventory->material->observations_material as $observation) {
                        $observations_object .= "[".$observation->object."]".$observation->object." - ";
                    }
                    $materialData[16] = $observations_object;
                }
                $data[] = $materialData;
            }
            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new InventoryExport($data), 'inventaire_materials_'.$current_date.'.xlsx');

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function exportConsummations(ConsummationService $consummationService, $filter=null, $value=null) {
        try {

            //['Consommable', 'Type', 'Employé', 'Service', 'Entité', 'Secteur', 'Section', 'Local', 'Quantité', 'Date de demande']

            if (session()->has('consummations_filtered')) {
                $consummations = session()->get('consummations_filtered');
                session()->forget('consummations_filtered');
            }else {

                if (is_null($filter))
                    $consummations = $consummationService->getAllConsummations(0);
                else {
                    $consummations = $consummationService->getAllConsummationsByFilter($filter, $value, 0);
                }
            }

            $consummationData = [];
            $data = [];
            foreach ($consummations as $consummation) {
                $consummationData[0] = $consummation->stock_consumable->consumable->ref;
                $consummationData[1] = $consummation->stock_consumable->consumable->type_consumable->title;
                $consummationData[2] = $consummation->employee->firstname." ".$consummation->employee->lastname;
                $consummationData[3] = $consummation->employee->service_entity->title;
                $consummationData[4] = $consummation->employee->entity ? $consummation->employee->entity->title : '';
                $consummationData[5] = $consummation->employee->secter_entity ? $consummation->employee->secter_entity->title : '';
                $consummationData[6] = $consummation->employee->section_entity ? $consummation->employee->section_entity->title : '';
                $consummationData[7] = $consummation->employee->local->title;
                $consummationData[8] = $consummation->quantity_required;
                $consummationData[9] = \Carbon\Carbon::parse($consummation->consummation_date)->format('d/m/Y');

                $data[] = $consummationData;
            }
            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new ConsummationExport($data), 'liste_consommations'.$current_date.'.xlsx');

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function exportStockConsumables(StockService $stockService, $filter=null, $value=null) {
        try {

            //['Consommable', 'Type', 'Equipements', 'Quantité livré', 'Quantité resté', 'Date de livraison']

            if (session()->has('stock_filtered')) {
                $stocks = session()->get('stock_filtered');
                session()->forget('stock_filtered');
            }else {

                if (is_null($filter))
                    $stocks = $stockService->getAllStockConsumables(0);
                else {
                    $stocks = $stockService->getAllStockConsumablesByFilter($filter, $value, 0);
                }
            }

            $stockData = [];
            $data = [];
            foreach ($stocks as $stock) {
                $stockData[0] = $stock->consumable->ref;
                $stockData[1] = $stock->consumable->type_consumable->title;
                $model = "";
                foreach ($stock->consumable->fittings as $fitting) {
                    $model .= $fitting->model_material->title." [ ".$fitting->model_material->type_material->title." ] -- ";
                }
                $stockData[2] = $model;
                $stockData[3] = $stock->quantity_received;
                $stockData[4] = $stock->quantity_reset;
                $stockData[5] = \Carbon\Carbon::parse($stock->delivery->delivery_date)->format('d/m/Y');

                $data[] = $stockData;
            }
            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new StockConsumableExport($data), 'stock_fournitures'.$current_date.'.xlsx');

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function exportShortStockConsumables(StockService $stockService, $filter=null, $value=null) {
        try {

            //['Consommable', 'Type', 'Quantité livré', 'Quantité resté']

            if (is_null($filter))
                $stocks = $stockService->allTotalExistingStock(null, null,0);
            else {
                $stocks = $stockService->allTotalExistingStock($filter, $value,0);
            }

            $stockData = [];
            $data = [];
            foreach ($stocks as $stock) {
                $stockData[0] = $stock->ref;
                $stockData[1] = $stock->type;
                $stockData[2] = $stock->quantity_received;
                $stockData[3] = $stock->quantity_rest;

                $data[] = $stockData;
            }
            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new ShortStockConsumable($data), 'stock_fournitures'.$current_date.'.xlsx');

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function exportInventoryPhotocopy(InventoryPhotocopyService $inventoryPhotocopyService, MaterialService $materialService, $option=null) {
        try {

            //['Série', 'Type', 'Modèle', 'Marque', 'Marché', 'N° Inventaire', 'Service', 'Entité', 'Secteur', 'Section', 'Local' 'IP', 'Etats', 'Déployé', 'Réformé', 'Obsérvations']

            $materialData = [];
            $data = [];

            if ($option != null){
                $inventories = $materialService->getPhotocopiesNotAffectedToUser(0);

                foreach ($inventories as $inventory) {
                    $materialData[0] = $inventory->serial;
                    $materialData[1] = $inventory->delivery_material->model_material->type_material->title;
                    $materialData[2] = $inventory->delivery_material->model_material->title;
                    $materialData[3] = $inventory->delivery_material->model_material->brand_material->title ?? "";
                    $materialData[4] = $inventory->delivery_material->march_material->title;
                    $materialData[5] = $inventory->inventory_number;
                    $materialData[6] = "";
                    $materialData[7] = "";
                    $materialData[8] = "";
                    $materialData[9] = "";
                    $materialData[10] = "";
                    $materialData[11] = $inventory->ip;
                    if ($inventory->state == 1)
                        $materialData[12] = "Opérationnel";
                    elseif ($inventory->state == -1)
                        $materialData[12] = "En Panne";
                    elseif ($inventory->state == -2)
                        $materialData[12] = "En Casse";
                    $materialData[13] = $inventory->is_deployed ? 'OUI' : 'NON';
                    $materialData[14] = $inventory->is_reform ? 'OUI' : 'NON';
                    $materialData[15] = "";
                    if(count($inventory->observations_material) != 0) {
                        $observations_object = "";
                        foreach ($inventory->observations_material as $observation) {
                            $observations_object .= "[".$observation->object."]".$observation->object." - ";
                        }
                        $materialData[16] = $observations_object;
                    }
                    $data[] = $materialData;
                }

            } else {
                $inventories = $inventoryPhotocopyService->getAllInventories(0);

                foreach ($inventories as $inventory) {
                    $materialData[0] = $inventory->material->serial;
                    $materialData[1] = $inventory->material->delivery_material->model_material->type_material->title;
                    $materialData[2] = $inventory->material->delivery_material->model_material->title;
                    $materialData[3] = $inventory->material->delivery_material->model_material->brand_material->title ?? "";
                    $materialData[4] = $inventory->material->delivery_material->march_material->title;
                    $materialData[5] = $inventory->material->inventory_number;
                    $materialData[6] = $inventory->service_entity->title;
                    $materialData[7] = $inventory->entity ? $inventory->entity->title : '';
                    $materialData[8] = $inventory->secter_entity ? $inventory->secter_entity->title : '';
                    $materialData[9] = $inventory->section_entity ? $inventory->section_entity->title : '';
                    $materialData[10] = $inventory->local->title;
                    $materialData[11] = $inventory->material->ip;
                    if ($inventory->material->state == 1)
                        $materialData[12] = "Opérationnel";
                    elseif ($inventory->material->state == -1)
                        $materialData[12] = "En Panne";
                    elseif ($inventory->material->state == -2)
                        $materialData[12] = "En Casse";
                    $materialData[13] = $inventory->material->is_deployed ? 'OUI' : 'NON';
                    $materialData[14] = $inventory->material->is_reform ? 'OUI' : 'NON';
                    $materialData[15] = "";
                    if(count($inventory->material->observations_material) != 0) {
                        $observations_object = "";
                        foreach ($inventory->material->observations_material as $observation) {
                            $observations_object .= "[".$observation->object."]".$observation->object." - ";
                        }
                        $materialData[16] = $observations_object;
                    }
                    $data[] = $materialData;
                }
            }



            $date = new DateTime();
            $current_date =  $date->format('Y-m-d H:i:s');
            return Excel::download(new InventoryPhotocopyExport($data), 'inventaire_photocopies_'.$current_date.'.xlsx');

        }catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

}
