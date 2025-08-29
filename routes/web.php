<?php

use App\Http\Controllers\BrandMaterialController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ConsumableController;
use App\Http\Controllers\ConsummationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EntityController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\MarchMaterialController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ModelMaterialController;
use App\Http\Controllers\ObservationMaterialController;
use App\Http\Controllers\SecterEntityController;
use App\Http\Controllers\SectionEntityController;
use App\Http\Controllers\ServiceEntityController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TypeConsumableController;
use App\Http\Controllers\TypeEntityController;
use App\Http\Controllers\TypeMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dri');

Route::prefix("employees")->group(function() {

    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');

    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');

    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');

    Route::get('/prepare', [EmployeeController::class, 'prepare'])->name('employees.prepare');

    Route::get('/search', [EmployeeController::class, 'search'])->name('employees.search');

    Route::post('/import', [EmployeeController::class, 'import'])->name('employees.import');

    Route::get('/{employee}', [EmployeeController::class, 'show'])->name('employees.show');

    Route::post('/{employee}/{cat}', [EmployeeController::class, 'update'])->name('employees.update');

    Route::get('/{employee}/edit/{cat}', [EmployeeController::class, 'edit'])->name('employees.edit');

    Route::get('/{employee}/delete', [EmployeeController::class, 'destroy'])->name('employees.destroy');

});

Route::prefix("entities")->group(function() {

    Route::prefix("services")->group(function () {

        Route::get('/', [ServiceEntityController::class, 'index'])->name('services.index');

        Route::post('/', [ServiceEntityController::class, 'store'])->name('services.store');

        Route::post('/import', [ServiceEntityController::class, 'import'])->name('services.import');

        Route::get('/{service}', [ServiceEntityController::class, 'show'])->name('services.show');

        Route::get('/{service}/edit', [ServiceEntityController::class, 'edit'])->name('services.edit');

        Route::post('/{service}', [ServiceEntityController::class, 'update'])->name('services.update');

        Route::get('/{service}/delete', [ServiceEntityController::class, 'destroy'])->name('services.destroy');
    });

    Route::prefix("types")->group(function () {

        Route::get('/', [TypeEntityController::class, 'index'])->name('entities.types.index');

        Route::post('/', [TypeEntityController::class, 'store'])->name('entities.types.store');

        Route::get('/{type}', [TypeEntityController::class, 'show'])->name('entities.types.show');

        Route::get('/{type}/edit', [TypeEntityController::class, 'edit'])->name('entities.types.edit');

        Route::post('/{type}', [TypeEntityController::class, 'update'])->name('entities.types.update');

        Route::get('/{type}/delete', [TypeEntityController::class, 'destroy'])->name('entities.types.destroy');
    });

    Route::prefix("secteurs")->group(function () {

        Route::get('/', [SecterEntityController::class, 'index'])->name('secters.index');

        Route::post('/', [SecterEntityController::class, 'store'])->name('secters.store');

        Route::post('/import', [SecterEntityController::class, 'import'])->name('secters.import');

        Route::get('/{secter}', [SecterEntityController::class, 'show'])->name('secters.show');

        Route::get('/{secter}/edit', [SecterEntityController::class, 'edit'])->name('secters.edit');

        Route::post('/{secter}', [SecterEntityController::class, 'update'])->name('secters.update');

        Route::get('/{secter}/delete', [SecterEntityController::class, 'destroy'])->name('secters.destroy');

        Route::get('/{entity}/secteurs', [SecterEntityController::class, 'secteurs'])->name('secters.secteurs');
    });

    Route::prefix("sections")->group(function () {

        Route::get('/', [SectionEntityController::class, 'index'])->name('sections.index');

        Route::post('/', [SectionEntityController::class, 'store'])->name('sections.store');

        Route::post('/import', [SectionEntityController::class, 'import'])->name('sections.import');

        Route::get('/{section}', [SectionEntityController::class, 'show'])->name('sections.show');

        Route::get('/{section}/edit', [SectionEntityController::class, 'edit'])->name('sections.edit');

        Route::post('/{section}', [SectionEntityController::class, 'update'])->name('sections.update');

        Route::get('/{section}/delete', [SectionEntityController::class, 'destroy'])->name('sections.destroy');

        Route::get('/{entity}/sections', [SectionEntityController::class, 'sections'])->name('sections.sections');
    });

    Route::get('/', [EntityController::class, 'index'])->name('entities.index');

    Route::post('/', [EntityController::class, 'store'])->name('entities.store');

    Route::get('/type/{type?}', [EntityController::class, 'index'])->name('entities.index');

    Route::post('/import', [EntityController::class, 'import'])->name('entities.import');

    Route::get('/{entity}', [EntityController::class, 'show'])->name('entities.show');

    Route::get('/{entity}/edit', [EntityController::class, 'edit'])->name('entities.edit');

    Route::post('/{entity}', [EntityController::class, 'update'])->name('entities.update');

    Route::get('/{entity}/delete', [EntityController::class, 'destroy'])->name('entities.destroy');



    Route::get('/{entity}/sections', [EntityController::class, 'sections'])->name('entities.sections');


});

