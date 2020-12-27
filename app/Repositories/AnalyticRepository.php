<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Consts;
use Carbon\Carbon;
use Session;
use DB;

class AnalyticRepository extends BaseRepository implements RepositoryInterface
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

    // Lấy danh sách khách hàng
    public function getListUser()
    {
        return $this->model->get();
    }
    // Lấy danh sách đơn hàng
    public function getListOrder()
    {
        return $this->model->where('status', '=', 2)->get();
    }
    // Lấy tổng doanh thu
    public function getPrices()
    {
        return $this->model->where('status', '=', 2)->sum('prices');
    }
    // Lấy tổng số sản phẩm đã bán
    public function getListProduct()
    {
        return $this->model->with(['order' => function ($q){
                $q->where('status', '=', 2);
            }]
        )->sum('quantity');
    }
    // lấy ra sản phẩm nhiều view nhất
    public function getTrending(){
        return $this->model->orderBy('view', 'desc')
            ->with(['order_detail' => function ($q){
                $q->select('item_id', DB::raw('sum(quantity) as total'))
                    ->groupBy('item_id')->get();
            }]
        )->take(5)->get();
    }
    // lấy ra sản phẩm nhiều lượt mua nhất
    public function getBuying(){
        return $this->model
            ->with(['order_detail' => function ($q){
                $q->select('item_id', DB::raw('sum(quantity) as total'))
                    ->groupBy('item_id')->orderBy('total', 'desc')->get();
            }]
        )->take(5)->get();
    }
    // lấy ra tỉ lệ mua hàng thành công
    public function getOrderSuccess(){
        return $this->model->where('status', '=', 2)->count();
    }
    // lấy ra tỉ lệ mua hàng hủy
    public function getOrderRemove(){
        return $this->model->where('status', '=', '-1')->count();
    }

    // lấy ra sản phẩm nam
    public function getManProduct(){
        return $this->model->where('sex', '=', '1')->count();
    }
    // lấy ra sản phẩm nữ
    public function getWomanProduct(){
        return $this->model->where('sex', '=', '2')->count();
    }
    public function getOrder(){
        return $this->model->count();
    }
    public function getFirstOrder(){
        return $this->model->first();
    }
    // lấy ra biểu đồ bán sản phẩm
    public function getOrderTime($month, $year){
        $item = $this->model->get();
        foreach ($item as $key => $value) {
            $dt = new \DateTime($value->created_at);   // <== instance from another API
            $carbon = Carbon::instance($dt);
            echo $carbon->day; 
            die;
        }
    }

}
