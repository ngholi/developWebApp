<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 04/04/2016
 * Time: 3:30 CH
 */

namespace App\Model\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as BaseValidator;

class Validator
{
    /**
     * Kiểm tra request đăng nhập, email cần đúng định dạng và password có ít nhất 6 ký tự
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request){
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        );
        $message = array(
            'email.required' => 'Trường email không được bỏ trống',
            'email.email' => 'Email không đúng định dạng',
            'password.required' => 'Mật khẩu không được bỏ trống',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự'
        );
        return BaseValidator::make($request->all(), $rules, $message);
    }

    /**
     * Kiểm tra request đổi mật khẩu
     * @param Request $request
     * @return mixed
     */
    public function changePass(Request $request){
        $rules = array(
            'oldPassword' => 'required|min:6',
            'password' => 'required|min:6',
            'rePassword' => 'required|min:6|same:password'
        );

        $message = array(
            'required' => 'Không được để trống trường này',
            'min' => 'Mật khẩu có ít nhất :min ký tự',
            'same' => 'Nhập lại mật khẩu không khớp với mật khẩu mới'
        );

        return BaseValidator::make($request->all(), $rules, $message);
    }

    /** Kiểm tra request đăng ký tài khoản admin mới
     * @param Request $request
     * @return mixed
     */
    public function register(Request $request){
        $rules = array(
            'name' => 'required',
            'email' => 'required|email'
        );

        $message = array(
            'required' => 'Không được bỏ trống trường này',
            'email' => 'Email chưa đúng định dạng'
        );

        return BaseValidator::make($request->all(), $rules, $message);
    }
}