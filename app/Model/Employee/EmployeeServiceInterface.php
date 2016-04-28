<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 11/03/2016
 * Time: 10:06 CH
 */

namespace App\Model\Employee;


use Illuminate\Http\Request;

interface EmployeeServiceInterface
{
    /**
     * Thêm nhân viên mới
     * @param $request
     * @return mixed
     */
    public function addEmployee(Request $request);

    /**
     * Lấy thông tin nhân viên theo id
     * @param $id
     * @return mixed
     */
    public function getInfo($id);

    /**
     * Lấy danh sách nhân viên
     * @return mixed
     */
    public function getEmployeeList();

    /**
     * Tìm kiếm nhân viên
     * @param $s
     * @return mixed
     */
    public function search($s);

    /**
     * Sửa thông tin nhân viên theo id
     * @param $id
     * @param $data
     * @return mixed
     */
    public function editEmployee($id, $data);

    /**
     * Xóa nhân viên theo id
     * @param $id
     * @return mixed
     */
    public function deleteEmployee($id);

    /*
     * Tìm nhân viên theo tên và phòng ban
     * @param $name, $department
     * @return mixed
     */

}