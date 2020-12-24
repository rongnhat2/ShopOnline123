<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
    public function new_order(){
        $order       = $this->order->getNewOrder();
        return view('admin.order.index', compact('order'));
    }
    // Trả về chi tiết một đơn hàng
    public function detail_order($id){
        // chi tiết đơn hàng
        $orderDetail        = $this->order_detail->getOrderDetail($id);
        // shipper
        $listShipper        = $this->shipper->getAll();
        return view('admin.order.edit', compact('orderDetail', 'listShipper'));
    }
    // Trả về chi tiết một đơn hàng
    public function assignment_order(Request $request, $id){
        // cập nhật đơn hàng cho shipper
        $orderDetail        = $this->userorder->getUpdateDetail($request, $id);
        return redirect()->route('order.new_order');
    }
    // Trả về danh sách đơn hàng đang vận chuyển
    public function trans_order(){
        $order       = $this->order->getTransOrder();
        // dd($order);
        return view('admin.order.trans', compact('order'));
    }
    // Trả về danh sách đơn hàng đang vận chuyển
    public function trans_detail($id){
        $order       = $this->order->getTransOrderDetail($id);
        return view('admin.order.trans_detail', compact('order', 'id'));
    }
    // cập nhật trạng thái
    public function trans_update($c_id, $id){
        $order       = $this->order->getTransOrderUpdate($c_id, $id);
        return redirect()->route('order.trans_order');
    }
    // lịch sử 
    public function history(){
        $order       = $this->order->getOrderHistory();
        return view('admin.order.history', compact('order'));
    }
    // lịch sử chi tiết
    public function history_detail($id){
        $orderDetail       = $this->order_detail->getOrderDetail($id);
        return view('admin.order.history_detail', compact('orderDetail'));
    }


}