Route::prefix("locals")->group(function() {

    Route::prefix("cities")->group(function () {

        Route::get('/', [CityController::class, 'index'])->name('cities.index');

        Route::post('/', [CityController::class, 'store'])->name('cities.store');

        Route::get('/{city}', [CityController::class, 'show'])->name('cities.show');

        Route::get('/{city}/edit', [CityController::class, 'edit'])->name('cities.edit');

        Route::post('/{city}', [CityController::class, 'update'])->name('cities.update');

        Route::get('/{city}/delete', [CityController::class, 'destroy'])->name('cities.destroy');
    });

    Route::get('/', [LocalController::class, 'index'])->name('locals.index');

    Route::post('/', [LocalController::class, 'store'])->name('locals.store');

    Route::get('/{local}', [LocalController::class, 'show'])->name('locals.show');

    Route::get('/{local}/edit', [LocalController::class, 'edit'])->name('locals.edit');

    Route::post('/{local}', [LocalController::class, 'update'])->name('locals.update');

    Route::get('/{local}/delete', [LocalController::class, 'destroy'])->name('locals.destroy');

});

Route::prefix("materials")->group(function() {

    Route::prefix("types")->group(function () {

        // tous les types
        Route::get('/', [TypeMaterialController::class, 'index'])->name('types.index');

        // Enregistre un nouveau type
        Route::post('/', [TypeMaterialController::class, 'store'])->name('types.store');

        // Affiche un type spécifique
        Route::get('/{type}', [TypeMaterialController::class, 'show'])->name('types.show');

        Route::get('/{type}/export', [TypeMaterialController::class, 'export'])->name('types.export');

        // Affiche le formulaire d'édition
        Route::get('/{type}/edit', [TypeMaterialController::class, 'edit'])->name('types.edit');

        // Met à jour un type (remplacer PUT/PATCH par POST avec override si nécessaire)
        Route::post('/{type}', [TypeMaterialController::class, 'update'])->name('types.update');

        // Supprime un type
        Route::get('/{type}/delete', [TypeMaterialController::class, 'destroy'])->name('types.destroy');
    });

    Route::prefix("brands")->group(function () {

        // toutes les marques
        Route::get('/', [BrandMaterialController::class, 'index'])->name('brands.index');

        // Enregistre une nouvelle marque
        Route::post('/', [BrandMaterialController::class, 'store'])->name('brands.store');

        // Affiche une marque spécifique
        Route::get('/{brand}', [BrandMaterialController::class, 'show'])->name('brands.show');

        Route::get('/{brand}/export', [BrandMaterialController::class, 'export'])->name('brands.export');

        // Affiche le formulaire d'édition
        Route::get('/{brand}/edit', [BrandMaterialController::class, 'edit'])->name('brands.edit');

        // Met à jour une marque
        Route::post('/{brand}', [BrandMaterialController::class, 'update'])->name('brands.update');

        // Supprime une marque
        Route::get('/{brand}/delete', [BrandMaterialController::class, 'destroy'])->name('brands.destroy');

    });

    Route::prefix("marchs")->group(function () {

        // toutes les marchés
        Route::get('/', [MarchMaterialController::class, 'index'])->name('marchs.index');

        // Enregistre nouveau marché
        Route::post('/', [MarchMaterialController::class, 'store'])->name('marchs.store');

        // Affiche un marché spécifique
        Route::get('/{march}', [MarchMaterialController::class, 'show'])->name('marchs.show');

        // Affiche le formulaire d'édition
        Route::get('/{march}/edit', [MarchMaterialController::class, 'edit'])->name('marchs.edit');

        Route::get('/{march}/export', [MarchMaterialController::class, 'export'])->name('marchs.export');

        Route::get('/{delivery}/delivery', [MarchMaterialController::class, 'delivery'])->name('marchs.delivery');

        Route::get('/{delivery}/export/delivery', [MarchMaterialController::class, 'export_delivery'])->name('marchs.export.delivery');

        // Met à jour un marché
        Route::post('/{march}', [MarchMaterialController::class, 'update'])->name('marchs.update');

        // Supprime un marché
        Route::get('/{march}/delete', [MarchMaterialController::class, 'destroy'])->name('marchs.destroy');

        // reformé un marché
        Route::get('/{march}/reform/{state}', [MarchMaterialController::class, 'reform'])->name('marchs.reform');

        Route::post('/{march}/affect', [MarchMaterialController::class, 'affect'])->name('marchs.affect');

        Route::get('/{id}/disaffect', [MarchMaterialController::class, 'disaffect'])->name('marchs.disaffect');
    });

    Route::prefix("models")->group(function(){
        // tous les modèles
        Route::get('/', [ModelMaterialController::class, 'index'])->name('models.index');

        // Enregistre nouveau modèle
        Route::post('/', [ModelMaterialController::class, 'store'])->name('models.store');

        // Affiche un modèle spécifique
        Route::get('/{model}', [ModelMaterialController::class, 'show'])->name('models.show');

        // Affiche le formulaire d'édition
        Route::get('/{model}/edit', [ModelMaterialController::class, 'edit'])->name('models.edit');

        Route::get('/{model}/export', [ModelMaterialController::class, 'export'])->name('models.export');

        Route::get('/{delivery}/delivery', [ModelMaterialController::class, 'delivery'])->name('models.delivery');

        Route::get('/{delivery}/export/delivery', [ModelMaterialController::class, 'export_delivery'])->name('models.export.delivery');

        // Met à jour un modèle
        Route::post('/{model}', [ModelMaterialController::class, 'update'])->name('models.update');

        // Supprime un modèle
        Route::get('/{model}/delete', [ModelMaterialController::class, 'destroy'])->name('models.destroy');

        // reformé un modèle
        Route::get('/{model}/reform/{state}', [ModelMaterialController::class, 'reform'])->name('models.reform');

        Route::post('/{model}/affect', [ModelMaterialController::class, 'affect'])->name('models.affect');

        Route::get('/{id}/disaffect', [ModelMaterialController::class, 'disaffect'])->name('models.disaffect');
    });

    Route::prefix("observations")->group(function(){
        // tous les modèles
        Route::get('/', [ObservationMaterialController::class, 'index'])->name('observations.index');

        // Enregistre nouveau modèle
        Route::post('/{material}', [ObservationMaterialController::class, 'store'])->name('observations.store');

        Route::get('/create/{material}', [ObservationMaterialController::class, 'create'])->name('observations.create');

        // Affiche une observation spécifique
        Route::get('/{observation}', [ObservationMaterialController::class, 'show'])->name('observations.show');

        // Affiche le formulaire d'édition
        Route::get('/{model}/edit', [ObservationMaterialController::class, 'edit'])->name('observations.edit');

        // Met à jour une observation
        Route::post('/{observation}', [ObservationMaterialController::class, 'update'])->name('observations.update');

        // Supprime une observation
        Route::get('/{observation}/delete', [ObservationMaterialController::class, 'destroy'])->name('observations.destroy');

    });

    //URL Materials

    // tous les materials
    Route::get('/', [MaterialController::class, 'index'])->name('materials.index');

    // Enregistre nouveau materials
    Route::post('/', [MaterialController::class, 'store'])->name('materials.store');

    Route::get('/create', [MaterialController::class, 'create'])->name('materials.create');

    Route::get('/export', [MaterialController::class, 'export'])->name('materials.export');

    Route::get('/observations', [MaterialController::class, 'observations'])->name('materials.observations');

    Route::get('/filter/advance', [MaterialController::class, 'advance'])->name('materials.advance');

    Route::get('/filter/advance/result', [MaterialController::class, 'fresult'])->name('materials.fresult');

    Route::get('/situation/{id}', [MaterialController::class, 'situation'])->name('materials.situation');

    // Affiche un materials spécifique
    Route::get('/{material}', [MaterialController::class, 'show'])->name('materials.show');

    // Affiche le formulaire d'édition
    Route::get('/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');

    // Met à jour un materials
    Route::post('/{material}', [MaterialController::class, 'update'])->name('materials.update');

    // Supprime un materials
    Route::get('/{material}/delete', [MaterialController::class, 'destroy'])->name('materials.destroy');

    // reformé un materials
    Route::get('/{material}/reform/{state}', [MaterialController::class, 'reform'])->name('materials.reform');

    Route::post('/{material}/change', [MaterialController::class, 'change'])->name('materials.change');

    Route::post('/import/{delivery}', [MaterialController::class, 'import'])->name('materials.import');

    Route::get('/prepare/{delivery}', [MaterialController::class, 'prepare'])->name('materials.prepare');

    Route::get('/filter/{filter}/{value}', [MaterialController::class, 'filter'])->name('materials.filter');

    Route::get('/search/{value}', [MaterialController::class, 'search'])->name('materials.search');

    Route::get('/history/{id}', [MaterialController::class, 'history'])->name('materials.history');

    Route::get('/import/ip', [MaterialController::class, 'import_ip'])->name('materials.ip.import');

    Route::post('/import/ip/store', [MaterialController::class, 'import_ip_store'])->name('materials.ip.store');

});

