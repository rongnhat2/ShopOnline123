<?php

namespace App\Http\Controllers\Shipper;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\Models\Admin;
use App\Models\Customer;
use App\Http\Requests\loginRequest;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/shipper/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest:shipper')->except('logout');
    }

    public function guard()
    {
        return Auth::guard('shipper');
    }

    public function showLoginForm()
    {
        return view('shipper.auth.login');
    }
    public function login(loginRequest $request) {

    // Kiểm tra dữ liệu nhập vào
        // Nếu dữ liệu hợp lệ sẽ kiểm tra trong csdl
        $email = $request->input('email');
        $password = $request->input('password');

        if( Auth::guard('shipper')->attempt(['email' => $email, 'password' =>$password])) {
            // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
            $customer_session = DB::table('shippers')->where('email', '=', $email)->first();
            $customer       =   new Customer($customer_session);
            $customer->Create($customer_session);
            $request->session()->put('shipper', $customer);

            return redirect()->route('admin_ship.order_index');
        } else {
            // dd(false);
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return redirect()->route('admin_ship.login');
        }
    }
}
