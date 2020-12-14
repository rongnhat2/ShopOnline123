<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Session;
use DB;

class ItemRepository extends BaseRepository implements RepositoryInterface
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

    // Lấy ra 1 sản phẩm theo tên
    public function getDetailItem($slug){
        $item = $this->model->where('slug', $slug)->with('images')->with('composition')->with('property')->with('category')->with('style')->with(['color' => function ($q){
                $q->with('quantitys');
            }]
        )->first();
        return $item;
    }

    // Lấy ra Số lượng theo màu
    public function getQuantityItem($id, $color){
        $item = $this->model->where('id', $id)->with(['color' => function ($q){
                $q->with('quantitys')->where('hex', $color);
            }]
        )->first();
        return $item;
    }
    // Lấy ra 1 sản phẩm theo giới tính
    public function getItemBySex($sex){
        $item = $this->model->where('sex', $sex)->paginate(10);
        return $item;
    }
    // Lấy ra 1 sản phẩm theo slug
    public function getItemBySlug($slug){
        $item = $this->model->where('slug', $slug)->paginate(10);
        return $item;
    }
    // Lấy ra tất cả sản phẩm
    public function getItemAll(){
        $item = $this->model->paginate(10);
        return $item;
    }


    // Lấy ra sản phẩm
    public function getItem(){
        $images = $this->model->orderBy('id', 'desc')->get();
        return $images;
    }
    // Lấy ra sản phẩm mới
    public function getNewItem(){
        $images = $this->model->orderBy('id', 'desc')->take(10)->get();
        return $images;
    }
    // Lấy ra sản phẩm mới
    public function getBestItem(){
        $images = $this->model->orderBy('view', 'desc')->take(5)->get();
        return $images;
    }


    // Thêm sản phẩm
    public function createItem($valid_image, $request){
        $category = ($request->category == null) ? '0' : $request->category;
        $sex = ($request->sex == null) ? '3' : $request->sex;
        $discount = ($request->discount == null) ? '0' : $request->discount;
        try {
            DB::beginTransaction();

            $this->model->create([
                'category_id'       => $category,
                'image'             => $valid_image,
                'name'              => $request->name,
                'price'             => $request->price,
                'discount'          => $discount,
                'detail'            => $request->detail,
                'description'       => $request->description,
                'sex'               => $sex,
                'view'              => '0',
                'slug'              => static::to_slug($request->name),
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            Session::flash('success', 'Thêm ảnh thành công');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
        return true;
    }

    // Cập nhật sản phẩm
    public function updateItem($valid_image, $request, $id){
        $category = ($request->category == null) ? '0' : $request->category;
        $sex = ($request->sex == null) ? '3' : $request->sex;
        $discount = ($request->discount == null) ? '0' : $request->discount;
        try {
            DB::beginTransaction();

            $this->model->where('id', $id)->update([
                'category_id'       => $category,
                'image'             => $valid_image,
                'name'              => $request->name,
                'price'             => $request->price,
                'discount'          => $discount,
                'detail'            => $request->detail,
                'description'       => $request->description,
                'sex'               => $sex,
                'view'              => '0',
                'slug'              => static::to_slug($request->name),
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            Session::flash('success', 'Thêm ảnh thành công');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
        return true;
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

    // Xóa sản phẩm
    public function deleteItem($id)
    {
        try {
            DB::beginTransaction();
            // Delete item
            $item = $this->model->find($id);
            $item->delete($id);
            DB::commit();
            Session::flash('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
    }

    // cập nhật thuộc tính
    public function updateDetail($request, $id){
        // dd($request);
        try {
            // xóa dữ liệu copy cũ
            DB::table('item_style')->where('item_style.item_id', '=', $id)->delete();
            DB::table('item_property')->where('item_property.item_id', '=', $id)->delete();
            DB::table('item_composition')->where('item_composition.item_id', '=', $id)->delete();

            // tạo dữ liệu copy mới
            if ($request->style != null) {
                foreach ($request->style as $key => $value) {
                    DB::table('item_style')->insert([
                        'item_id'              =>  $id,
                        'style_id'              =>  $value,
                        "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                        "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
                } 
            }
            if ($request->property != null) {
                foreach ($request->property as $key => $value) {
                    DB::table('item_property')->insert([
                        'item_id'              =>  $id,
                        'property_id'              =>  $value,
                        "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                        "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
                } 
            }
            if ($request->composition != null) {
                foreach ($request->composition as $key => $value) {
                    DB::table('item_composition')->insert([
                        'item_id'              =>  $id,
                        'composition_id'              =>  $value,
                        "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                        "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                    ]);
                } 
            }
            Session::flash('success', 'Cập nhật thành công');
        } catch (\Exception $exception) {
            // dd($exception);
            Session::flash('error', 'Lỗi cập nhật');
            DB::rollBack();
        }
    }

    // Lấy tất cả hình ảnh của sản phẩm
    public function getImage($id){
        $image = $this->model->with('images')->where('id', $id)->first();
        return $image;
    }
    // Thêm mới một hình ảnh vào sản phẩm
    public function createImage($request, $id){
        try {
            DB::beginTransaction();

            DB::table('item_image')->insert([
                'item_id'           => $id,
                'image_id'          => $request->image_id,
                "created_at"        =>  \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
                "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
            ]);

            Session::flash('success', 'Thêm Thành Công');
            DB::commit();
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'heroku chỉ lưu ảnh trong thời gian ngắn nên chút nữa nó sẽ mất đó nhé :>');
            DB::rollBack();
        }
    }

    // Xóa 1 hình ảnh được chọn của sản phẩm
    public function deleteImage($id, $c_id)
    {
        try {
            DB::beginTransaction();

            DB::table('item_image')
                ->where('item_image.item_id', '=', $id)
                ->where('item_image.image_id', '=', $c_id)
                ->delete();

            DB::commit();
            Session::flash('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            dd($exception);
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại');
            DB::rollBack();
        }
    }
    public function to_slug($string){

        $str = trim(mb_strtolower($string));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);

        return $str;
    }
}
