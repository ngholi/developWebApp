<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 12/03/2016
 * Time: 8:22 CH
 */

namespace App\Http\Controllers;


use App\Model\Department\DepartmentServiceInterface;
use Illuminate\Http\Request;
use App\Http\Requests\editDepartmentRequest;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentServiceInterface $departmentServiceInterface){
        $this->departmentService = $departmentServiceInterface;
    }

    public function index(){
        $departments = $this->departmentService->getListDepartment();
        return view('department.department', ['departments' => $departments]);
    }

    public function add(Request $request){
        $dep_id = $request->route('dep_id');
        if(isset($dep_id)){
            $department = $this->departmentService->getDepartmentDetail($dep_id);
            $title = 'Sửa thông tin phòng ban';
            return view('department.edit',[
                'title' => $title,
                'department' => $department
            ]);
        }

        $title = 'Thêm phòng ban';
        return view('department.edit', ['title' => $title]);
    }

    public function edit(editDepartmentRequest $request){
        if($request->id==""){
            if($this->departmentService->addDepartment($request)){
                return redirect()->route('department');
            }
        }else{
            if($this->departmentService->editDepartment($request->id,$request))
                return redirect()->route('department');
        }
    }

    public function profile(Request $request){
       $department = $this->departmentService->getDepartmentDetail($request->route('dep_id'));
        return view('department.profile',[
            'department' => $department
        ]);
    }

    public function employeeList(Request $request){
        $employeeList = $this->departmentService->getEmpInDepartment($request->route('dep_id'));
        return view('employee.employee',[
            'empList' => $employeeList
        ]);
    }

    public function delete(Request $request){
        if($this->departmentService->deleteDepartment($request->department_id))
            return redirect()->route('department');
    }
}