<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Admin;
use App\Http\Requests\loginRequest;
use App\Repositories\AdminRepository;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->middleware('guest:admin')->except('logout');
        $this->admin = new AdminRepository($admin);
    }

    public function guard(){
        return Auth::guard('admin');
    }

    // trả về giao diện login của admin
    public function getLogin(){
        return view('admin.auth.login');
    }

    // gửi yêu cầu đăng nhập
    public function postlogin(loginRequest $request) {
        /**
         * loginRequest sễ Kiểm tra dữ liệu nhập vào theo đúng định dạng ... file ở app/Http/Requests/loginRequest
         *
         * Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
         */
        $checkLogin = $this->admin->login($request);
        if ($checkLogin) {
            return redirect()->route('admin.home');
        }else{
            return redirect()->route('admin.getlogin');
        }
    }

    // admin đăng xuất
    public function logout(){
        $checkLogin = $this->admin->logout();
        return redirect()->route('admin.getlogin');
    }
}
