<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\User;
use App\Http\Requests\passwordRequest;
use App\Repositories\UserRepository;

class PasswordController extends Controller
{

    private $user;

    public function __construct(User $user){
        $this->user = new UserRepository($user);
    }

    // trả về giao diện đổi mật khẩu của user
    public function getpassword(){
        return view('user.auth.password');
    }

    // cập nhật mật khẩu
    public function postpassword(passwordRequest $request){
        /**
         * passwordRequest sễ Kiểm tra dữ liệu nhập vào theo đúng định dạng ... file ở app/Http/Requests/passwordRequest
         *
         * Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
         */
        $checkPassword = $this->user->password($request);
        if ($checkPassword) {
            Session::flash('success', 'Đổi Mật Khẩu Thành Công!');
        }else{
            Session::flash('error', 'Mật khẩu Cũ không đúng!');
        }
        return redirect()->back();
    }

}
