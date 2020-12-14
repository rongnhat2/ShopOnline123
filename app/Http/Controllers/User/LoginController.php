<?php

namespace App\Http\Controllers\User;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\User;
use App\Http\Requests\loginRequest;
use App\Repositories\UserRepository;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/';
    private $user;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');
        $this->user = new UserRepository($user);
    }


    // trả về giao diện login của user
    public function getLogin(){
        return view('user.auth.login');
    }

    // gửi yêu cầu đăng nhập
    public function postlogin(loginRequest $request) {
        /**
         * loginRequest sễ Kiểm tra dữ liệu nhập vào theo đúng định dạng ... file ở app/Http/Requests/loginRequest
         *
         * Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
         */
        $checkLogin = $this->user->login($request);
        if ($checkLogin) {
            return redirect()->route('user.index');
        }else{
            return redirect()->route('user.login');
        }
    }

    // user đăng xuất
    public function logout(){
        $checkLogin = $this->user->logout();
        return redirect()->route('user.login');
    }
}