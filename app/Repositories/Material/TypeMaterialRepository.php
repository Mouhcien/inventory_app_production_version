<?php

namespace App\Repositories\Material;
use App\Models\TypeMaterial;
use Illuminate\Pagination\Paginator;

class TypeMaterialRepository
{

    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {

            if ($pages == 0)
                return TypeMaterial::with('models_material')->get()->all();

            return TypeMaterial::with('models_material')->orderBy('id', 'ASC')->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return TypeMaterial
     */
    public function findOneById($id): ?TypeMaterial {
        return TypeMaterial::with('models_material')->find($id);
    }

    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new TypeMaterial();
        $obj->title = $data['title'];
        return $obj->save();
    }

    /***
     * @param TypeMaterial $type
     * @param $data
     * @return bool
     */
    function update(TypeMaterial $type, $data): bool {
        $type->title = $data['title'];
        return $type->save();
    }

    /***
     * @param TypeMaterial $type
     * @return bool|null
     */
    function delete(TypeMaterial $type) {
        return $type->delete();
    }

    function getTotalTypes() {
        return TypeMaterial::count();
    }

}
