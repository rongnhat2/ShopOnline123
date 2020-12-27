<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\changePassRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;

use Redirect,Response,Config;
use Mail;
use Hash;
use App\Mail\MailNotify;

class ResetPasswordController extends Controller
{
    public function forgotPass(){
    	return view('user.auth.forgot');
    }
    public function sendMail(Request $request)
    {
        $email = $request->email;
        // kiểm tra user tồn tại
        $checkUser = User::where('email', $email)->first();

        if (!$checkUser) {
            return  redirect()->back()->with('error', 'Email không tồn tại');
        }
        //  tạo hash code
        $code = bcrypt(md5(time() . $email));

        PasswordReset::create([
            'email'          => $email,
            'token'           => $code,
            "created_at"    =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            "updated_at"    => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $url = route('user.updatepassword', ['code' => $code, 'email' => $email]);

        Mail::send('email', array('url'=> $url), function($message) use ($email) {
            $message->from('brandshop2110@gmail.com', 'Quên mật khẩu');
            $message->to($email)->subject('Đặt lại mật khẩu cho tài khoản!');
        });
        return  redirect()->back()->with('success', 'Đường dẫn cập nhật mật khẩu đã được gửi tới email của bạn. Hãy kiểm tra email để thiết lập lại mật khẩu!!!');
    }

    public function resetPass(Request $request){
        $email  =   $request->email;
        $code   =   $request->code;

        //  kiểm tra token có tồn tại với email
        $checkUser = PasswordReset::where([
            'token' => $code,
            'email' => $email
        ])->first();

        // lấy ra user
        $user   = User::where([
            'email' => $email
        ])->first();

        if(!$checkUser){
            return redirect('/')->with('error', "Đường dẫn lấy lại mật khẩu không đúng !!!");
        }
        return view('user.auth.passwordReset', compact('user'));
    }

    public function postResetPassword(changePassRequest $request)
    {       
        // dd($request);
        // lấy user cần đổi                 
        $obj_user = User::find($request->id);
        // lấy tạo mật khẩu mới               
        $obj_user->password = Hash::make($request->password);
        // lưu lại
        $obj_user->save(); 
        return redirect()->route('user.login')->with('success', "Đã cập nhật mật khẩu !!!");
    }
}
