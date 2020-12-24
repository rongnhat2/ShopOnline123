<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Repositories\OrderRepository;
use App\Repositories\OrderUserRepository;
use App\Repositories\OrderDetailRepository;
use App\Repositories\ItemRepository;
use DB;
use App\Models\Order;
use App\Models\Item;
use App\Models\UserOrder;
use App\Models\OrderDetail;

class PaymentController extends Controller
{
    protected $item;
    protected $order;
    protected $userorder;
    protected $order_detail;

    public function __construct(Item $item, Order $order, UserOrder $userorder, OrderDetail $order_detail)
    {
        $this->item         = new ItemRepository($item);
        $this->order        = new OrderRepository($order);
        $this->userorder    = new OrderUserRepository($userorder);
        $this->order_detail = new OrderDetailRepository($order_detail);
    }
	public function get_pay(){
		return view('user.payment');
	}
	public function create_pay(Request $request){
        $cart = Session('cart') ? Session::get('cart') : null;
		$prices = $cart->totalPrice;
        session(['url_prev' => 'http://localhost:8000/purchase/history']);
        $vnp_TmnCode = "6NE7KUNZ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "USUYDLXTCYCNCTNTVRUCQCJBUIELNVGF"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:8000/return-vnpay";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $prices * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }
    public function return_pay(Request $request)
	{
		// dd($request);
	    $url = session('url_prev','/');
	    if($request->vnp_ResponseCode == "00") {
	        // kiểm tra băt buộc đăng nhập và có dữ liệu trong giỏ hàng
	        $customer = Session('customer') ? Session::get('customer') : null;
	        $cart = Session('cart') ? Session::get('cart') : null;

            // thêm vào bảng order
            $order_id = $this->order->createOrderOnline($request->vnp_Amount / 100)->id;
            // thêm vào bảng user_order
            $user_order_id = $this->userorder->submitUserOrder($customer->customer['id'], $order_id);
            // thêm vào bảng order_detail
            foreach ($cart->items as $key => $value) {
                $item           = $this->item->find($value['id']);
                $item_price     = $item->price - ($item->price / 100 * $item->discount);
                $user_order_detail = $this->order_detail->submitSubOrder($order_id, $value['id'], $value['qty'], $value['size'], $value['color'], $item_price);
            }
            Session::remove('cart');
        	return redirect($url)->with('success' ,'Đã thanh toán phí dịch vụ');

	    }
	    session()->forget('url_prev');
	    return redirect($url)->with('errors' ,'Lỗi trong quá trình thanh toán phí dịch vụ');
	}
}
