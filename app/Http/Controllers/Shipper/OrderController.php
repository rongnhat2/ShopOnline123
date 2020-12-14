<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\OrderRepository;
use App\Repositories\OrderUserRepository;
use App\Repositories\OrderDetailRepository;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\OrderDetail;
use App\Repositories\ShipperRepository;
use App\Models\Shipper;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;
use DB;

class OrderController extends Controller
{
    protected $order;
    protected $userorder;
    protected $order_detail;
    private $shipper;

    public function __construct(Order $order, UserOrder $userorder, OrderDetail $order_detail, Shipper $shipper)
    {
        $this->order        = new OrderRepository($order);
        $this->userorder    = new OrderUserRepository($userorder);
        $this->order_detail = new OrderDetailRepository($order_detail);
        $this->shipper      = new ShipperRepository($shipper);
    }
    // Trả về danh sách đơn hàng mới
    public function order_index(){
        $order       = $this->order->getShipperOrder(Session::get('shipper')->customer['id'] );
        return view('shipper.home', compact('order'));
    }
    
    // shipper đăng xuất
    public function logout(){
        $checkLogin = $this->admin->logout();
        return redirect()->route('admin_ship.login');
    }
}
