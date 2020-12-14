<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\ShipperDetail;
use App\Consts;
use Session;
use Hash;
use DB;

class ShipperRepository extends BaseRepository implements RepositoryInterface
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

    // lấy thông tin shipper
    public function getShipper($id)
    {
        $shipper = $this->model->with('shipper_detail')->first();
        return $shipper;
    }

    // Tạo mới 1 shipper
    public function createShipper($request)
    {
        try {
            DB::beginTransaction();

            $id = $this->model->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            ShipperDetail::create([
                'shipper_id'   => $id->id,
                'telephone' => $request->telephone,
                'birthday'  => $request->birthday,
                'address'   => $request->address,
                'sex'       => $request->sex,
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session::flash('success', 'Đăng Kí Thành Công!');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra');
        }
    }

    // Cập nhật 1 shipper
    public function updateShipper($request, $id)
    {
        
        try {
            DB::beginTransaction();

            ShipperDetail::where('shipper_id', $id)->update([
                'telephone' => $request->telephone,
                'birthday'  => $request->birthday,
                'address'   => $request->address,
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session::flash('success', 'Cập nhật Thành Công!');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra');
        }
    }

    // xóa shipper
    public function deleteShipper($id)
    {
        try {
            DB::beginTransaction();
            // Delete shipper
            $shipper = $this->model->find($id);
            ShipperDetail::where('shipper_id', $id)->delete();
            $shipper->delete($id);
            DB::commit();
            Session::flash('success', 'Cập nhật Thành Công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            Session::flash('error', 'Có lỗi sảy ra');
        }
    }

    
}
