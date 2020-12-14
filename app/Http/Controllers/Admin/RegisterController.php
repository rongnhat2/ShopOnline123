<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\registerRequest;

class RegisterController extends Controller
{
    /**
     * Function get data and Show the user login..
     *
     * @return view login
     */
    public function showRegisterForm(){
        return view('admin.auth.register');
    }
    public function store(registerRequest $request)
    {
        try {
            DB::beginTransaction();

            Admin::create([
	            'name' => $request->name,
	            'email' => $request->email,
	            'password' => Hash::make($request->password),
	        ]);
            Session::flash('success', 'Đăng Kí Thành Công!');
            DB::commit();
            return redirect()->route('admin.getlogin');
        } catch (\Exception $exception) {
            dd($exception);
			Session::flash('error', 'Email đã tồn tại');
            return redirect()->route('admin.getregister');
        }
    }
}
