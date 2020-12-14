<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class OrderDetailRepository extends BaseRepository implements RepositoryInterface
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

    
    
    // Customer - Đăt hang chi tiết đơn hangf
    public function submitSubOrder($order_id, $items, $quantity, $sizes, $colors, $prices)
    {
        // dd($order_id, $items, $quantity, $sizes, $colors, $prices);
        try {
            DB::beginTransaction();

            $id = $this->model->create([
                'order_id'  => $order_id,
                'item_id'   => $items,
                'quantity'  => $quantity,
                'size'      => $sizes,
                'color'     => $colors,
                'price'     => $prices,
            ]);

            DB::commit();
            return $id;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return true;
        }
    }

    //  Customer - Admin - trả về chi tiết đơn hàng
    public function getOrderDetail($id){
        $order = $this->model->where('order_id', $id)->with('item')->get();
        // dd($order);
        return $order;
    }



}
