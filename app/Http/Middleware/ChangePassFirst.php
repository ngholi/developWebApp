<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 05/04/2016
 * Time: 9:39 CH
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Class ChangePassFirst là 1 middleware yêu cầu admin mới được tạo
 * tài khoản cần thay đổi mật khẩu ít nhất 1 lần mới có thể sử dụng
 * các dịch vụ của hệ thống
 * @package App\Http\Middleware
 */
class ChangePassFirst
{
    public function handle($request, Closure $next){
        if(Auth::check() && !Auth::user()->was_changed_pass){
            return redirect()->route('user.changepass');
        }

        return $next($request);
    }
}