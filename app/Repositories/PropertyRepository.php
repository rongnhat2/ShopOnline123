<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class PropertyRepository extends BaseRepository implements RepositoryInterface
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

    // Thêm 1 thuộc tính
    public function createProperty($request)
    {
        try {
            DB::beginTransaction();

            $this->model->create([
                'name'              =>  $request->name,
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            Session::flash('success', 'Thêm thành công');
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            // dd($exception);
            Session::flash('error', 'Đã có lỗi sảy ra');
            DB::rollBack();
            return true;
        }
    }

    // Xóa 1 thuộc tính
    public function deleteProperty($id)
    {
        try {
            DB::beginTransaction();

            $this->model->destroy($id);

            Session::flash('success', 'Xóa thành công');
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            // dd($exception);
            Session::flash('error', 'Đã có lỗi sảy ra');
            DB::rollBack();
            return true;
        }
    }

    
}
