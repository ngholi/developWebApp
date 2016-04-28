<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 11/03/2016
 * Time: 10:13 CH
 */

namespace App\Model\Department;


interface DepartmentServiceInterface
{
    /**
     * Thêm phòng ban
     * @param $data
     * @return mixed
     */
    public function addDepartment($data);

    /**
     * Lấy danh sách các phòng ban
     * @return mixed
     */
    public function getListDepartment();

    /**
     * Xem chi tiết phòng ban
     * @param $id
     * @return mixed
     */
    public function getDepartmentDetail($id);

    /**
     * Lấy danh sách nhân viên thuộc phòng ban
     * @param $id
     * @return mixed
     */
    public function getEmpInDepartment($id);

    /**
     * Sửa thông tin phòng ban
     * @param $id
     * @param $data
     * @return mixed
     */
    public function editDepartment($id, $data);

    /**
     * Xóa phòng ban
     * @param $id
     * @return mixed
     */
    public function deleteDepartment($id);
}