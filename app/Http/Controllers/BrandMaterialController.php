<?php

namespace App\Http\Controllers;

use App\Services\Material\BrandMaterialService;
use App\Services\Material\MaterialService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BrandMaterialController extends Controller
{
    private int $pages = 10;
    private BrandMaterialService $brandMaterialService;
    private MaterialService $materialService;
    private array $rules = [
        'title'     => 'required|max:255'
    ];

    /**
     * @param BrandMaterialService $brandMaterialService
     */
    public function __construct(BrandMaterialService $brandMaterialService, MaterialService $materialService)
    {
        $this->brandMaterialService = $brandMaterialService;
        $this->materialService = $materialService;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Log::channel('custom')->info(url()->current());

        try {

            $brands = $this->brandMaterialService->getAllMaterialBrands($this->pages);
            return view("materials.brands.index", [
                'brands'        => $brands,
                'editedBrand'   => null,
                'id'            => null,
                'url'           => 'brands.store',
                'title'         => 'Nouvelle marque du matériel'
            ]);

        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::channel('custom')->info(url()->current());
        try {
            $this->rules['logo']    = 'required|image|mimes:jpg,jpeg,png,gif|max:2048';
            $data                   = $request->validate($this->rules);

            $data["logo"]           = $data["title"];
            $data["logo_data"]      = file_get_contents($request->file('logo')->getRealPath());

            $result                 = $this->brandMaterialService->createNewMaterialBrand($data);

            if ($result)
                return Redirect::route('brands.index')->with('success', "Nouvelle marque de matériel ajouté avec succès !");

        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
            return Redirect::route('brands.index')->with('error', "Une erreur technique est survenue pendant la création marque de matériel");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Log::channel('custom')->info(url()->current());

        try {

            $brand = $this->brandMaterialService->getOneMaterialBrandById($id);
            $materials = $this->materialService->filterMaterial('brand', $id, 10);
            if (!$brand){
                Log::channel('custom')->error("La marque du matériel est introuvable");
                return Redirect::route('brands.index')->with('error', "La marque du matériel est introuvable");
            }

            return view('materials.brands.show', [
                'brand' => $brand,
                'materials' => $materials,
                'total' => $materials->total()
            ]);

        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
            return Redirect::route('brands.index')->with('error', $exception->getMessage());
        }
    }

    public function export(int $id)
    {
        Log::channel('custom')->info(url()->current());
        return $this->exportMaterials($this->materialService, 'brand', $id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        Log::channel('custom')->info(url()->current());
        try {
            $brand  = $this->brandMaterialService->getOneMaterialBrandById($id);
            if (is_null($brand)) {
                Log::channel('custom')->error("La marque du matériel est introuvable");
                return Redirect::route('brands.index')->with('error', "La marque du matériel est introuvable");
            }

            $brands = $this->brandMaterialService->getAllMaterialBrands($this->pages);
            return view("materials.brands.index", [
                'brands'       => $brands,
                'editedBrand'  => $brand,
                'id'          => $id,
                'url'         => "brands.update",
                'title'       => 'Modifier la marque du matériel'
            ]);

        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
            return Redirect::route('brands.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::channel('custom')->info(url()->current());

        try {
            $brand = $this->brandMaterialService->getOneMaterialBrandById($id);
            if (!$brand) {
                Log::channel('custom')->error("La marque du matériel est introuvable");
                return Redirect::route('brands.index')->with('error', "La marque du matériel est introuvable");
            }

            $data               = $request->validate($this->rules);
            $data["logo"]       = $data["title"];

            if ($request->hasFile('logo'))
                $data["logo_data"]  = file_get_contents($request->file('logo')->getRealPath());
            else
                $data["logo_data"]  = $brand->logo_data;

            $result     = $this->brandMaterialService->updateMaterialBrand($brand, $data);

            if ($result)
                return Redirect::route('brands.index')->with('success', "La marque du matériel est modifié avec succès !");

        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
            return Redirect::route('brands.index')->with('error', "Une erreur technique est survenue pendant la création de la marque de matériel");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Log::channel('custom')->info(url()->current());

        try {
            $brand = $this->brandMaterialService->getOneMaterialBrandById($id);
            if (!$brand) {
                Log::channel('custom')->error("La marque du matériel est introuvable");
                return Redirect::route('brands.index')->with('error', "La marque du matériel est introuvable");
            }
                

            $result = $this->brandMaterialService->deleteMaterialBrand($brand);
            if ($result)
                return Redirect::route('brands.index')->with('success', "La marque du matériel est supprimé avec succès !");
            else
                return Redirect::route('brands.index')->with('error', "Une erreur technique est survenue pendant la suppression du brand de matériel");


        }catch (\Exception $exception) {
            Log::channel('custom')->error($exception->getMessage());
            return Redirect::route('brands.index')->with('error', $exception->getMessage());
        }
    }
}
