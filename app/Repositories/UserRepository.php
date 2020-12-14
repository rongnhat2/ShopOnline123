<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class UserRepository extends BaseRepository implements RepositoryInterface
{
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function getAll()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, $id = null)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }


    // đăng nhập
    public function login($request){
        // lấy dữ liệu từ request
        $email = $request->input('email');
        $password = $request->input('password');

        // Kiểm tra đúng email và mật khẩu sẽ chuyển trang
        if( Auth::attempt(['email' => $email, 'password' =>$password])) {
            // lưu user đăng nhập vào session

            // lấy ra user
            $customer_session   =   $this->model->where('email', $email)->first();
            //tạo mới đối tượng user
            $customer           =   new Customer($customer_session);
            $customer->Create($customer_session);
            // lưu đối tượng vào session
            $request->session()->put('customer', $customer);
            return true;
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return false;
        }
    }

    // cập nhật thông tin
    public function updateData($request, $id){

        try {
            DB::beginTransaction();

            DB::table('user_detail')->where('user_id', '=', $id)->update ([
                'telephone'          => $request->telephone,
                'birthday'              => $request->birthday,
                'address'             => $request->address,
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            Session::flash('success', 'Cập nhật thành công');
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            // dd($exception);
            Session::flash('error', 'Đã có lỗi sảy ra');
            DB::rollBack();
            return true;
        }

    }

    // đổi mật khẩu
    public function password($request){
        // lấy ra dữ liệu trong request
        $request_data = $request->All();
        // lấy ra mật khẩu cũ
        $current_password = Auth::User()->password;    
        // Kiểm tra mật khẩu cũ   
        if(Hash::check($request_data['current-password'], $current_password)) {  
            // lấy id cần đổi          
            $user_id = Auth::User()->id;       
            // lấy user cần đổi                 
            $obj_user = $this->model::find($user_id);
            // lấy tạo mật khẩu mới               
            $obj_user->password = Hash::make($request_data['password']);
            // lưu lại
            $obj_user->save(); 
            return true;
        } else {   
            // trả về false nếu mật khẩu cũ không chính xác        
            return false;
        }
    }

    // đăng xuất
    public function logout(){
        Auth::logout();
        Session::flash('success', 'Bạn đã đăng xuất!');
        return true;
    }
    
}
