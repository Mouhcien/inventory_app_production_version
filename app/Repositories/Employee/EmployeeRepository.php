<?php

namespace App\Repositories\Employee;

use App\Models\Employee;

class EmployeeRepository {


    /***
     * @param $pages
     * @return array|null
     */
    public function all($pages) {
        try {
            $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                ->where('situation', '=', 1)
                ->orderBy('lastname', 'ASC')
                ->orderBy('firstname', 'ASC');

            if ($pages == 0)
                return $query->get();

            return $query->paginate($pages);

        }catch (\Exception $exception) {

        }
        return null;
    }

    /***
     * @param $id
     * @return Employee
     */
    public function findOneById($id): ?Employee {
        return Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])->find($id);
    }

    public function findOneByPPR($ppr): ?Employee {
        return Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
            ->where('ppr', $ppr)
            ->first();
    }

    public function findAllByLocal($local, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('local_id','=', $local)
                    ->where('situation', '=', 1);

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);

    }

    public function findAllByFilter($value, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('situation', '=', 1)
                    ->where(function($query) use ($value) {
                        $query->Where('employees.ppr', 'LIKE', '%' . $value . '%')
                            ->orWhere('employees.firstname', 'LIKE', '%' . $value . '%')
                            ->orWhere('employees.lastname', 'LIKE', '%' . $value . '%');
                    });

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);

    }

    public function findAllByService($service, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('situation', '=', 1)
                    ->where('service_entity_id','=', $service);

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);

    }

    public function findAllByEntity($entity, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('situation', '=', 1)
                    ->where('entity_id','=', $entity);
        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);

    }

    public function findAllBySecter($secter, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('situation', '=', 1)
                    ->where('secter_entity_id','=', $secter);
        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);

    }

    public function findAllBySection($section, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
                    ->where('situation', '=', 1)
                    ->where('section_entity_id','=', $section);
        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }

    public function findAllBySituation($situation, $pages) {
        $query = Employee::with(['service_entity', 'entity', 'secter_entity', 'section_entity', 'local'])
            ->where('situation', '=', $situation);

        if ($pages == 0)
            return $query->get();

        return $query->paginate($pages);
    }


    /***
     * @param $data
     * @return bool
     */
    function create($data): bool {
        $obj = new Employee();
        $obj->ppr = $data['ppr'];
        $obj->lastname = $data['lastname'];
        $obj->firstname = $data['firstname'];
        $obj->email = $data['email'];
        $obj->tel = $data['tel'];
        $obj->service_entity_id = $data['service_entity_id'];
        $obj->entity_id = $data['entity_id'];
        $obj->secter_entity_id = $data['secter_entity_id'];
        $obj->section_entity_id = $data['section_entity_id'];
        $obj->local_id = $data['local_id'];
        return $obj->save();
    }

    /***
     * @param Employee $employee
     * @param $data
     * @return bool
     */
    function update(Employee $employee, $data): bool {
        $employee->ppr = $data['ppr'];
        $employee->lastname = $data['lastname'];
        $employee->firstname = $data['firstname'];
        $employee->email = $data['email'];
        $employee->tel = $data['tel'];
        $employee->service_entity_id = $data['service_entity_id'];
        $employee->entity_id = $data['entity_id'];
        $employee->secter_entity_id = $data['secter_entity_id'];
        $employee->section_entity_id = $data['section_entity_id'];
        $employee->local_id = $data['local_id'];
        $employee->situation = $data['situation'];
        return $employee->save();
    }

    function updatePersonnelInfo(Employee $employee, $data): bool {
        $employee->ppr = $data['ppr'];
        $employee->lastname = $data['lastname'];
        $employee->firstname = $data['firstname'];
        $employee->email = $data['email'];
        $employee->tel = $data['tel'];
        $employee->local_id = $data['local_id'];
        $employee->situation = $data['situation'];
        return $employee->save();
    }

    function updateEmployeeProfInfo(Employee $employee, $data): bool {
        $employee->service_entity_id = $data['service_entity_id'];
        $employee->entity_id = $data['entity_id'];
        $employee->secter_entity_id = $data['secter_entity_id'];
        $employee->section_entity_id = $data['section_entity_id'];
        return $employee->save();
    }

    /***
     * @param Employee $employee
     * @return bool|null
     */
    function delete(Employee $employee) {
        return $employee->delete();
    }

    function getTotalEmployees() {
        return Employee::where('situation', '=', 1)->count();
    }

    function getEmployeeWithDuplicatePPR() {
        return  Employee::select('id', 'ppr', 'lastname', 'firstname')
            ->groupBy('id', 'ppr', 'lastname', 'firstname')
            ->havingRaw('COUNT(*) > 1')
            ->get();
    }

}
