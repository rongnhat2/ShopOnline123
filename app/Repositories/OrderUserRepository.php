<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Order;
use App\Consts;
use Session;
use DB;

class OrderUserRepository extends BaseRepository implements RepositoryInterface
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

    // lấy dữ liệu lịch sử đơn hàng của khách hàng
    public function getUserOrder($user_id)
    {
        $data = $this->model->where('user_id', $user_id)->with(['order' => function ($q){
                $q->with('order_detail');
            }])->orderBy('id', 'desc')->paginate(10);
        return $data;
    }
    // lấy dữ liệu chi tiết đơn hàng
    public function getDetailOrder($id)
    {
        $data = $this->model->where('id', $id)
            ->with(['order' => function ($q){
                $q->with(['order_detail' => function ($q1){
                    $q1->with('item');
                }]);
            }])->orderBy('id', 'desc')->first();
        return $data;
    }
    // Đăt hang
    public function submitUserOrder($user_id, $order_id)
    {
        // dd($user_id, $order_id);
        try {
            DB::beginTransaction();

            $id = $this->model->create([
                'user_id'  => $user_id,
                'order_id' => $order_id,
            ]);

            DB::commit();
            return $id;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return true;
        }
    }

    // Phân đơn hàng cho ship và cập nhật thông tin đơn hàng
    public function getUpdateDetail($request, $id){
        try {
            DB::beginTransaction();

            $this->model->where('order_id', $id)->update([
                'shipper_id'        => $request->shipper,
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Order::where('id', $id)->update([
                'status'            => '1',
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session::flash('success', 'Cập nhật Thành Công!');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra');
        }
    }

}
