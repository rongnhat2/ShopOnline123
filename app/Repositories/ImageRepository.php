<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class ImageRepository extends BaseRepository implements RepositoryInterface
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

    public function getGallery(){
        $images = $this->model->orderBy('id', 'desc')->get();
        return $images;
    }
    public function createGallery($request){
        try {
            DB::beginTransaction();

            $image = $request->image;
            foreach ($image as $key => $value) {
                $imageitem = time() . $value->getClientOriginalName();
                $value->move(public_path('images'), $imageitem);
                $this->model->create([
                    'url'          => 'images/'.$imageitem,
                    'name'           => $value->getClientOriginalName(),
                    "created_at"    =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    "updated_at"    => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }

            Session::flash('success', 'Thêm ảnh thành công');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
        return true;
    }
    
}