Route::prefix("furnitures")->group(function() {

    Route::prefix("types")->group(function () {

        Route::get('/', [TypeConsumableController::class, 'index'])->name('consumables.types.index');

        Route::post('/', [TypeConsumableController::class, 'store'])->name('consumables.types.store');

        Route::get('/{type}', [TypeConsumableController::class, 'show'])->name('consumables.types.show');

        Route::get('/{type}/edit', [TypeConsumableController::class, 'edit'])->name('consumables.types.edit');

        Route::post('/{type}', [TypeConsumableController::class, 'update'])->name('consumables.types.update');

        Route::get('/{type}/delete', [TypeConsumableController::class, 'destroy'])->name('consumables.types.destroy');
    });

    Route::prefix("consumables")->group(function () {

        Route::get('/', [ConsumableController::class, 'index'])->name('consumables.index');

        Route::post('/', [ConsumableController::class, 'store'])->name('consumables.store');

        Route::get('/{consumable}', [ConsumableController::class, 'show'])->name('consumables.show');

        Route::get('/{consumable}/edit', [ConsumableController::class, 'edit'])->name('consumables.edit');

        Route::post('/{consumable}', [ConsumableController::class, 'update'])->name('consumables.update');

        Route::get('/{consumable}/delete', [ConsumableController::class, 'destroy'])->name('consumables.destroy');

        Route::post('/{model}/affect', [ConsumableController::class, 'affect'])->name('consumables.affect');

        Route::get('/{id}/disaffect', [ConsumableController::class, 'disaffect'])->name('consumables.disaffect');
    });

    Route::prefix("deliveries")->group(function () {

        Route::get('/', [DeliveryController::class, 'index'])->name('deliveries.index');

        Route::post('/', [DeliveryController::class, 'store'])->name('deliveries.store');

        Route::get('/stock/{delivery}', [DeliveryController::class, 'stock'])->name('deliveries.stock');

        Route::get('/stock/{delivery}/{consumable}', [DeliveryController::class, 'stock'])->name('deliveries.stock.consumable');

        Route::get('/{delivery}', [DeliveryController::class, 'show'])->name('deliveries.show');

        Route::get('/{delivery}/valid', [DeliveryController::class, 'valid'])->name('deliveries.valid');

        Route::get('/{delivery}/edit', [DeliveryController::class, 'edit'])->name('deliveries.edit');

        Route::post('/{delivery}', [DeliveryController::class, 'update'])->name('deliveries.update');

        Route::get('/{delivery}/delete', [DeliveryController::class, 'destroy'])->name('deliveries.destroy');
    });

    Route::prefix("stocks")->group(function () {

        Route::get('/', [StockController::class, 'index'])->name('stocks.index');

        Route::get('/short', [StockController::class, 'short'])->name('stocks.short');

        Route::get('/short/download', [StockController::class, 'short_download'])->name('stocks.short.download');

        Route::get('/export/{filter?}/{value?}', [StockController::class, 'export'])->name('stocks.export');

        Route::get('/filter/{filter}/{value}', [StockController::class, 'filter'])->name('stocks.filter');

        Route::get('/filter/advance', [StockController::class, 'advance'])->name('stocks.filter.advance');

        Route::post('/{delivery}', [StockController::class, 'store'])->name('stocks.store');

        Route::get('/{stock}', [StockController::class, 'show'])->name('stocks.show');

        Route::get('/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');

        Route::get('/{stock}/consummation', [StockController::class, 'consummation'])->name('stocks.consummation');

        Route::post('/{stock}', [StockController::class, 'update'])->name('stocks.update');

        Route::get('/{stock}/delete', [StockController::class, 'destroy'])->name('stocks.destroy');
    });

    Route::prefix("consummations")->group(function () {

        Route::get('/', [ConsummationController::class, 'index'])->name('consummations.index');

        Route::get('/create', [ConsummationController::class, 'create'])->name('consummations.create');

        Route::get('/prepare', [ConsummationController::class, 'prepare'])->name('consummations.prepare');

        Route::post('/import', [ConsummationController::class, 'import'])->name('consummations.import');

        Route::get('/export/{filter?}/{value?}', [ConsummationController::class, 'export'])->name('consummations.export');

        Route::get('/filter/{filter}/{value}', [ConsummationController::class, 'filter'])->name('consummations.filter');

        Route::get('/filter/advance', [ConsummationController::class, 'advance'])->name('consummations.filter.advance');

        Route::get('/{consummation}/valid', [ConsummationController::class, 'valid'])->name('consummations.valid');

        Route::post('/', [ConsummationController::class, 'store'])->name('consummations.store');

        Route::get('/{consummation}', [ConsummationController::class, 'show'])->name('consummations.show');

        Route::get('/{consummation}/edit', [ConsummationController::class, 'edit'])->name('consummations.edit');

        Route::get('/{consummation}/receipt', [ConsummationController::class, 'receipt'])->name('consummations.receipt');

        Route::post('/{consummation}', [ConsummationController::class, 'update'])->name('consummations.update');

        Route::get('/{consummation}/delete', [ConsummationController::class, 'destroy'])->name('consummations.destroy');
    });

});

