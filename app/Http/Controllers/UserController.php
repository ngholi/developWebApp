<?php
/**
 * Created by PhpStorm.
 * User: Linh
 * Date: 04/04/2016
 * Time: 1:32 CH
 */

namespace App\Http\Controllers;


use App\Model\User\Validator;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function __construct(Validator $validator){
        $this->validator = $validator;
    }

    /**
     * Hiển thị trang đăng nhập
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(){
        return view('auth.login');
    }

    /** Đăng nhập vào hệ thống
     * @param Request $request
     * @return Redirect
     */
    public function authenticate(Request $request){
        //Kiểm tra request
        $validator = $this->validator->login($request);

        if($validator->fails()){
            return Redirect::to('login')
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        //Gán dữ liệu
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password
        );

        //Đăng nhâp
        if(Auth::attempt($userdata, $request->remember)){
            return redirect('department');
        }
        else{
            return redirect()->route('user.login')
                ->withErrors(['email' => 'Email hoặc mật khẩu không chính xác'])
                ->withInput($request->only(['email']));
        }
    }

    /** Đăng xuất khỏi hệ thống
     * @return mixed
     */
    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    /** Hiển thị trang đổi mật khẩu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangePass(){
        return view('auth.changepass');
    }

    /**
     * Tiến hành đổi mật khẩu
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doChangePass(Request $request){
        //Kiểm tra request
        $validator = $this->validator->changePass($request);

        if($validator->fails()){
            return redirect()->route('user.changepass')->withErrors($validator)->withInput($request->all());
        }

        //Lấy user đang hoạt động
        $user = Auth::user();

        //Kiểm tra mật khẩu cũ, nếu đúng sẽ tiến hành thay đổi pass, nếu sai hiển thị lại trang đổi mật khẩu
        if(Auth::attempt(['email' => $user->email, 'password' => $request->oldPassword])){
            $user->password = bcrypt($request->password);
            $user->was_changed_pass = true; //Đánh dấu đã từng đổi mật khẩu
            $user->save();
            return view('auth.success');
        }
        else{
            return redirect()->route('user.showchangepass')->withErrors(['oldPassword' => 'Mật khẩu không chính xác'])->withInput($request->all());
        }
    }

    public function showRegister(){
        return view('auth.register');
    }

    /**
     * Tạo tài khoản admin mới
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function doRegister(Request $request){
        //Kiểm tra request
        $validator = $this->validator->register($request);

        if($validator->fails()){
            return redirect()->route('user.register')->withErrors($validator)->withInput($request->all());
        }

        //Tạo ra mật khẩu ngẫu nhiên, tạo đối tượng user mới và gán giá trị
        $password = $this->generateRandomString();
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($password);

        //Tiến hành ghi vào DB và gửi email. Chỉ khi 2 hành động đó thành công thì mới commit vào DB, nếu thất bại thì
        //rollback và trả về trang thất bại kèm theo nguyên nhân
        DB::beginTransaction();
        try{
            $user->save();
            $this->sendMailForCreateAccount($user->email, $password);
            DB::commit();

            return view('auth.success');
        }catch (\Exception $e) {
            DB::rollBack();
            if ($e instanceof \Swift_TransportException)
                $reason = 'Không thể kết nối đến dịch vụ Gmail';
            elseif($e instanceof QueryException){
                $reason = 'Email đã tồn tại';
            }
            else{
                $reason = 'Lỗi không xác định';
            }

            return view('auth.failure', ['reason' => $reason]);
        }
    }

    /** Tiện ích tạo 1 chuỗi ký tự ngẫu nhiên
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /** Hàm gửi email thông tin tài khoản
     * @param $email
     * @param $password
     */
    private function sendMailForCreateAccount($email, $password){
        Mail::send('emails.createAccount', ['email' => $email, 'password' => $password], function($m) use($email){
            $m->subject('Tạo thành công tài khoản Admin');
            $m->to($email);
        });
    }
}