<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 12/03/2016
 * Time: 9:25 CH
 */

namespace App\Model\Employee;


use Illuminate\Http\Request;
use App\Model\Department\Department;

class EmployeeService implements EmployeeServiceInterface
{

    /**
     * Thêm nhân viên mới
     * @param $request Request
     * @return bool
     */
    public function addEmployee(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->jobtitle = $request->jobTitle;
        $employee->cellphone = $request->cellPhone;
        $employee->email = $request->email;
        $employee->department_id = $request->department_id;
        if($request->hasFile('avatar')){
            if($request->file('avatar')->isValid()){
				$employee->photo = ''.time().rand(0, 1000);
                $request->file('avatar')->move(base_path().'/public/img', $employee->photo);
            }
        }
        return $employee->save();
    }

    /**
     * Lấy thông tin nhân viên theo id
     * @param $id
     * @return mixed
     */
    public function getInfo($id)
    {
        $employee = Employee::where('id',$id)->first();
        // $department_name = Department::where('id',$employee->department_id)->value('name');
        $department_name = is_null($employee->department)? '' : $employee->department->name;
        $employee = array_add($employee,'department_name',$department_name);
        return $employee;
    }

    /**
     * Lấy danh sách nhân viên
     * @return mixed
     */
    public function getEmployeeList()
    {
        return Employee::all();
    }

    /**
     * Tìm kiếm nhân viên
     * @param $s
     * @return mixed
     */
    public function search($s)
    {
        if($s->department_id != 'all')
            return Employee::where([
                ['name','like','%'.$s->name.'%'],
                ['department_id',$s->department_id],
            ])->get();
        return Employee::where([
            ['name','like','%'.$s->name.'%'],
        ])->get();
    }

    /**
     * Sửa thông tin nhân viên theo id
     * @param $id
     * @param $data
     * @return mixed
     */
    public function editEmployee($id, $data)
    {
        // TODO: Implement editEmployee() method.
        $emp = Employee::where('id',$id)->first();
        if(isset($emp)){
            $emp->name = $data->name;
            $emp->jobtitle = $data->jobTitle;
            $emp->cellphone = $data->cellPhone;
            $emp->email = $data->email;
            $emp->department_id = $data->department_id;
            if($data->hasFile('avatar')){
                if($data->file('avatar')->isValid()){
					if(empty($emp->photo))
						$emp->photo = ''.time().rand(0, 1000);
                    $data->file('avatar')->move(base_path().'/public/img', $emp->photo);
                }
            }
            return $emp->save();
        }
        return false;
    }

    /**
     * Xóa nhân viên theo id
     * @param $id
     * @return mixed
     */
    public function deleteEmployee($id)
    {
        // TODO: Implement deleteEmployee() method.
        $employee = Employee::where('id',$id)->first();
        return $employee->delete();
    }

}