Route::prefix("inventories")->group(function () {

    Route::prefix("statistics")->group(function () {
        Route::get('/', [StatisticController::class, 'index'])->name('statistics.index');

        Route::get('/materials', [StatisticController::class, 'material'])->name('statistics.material');

        Route::get('/employees', [StatisticController::class, 'employee'])->name('statistics.employee');

        Route::get('/furniture/{year?}', [StatisticController::class, 'furniture'])->name('statistics.furniture');
    });

    Route::get('/', [InventoryController::class, 'index'])->name('inventories.index');

    Route::post('/{employee_id}/{material_id}', [InventoryController::class, 'store'])->name('inventories.store');

    Route::get('/create', [InventoryController::class, 'create'])->name('inventories.create');

    Route::get('/check', [InventoryController::class, 'check'])->name('inventories.check');

    Route::get('/advance', [InventoryController::class, 'advance'])->name('inventories.advance');

    Route::get('/export', [InventoryController::class, 'export'])->name('inventories.export');

    Route::get('/photocopies', [InventoryController::class, 'photocopies'])->name('inventories.photocopies');

    Route::get('/photocopies/show/{id}', [InventoryController::class, 'photocopies_show'])->name('inventories.photocopies.show');

    Route::get('/photocopies/edit/{id}', [InventoryController::class, 'photocopies_edit'])->name('inventories.photocopies.edit');

    Route::get('/photocopies/export', [InventoryController::class, 'export_photocopies'])->name('inventories.photocopies.export');

    Route::get('/photocopies/vacant', [InventoryController::class, 'vacant_photocopies'])->name('inventories.photocopies.vacant');

    Route::post('/photocopies/update/{id}', [InventoryController::class, 'photocopies_update'])->name('inventories.photocopies.update');

    Route::post('/import', [InventoryController::class, 'import'])->name('inventories.import');

    Route::get('/search', [InventoryController::class, 'search'])->name('inventories.search');

    Route::get('/advance', [InventoryController::class, 'advance'])->name('inventories.advance');

    Route::get('/{filter}/search', [InventoryController::class, 'export_search'])->name('inventories.search.filter');

    Route::get('/prepare', [InventoryController::class, 'prepare'])->name('inventories.prepare');

    Route::get('/filter/{filter}/{value}', [InventoryController::class, 'filter'])->name('inventories.filter');

    Route::get('/{inventory}', [InventoryController::class, 'show'])->name('inventories.show');

    Route::get('/{inventory}/edit', [InventoryController::class, 'edit'])->name('inventories.edit');

    Route::post('/{inventory}', [InventoryController::class, 'update'])->name('inventories.update');

    Route::get('/{inventory}/delete', [InventoryController::class, 'destroy'])->name('inventories.destroy');

    Route::get('/export/{filter?}/{value?}', [InventoryController::class, 'export_filter'])->name('inventories.export.filter');

});



