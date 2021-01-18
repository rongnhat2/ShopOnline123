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
    // lấy ra thời gian lịch sử
    public function getHistoryTime(){
        $item = $this->model
            ->select(DB::raw('count(*) as user_count'), 'order_time')
            ->groupBy('order_time')->pluck('user_count', 'order_time');
        // danh sách dữ liệu
        $listItem = array();
        foreach ($item as $key => $value) {
            $dt = new \DateTime($key);   // <== instance from another API
            $carbon = Carbon::instance($dt);

            $month_of_year = $carbon->month . '-' . $carbon->year;

            if (!array_key_exists($month_of_year, $listItem))  $listItem[$month_of_year] = 0;
            
        }
        return $listItem;
    }
    // lấy ra biểu đồ bán sản phẩm
    public function getOrderTime($month, $year){
        $item = $this->model
            ->select(DB::raw('count(*) as user_count'), 'order_time')
            ->groupBy('order_time')->pluck('user_count', 'order_time');
        // danh sách dữ liệu
        $listItem = array();
        foreach ($item as $key => $value) {
            $dt = new \DateTime($key);   // <== instance from another API
            $carbon = Carbon::instance($dt);
            if ($carbon->month == $month && $carbon->year == $year) {
                // lấy ra ngày của giá trị
                $key_value = $carbon->day;
                $listItem[$key_value] = $value;
            }
        }
        // thêm các giá trị rỗng
        // for ($i=1; $i < 32; $i++) { 
        //     if (!array_key_exists($i, $listItem)) {
        //         $listItem[$i] = 0;
        //     }
        // }
        return $listItem;
    }
    // lấy ra biểu đồ doanh thu sản phẩm
    public function getPriceTime($month, $year){
        $item = $this->model
            ->select(DB::raw('sum(prices) as user_count'), 'order_time')
            ->where('status', '=', '2')
            ->groupBy('order_time')->pluck('user_count', 'order_time');
        // danh sách dữ liệu
        $listItem = array();
        foreach ($item as $key => $value) {
            $dt = new \DateTime($key);   // <== instance from another API
            $carbon = Carbon::instance($dt);
            if ($carbon->month == $month && $carbon->year == $year) {
                // lấy ra ngày của giá trị
                $key_value = $carbon->day;
                $listItem[$key_value] = $value;
            }
        }
        return $listItem;
    }
    

}
