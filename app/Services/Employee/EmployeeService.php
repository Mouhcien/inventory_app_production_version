<?php

namespace App\Services\Employee;

use App\Exceptions\ObjectNotFoundException;
use App\Models\Employee;
use App\Repositories\Employee\EmployeeRepository;

class EmployeeService {


    private EmployeeRepository $employeeRepository;

    /**
     * @param EmployeeRepository $employeeRepository
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /***
     * @param $pages
     * @return array|void|null
     */
    public function getAllEmployees($pages){
        try {
            return $this->employeeRepository->all($pages);
        }catch (Exception $ex) {

        }
    }

    /***
     * @param $id
     * @return Employee
     * @throws ObjectNotFoundException
     */
    public function getOneEmployeeById($id): Employee
    {
        $type = $this->employeeRepository->findOneById($id);
        if (is_null($type)){
            throw new ObjectNotFoundException("Le service introuvable!!");
        }
        return $type;
    }

    public function getOneEmployeeByPPR($ppr)
    {
        return $this->employeeRepository->findOneByPPR($ppr);
    }

    public function getAllEmployeeByLocal($local, $pages)
    {
        return $this->employeeRepository->findAllByLocal($local, $pages);
    }

    public function getAllEmployeeByFilter($value, $pages)
    {
        return $this->employeeRepository->findAllByFilter($value, $pages);
    }

    public function getAllEmployeeByService($service, $pages)
    {
        return $this->employeeRepository->findAllByService($service, $pages);
    }

    public function getAllEmployeeByEentity($entity, $pages)
    {
        return $this->employeeRepository->findAllByEntity($entity, $pages);
    }

    public function getAllEmployeeBySecter($secter, $pages)
    {
        return $this->employeeRepository->findAllBySecter($secter, $pages);
    }

    public function getAllEmployeeBySection($section, $pages)
    {
        return $this->employeeRepository->findAllBySection($section, $pages);
    }

    public function getAllEmployeeBySituation($situation, $pages)
    {
        return $this->employeeRepository->findAllBySituation($situation, $pages);
    }


    /***
     * @param $data
     * @return bool|void
     */
    public function createNewEmployee($data){
        try {
            return $this->employeeRepository->create($data);
        }catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /***
     * @param Employee $employee
     * @param $data
     * @return bool|void
     */
    public function updateEmployee(Employee $employee, $data){
        try {
            return $this->employeeRepository->update($employee, $data);
        }catch (Exception $exception){

        }
    }

    public function updateEmployeePersonnelInfo(Employee $employee, $data){
        try {
            return $this->employeeRepository->updatePersonnelInfo($employee, $data);
        }catch (Exception $exception){

        }
    }

    public function updateEmployeeProfInfo(Employee $employee, $data){
        try {
            return $this->employeeRepository->updateEmployeeProfInfo($employee, $data);
        }catch (Exception $exception){

        }
    }

    /***
     * @param Employee $employee
     * @return bool|void|null
     */
    public function deleteEmployee(Employee $employee){
        try {
            return $this->employeeRepository->delete($employee);
        }catch (Exception $exception){

        }
    }

    public function getTotalEmployees() {
        return $this->employeeRepository->getTotalEmployees();
    }

    public function getEmployeeWithDuplicatePPR() {
        return $this->employeeRepository->getEmployeeWithDuplicatePPR();
    }
}
