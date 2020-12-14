<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Session;
use App\Models\User;
use App\Models\UserDetail;
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
        return view('user.auth.register');
    }
    public function store(registerRequest $request)
    {
        try {
            DB::beginTransaction();

            $id = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            UserDetail::create([
                'user_id'   => $id->id,
                'telephone' => $request->telephone,
                'birthday'  => $request->birthday,
                'address'   => $request->address,
                'sex'       => $request->sex,
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session::flash('success', 'Đăng Kí Thành Công!');
            DB::commit();
            return redirect()->route('user.login');
        } catch (\Exception $exception) {
            // dd($exception);
			Session::flash('error', 'Email đã tồn tại');
            return redirect()->route('user.getregister');
        }
    }
}
