<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Consts;
use Session;
use Hash;
use DB;

class AdminRepository extends BaseRepository implements RepositoryInterface
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
        $email = $request->input('email');
        $password = $request->input('password');

        if( Auth::guard('admin')->attempt(['email' => $email, 'password' =>$password])) {
            // Kiểm tra đúng email và mật khẩu sẽ chuyển trang

            // lưu user đăng nhập vào session
            $customer_session   =   $this->model->where('email', $email)->first();
            $customer           =   new Customer($customer_session);
            $customer->Create($customer_session);
            $request->session()->put('customer', $customer);
            return true;
        } else {
            // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
            Session::flash('error', 'Email hoặc mật khẩu không đúng!');
            return false;
        }
    }

    // đổi mật khẩu
    public function password($request){
        $request_data = $request->All();
        $current_password = Auth::guard('admin')->User()->password;           
        if(Hash::check($request_data['current-password'], $current_password)) {           
            $user_id = Auth::guard('admin')->User()->id;                       
            $obj_user = $this->model::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);
            $obj_user->save(); 
            return true;
        } else {           
            return false;
        }
    }

    // đăng xuất
    public function logout(){
        Auth::guard('admin')->logout();
        Session::flash('success', 'Bạn đã đăng xuất!');
        return true;
    }
    
}
