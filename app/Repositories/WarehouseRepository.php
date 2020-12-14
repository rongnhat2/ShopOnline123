<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class WarehouseRepository extends BaseRepository implements RepositoryInterface
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

    // Lấy lịch sử nhập kho
    public function getWarehouse()
    {
        return $this->model->with('admin')->orderBy('id', 'desc')->get();
    }
    // Tạo lịch sử nhập kho
    public function createQuantity($user_id, $request, $id, $c_id)
    {
        // dd(\Carbon\Carbon::now('Asia/Ho_Chi_Minh'));
        try {
            DB::beginTransaction();
            // vòng lặp 5 size của sản phẩm XS, S, M, L, XL
            $insert_index = 5;
            $name       = $request->name;
            $color      = $request->color;
            $size       = $request->size;
            $quantity   = $request->quantity;
            for ($i=0; $i < $insert_index; $i++) { 
                if ($quantity[$i] > 0) {
                    $this->model->create([
                        'user_id'           =>  $user_id,
                        'name'              =>  $name[$i],
                        'color'             =>  $color[$i],
                        'size'              =>  $size[$i],
                        'quantity'          =>  $quantity[$i],
                        "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                        "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            return true;
        }
    }


}
