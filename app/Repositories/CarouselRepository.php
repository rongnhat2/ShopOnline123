<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class CarouselRepository extends BaseRepository implements RepositoryInterface
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

    public function getCarousel(){
        $carousel = $this->model->get();
        return $carousel;
    }

    // Thêm 1 carousel mới
    public function createCarousel($valid_image, $request){
        try {
            $this->model->create([
                'image'     => $valid_image,
                'title'     => $request->title,
                'detail'    => $request->detail,
            ]);
            Session::flash('success', 'Tạo thành công: '.$request->title);
        } catch (\Exception $exception) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { insert to table "technologies" }');
            DB::rollBack();
        }
        return true;
    }
    // Cập nhật carousel
    public function updateCarousel($valid_image, $request, $id){
        try {
            $this->model->where('id', $id)->update([
                'image'     => $valid_image,
                'title'     => $request->title,
                'detail'    => $request->detail,
            ]);
            Session::flash('success', 'Cập nhật thành công: '.$request->title);
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { update row "technologies" }');
            DB::rollBack();
        }
        return true;
    }

    // Xóa carousel
    public function deleteCarousel($id)
    {
        try {
            DB::beginTransaction();
            // Delete Carousel
            $carousel = $this->model->find($id);
            $carousel->delete($id);
            DB::commit();
            Session::flash('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
    }

    /**
     *  check the Valid Image upload
     *  kiểm tra ảnh đã được upload hay chưa
     *  @return $id Image to insert
     */
    public function check_valid($request){
        $return_url = '';
        $value_id = $request->get_image;
        // dd($value_id);
        if ($value_id == 1) {
            try {
                $image = $request->upload_image;
                $imageitem = time() . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageitem);
                $image_id = DB::table('images')->insertGetId([
                    'url'               => 'images/'.$imageitem,
                    'name'              => $image->getClientOriginalName(),
                    "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
                $return_url = 'images/'.$imageitem;
            } catch (\Exception $exception) {
                DB::rollBack();
            }
        }else if ($value_id == 2){
            $return_url = DB::table('images')->where('id', $request->gallery_image)->first()->url;
        }else{
            $return_url = $request->gallery_image;
        }
        return $return_url;
    }
    
}
