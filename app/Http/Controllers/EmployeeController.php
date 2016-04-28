<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 12/03/2016
 * Time: 8:39 CH
 */

namespace App\Http\Controllers;


use App\Model\Employee\Employee;
use App\Model\Employee\EmployeeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\editEmployeeRequest;

class EmployeeController extends Controller
{
    private $empServ;

    public function __construct(EmployeeServiceInterface $empService){
        $this->empServ = $empService;
    }

    public function index(){
        $empList = $this->empServ->getEmployeeList();
        return view('employee.employee', ['empList' => $empList]);
    }

    public function edit(editEmployeeRequest $request){
        if($request->id == "") {
            if ($this->empServ->addEmployee($request)) {
                return redirect()->route('employee');
            }
        }else{
            if($this->empServ->editEmployee($request->id,$request))
                return redirect()->route('employee');
        }
    }

    public function add(Request $request){
        $emp_id = $request->route('emp_id');
        if(isset($emp_id)) {
            $employee = $this->empServ->getInfo($emp_id);

            return view('employee.edit',[
                'employee' => $employee
            ]);
        }
        return view('employee.edit');
    }

    public function search(Request $request){
        $employeeList = $this->empServ->search($request);

        return view('employee.employee',[
            'empList' => $employeeList,
            'name' => $request->name
        ]);

    }

    public function delete(Request $request){
        if($this->empServ->deleteEmployee($request->employee_id))
            return redirect()->route('employee');
    }

    public function profile(Request $request){
        $employee = $this->empServ->getInfo($request->route('emp_id'));
        return view('employee.profile',[
            'employee' => $employee
        ]);
    }
}