<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Order;
use App\Consts;
use Session;
use DB;

class OrderRepository extends BaseRepository implements RepositoryInterface
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

    // Admin - lấy đơn hàng mới
    public function getNewOrder()
    {
        $order = $this->model->where('status', 0)->with(['user_order' => function ($q){
                $q->with(['user' => function ($q1){
                    $q1->with('user_detail');
                }]
            );
            }]
        )->orderBy('created_at', 'desc')->get();
        return $order;
    }
    // Admin - lấy Lịch sử đơn hàng
    public function getOrderHistory()
    {
        $order = $this->model->with(
            ['user_order' => function ($q){
                $q->with(
                    ['shipper' => function ($q1){
                        $q1->with('shipper_detail');
                    }]
                )->with(
                    ['user' => function ($q1){
                        $q1->with('user_detail');
                    }]
                )->with(
                    ['order' => function ($q1){
                        $q1->with('order_detail');
                    }]
                );
            }]
        )->orderBy('created_at', 'desc')->get();
        return $order;
    }
    


    // Admin - lấy đơn hàng đang vận chuyển
    public function getTransOrder()
    {
        $order = $this->model->where('status', 1)->with(
            ['user_order' => function ($q){
                $q->with('shipper');
            }]
        )->orderBy('created_at', 'desc')->get();
        return $order;
    }
    // Admin - lấy chi tiết đơn hàng đang vận chuyển
    public function getTransOrderDetail($id)
    {
        $order = $this->model->where('id', $id)->with(['user_order' => function ($q){
                $q->with(['shipper' => function ($q1){
                        $q1->with('shipper_detail');
                    }]
                )->with(['user' => function ($q1){
                        $q1->with('user_detail');
                    }]
                );
            }]
        )->first();
        return $order;
    }
    // xác nhận trạng thái cuối của đơn hàng - Hủy - thành công
    public function getTransOrderUpdate($c_id,  $id){
        $order = $this->model->where('id', $c_id)->with(['user_order' => function ($q){
                $q->with(['shipper' => function ($q1){
                        $q1->with('shipper_detail');
                    }]
                )->with(['user' => function ($q1){
                        $q1->with('user_detail');
                    }]
                )->with(
                    ['order' => function ($q1){
                        $q1->with('order_detail');
                    }]
                );
            }]
        )->first();
        $list_item = $order->user_order[0]->order->order_detail;
        foreach ($list_item as $key => $value) {
            // số lượng ban đầu
            $quantity = $borrow = DB::table('item')
                        ->join('item_color', 'item_color.item_id', '=', 'item.id')
                        ->join('item_quantity', 'item_color.id', '=', 'item_quantity.item_color')
                        ->where('item.id', '=', $value->item_id)
                        ->where('item_color.hex', '=', $value->color)
                        ->where('item_quantity.size', '=', $value->size)
                        ->first()->quantity;
                        // số lượng trong đơn hàng
            $quantity_order = $value->quantity;
            // cập nhật đối tượng
            DB::table('item')
                        ->join('item_color', 'item_color.item_id', '=', 'item.id')
                        ->join('item_quantity', 'item_color.id', '=', 'item_quantity.item_color')
                        ->where('item.id', '=', $value->item_id)
                        ->where('item_color.hex', '=', $value->color)
                        ->where('item_quantity.size', '=', $value->size)->update([
                'quantity' => $quantity - $quantity_order,
            ]);
        }

        try {
            DB::beginTransaction();

            Order::where('id', $c_id)->update([
                'status'            => $id,
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            Session::flash('success', 'Cập nhật Thành Công!');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra');
        }
    }


    // Shipper - lấy  đơn hàng
    public function getShipperOrder($id)
    {
        $order = $this->model->with(
            ['user_order' => function ($q){
                $q->with(
                    ['shipper' => function ($q1){
                        $q1->with('shipper_detail');
                    }]
                )->with(
                    ['user' => function ($q1){
                        $q1->with('user_detail');
                    }]
                )->with(
                    ['order' => function ($q1){
                        $q1->with('order_detail')->where('status', '=', '1');
                    }]
                );
            }]
        )->orderBy('created_at', 'desc')->get();
        return $order;
    }
    
    // Customer - Đăt hàng
    public function createOrder($prices)
    {
        try {
            DB::beginTransaction();

            $id = $this->model->create([
                'code'  => 'CS' . rand(0, 10000),
                'prices' => $prices,
                'status' => '0',
                'payment' => '1',
                'order_time'    => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            
            DB::commit();
            return $id;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return true;
        }
    }
    // Customer - Đăt hàng Online
    public function createOrderOnline($prices)
    {
        try {
            DB::beginTransaction();

            $id = $this->model->create([
                'code'          => 'CS' . rand(0, 10000),
                'prices'        => $prices,
                'status'        => '0',
                'payment'       => '2',
                'order_time'    => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
            
            DB::commit();
            return $id;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return true;
        }
    }
}
