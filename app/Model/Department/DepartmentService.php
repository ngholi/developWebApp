<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 14/03/2016
 * Time: 10:26 CH
 */

namespace App\Model\Department;

use App\Model\Employee\Employee;

class DepartmentService implements  DepartmentServiceInterface
{

    /**
     * Thêm phòng ban
     * @param $data
     * @return mixed
     */
    public function addDepartment($data)
    {
        $department = new Department();

        $department->name = $data->departmentName;
        $department->phone = $data->phone;
        $department->manager = ($data->manager == 'none')? null : $data->manager;

        return $department->save();
    }

    /**
     * Lấy danh sách các phòng ban
     * @return mixed
     */
    public function getListDepartment()
    {
        return Department::all();
    }

    /**
     * Xem chi tiết phòng ban
     * @param $id
     * @return mixed
     */
    public function getDepartmentDetail($id)
    {
        $department = Department::where('id',$id)->first();
        //$manager_name = Employee::where('id',$department->manager)->value('name');
        $manager_name = is_null($department->managedBy)? '' : $department->managedBy->name;
        $department = array_add($department,'manager_name',$manager_name);
        return $department;
    }

    /**
     * Lấy danh sách nhân viên thuộc phòng ban
     * @param $id
     * @return mixed
     */
    public function getEmpInDepartment($id)
    {
        return Employee::where('department_id',$id)->get();

    }

    /**
     * Sửa thông tin phòng ban
     * @param $id
     * @param $data
     * @return mixed
     */
    public function editDepartment($id, $data)
    {
       $department = Department::where('id',$id)->first();
        if(isset($department)){
            $department->name = $data->departmentName;
            $department->phone = $data->phone;
            $department->manager = ($data->manager == 'none')? null : $data->manager;

            return $department->save();
        }
        return false;
    }

    /**
     * Xóa phòng ban
     * @param $id
     * @return mixed
     */
    public function deleteDepartment($id)
    {
        $department = Department::where('id',$id)->first();
        return $department->delete();
    }
}