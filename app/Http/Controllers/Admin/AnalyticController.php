<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\AnalyticRepository;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\UserOrder;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\OrderDetail;

class AnalyticController extends Controller
{
    protected $carousel;
    protected $user;
    protected $order;
    protected $order_detail;
    protected $user_order;
    protected $item;

    public function __construct(Item $item, User $user, UserOrder $user_order, Order $order, OrderDetail $order_detail)
    {
        $this->user 		= new AnalyticRepository($user);
        $this->user_order 	= new AnalyticRepository($user_order);
        $this->order 		= new AnalyticRepository($order);
        $this->order_detail = new AnalyticRepository($order_detail);
        $this->item         = new AnalyticRepository($item);
    }
    /**
     * show analytic Index List
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function analytic(Request $request){
    	// lấy ra số sản phẩm đã bán
    	$product_data  = $this->order_detail->getListProduct();
    	// lấy ra số khách hàng
    	$customer_data  = sizeof($this->user->getListUser());
    	// lấy ra số đơn hàng
    	$order_data  = sizeof($this->order->getListOrder());
    	// lấy ra tổng doanh số
    	$prices_data  = $this->order->getPrices();

    	// top trending
    	$trending_data = $this->item->getTrending();
    	// top buying
    	$buying_data = $this->item->getBuying();

    	// đơn hàng thành công
		$buying_success = $this->order->getOrderSuccess();
    	// đơn hàng hủy
		$buying_remove = $this->order->getOrderRemove();

    	// đồ nam
		$product_man 	= $this->item->getManProduct();
    	// đồ nữ
		$product_woman 	= $this->item->getWomanProduct();

		// kiểm tra thời gian bắt đầu dự án
		$checkTime 	= $this->order->getOrder();

		// lấy ra danh sách duyệt thời gian
    	$time 			= array();

		if ($checkTime == 0) {
			$month_time = Carbon::now()->month;
			$year_time = Carbon::now()->year;
		}else{
			$firstTime 	= $this->order->getFirstOrder();

            $dt = new \DateTime($firstTime->created_at);   // <== instance from another API
            $carbon = Carbon::instance($dt);

			$month_time = $carbon->month;
			$year_time = $carbon->year;
			
		}
		// dd($month_time, $year_time);

		// $time_month	= $request->time_month == null ? Carbon::now()->month : $request->time_month;
		// $time_year	= $request->time_year == null ? Carbon::now()->year : $request->time_year;
    	
    	// dd($time_month, $time_year);
    	// $carousel = $this->carousel->getCarousel();
        return view('admin.analytic', compact('customer_data', 'order_data', 'prices_data', 'product_data', 'trending_data', 'buying_data', 'buying_success', 'buying_remove', 'product_man', 'product_woman'));
    }
}
