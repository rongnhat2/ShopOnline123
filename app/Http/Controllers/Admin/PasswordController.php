<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Models\Admin;
use App\Http\Requests\passwordRequest;
use App\Repositories\AdminRepository;

class PasswordController extends Controller
{

    private $admin;

    public function __construct(Admin $admin){
        $this->admin = new AdminRepository($admin);
    }

    // trả về giao diện đổi mật khẩu của admin
    public function getpassword(){
        return view('admin.auth.password');
    }

    // cập nhật mật khẩu
    public function postpassword(passwordRequest $request){
        /**
         * passwordRequest sễ Kiểm tra dữ liệu nhập vào theo đúng định dạng ... file ở app/Http/Requests/passwordRequest
         *
         * Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
         */
        $checkPassword = $this->admin->password($request);
        if ($checkPassword) {
            Session::flash('success', 'Đổi Mật Khẩu Thành Công!');
        }else{
            Session::flash('error', 'Mật khẩu Cũ không đúng!');
        }
        return redirect()->back();
    }

}
