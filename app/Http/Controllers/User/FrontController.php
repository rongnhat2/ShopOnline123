<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CarouselRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\UserRepository;
use App\Repositories\OrderRepository;
use App\Repositories\OrderUserRepository;
use App\Repositories\OrderDetailRepository;
use App\Models\Carousel;
use App\Models\Category;
use App\Models\Item;
use App\Models\User;
use App\Models\Order;
use App\Models\UserOrder;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Session;
use Auth;
use Hash;
use DB;

class FrontController extends Controller
{
    protected $carousel;
    protected $category;
    protected $item;
    protected $user;
    protected $order;
    protected $userorder;
    protected $order_detail;

    public function __construct(Item $item, Carousel $carousel, Category $category, User $user, Order $order, UserOrder $userorder, OrderDetail $order_detail)
    {
        $this->carousel     = new CarouselRepository($carousel);
        $this->category     = new CategoryRepository($category);
        $this->item         = new ItemRepository($item);
        $this->user         = new UserRepository($user);
        $this->order        = new OrderRepository($order);
        $this->userorder    = new OrderUserRepository($userorder);
        $this->order_detail = new OrderDetailRepository($order_detail);
    }
    /**
     * Trả về trang chủ người dùng
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $carousel       = $this->carousel->getCarousel();
        $category       = $this->category->getAll();
        $items          = $this->item->getNewItem();
        $best_items     = $this->item->getBestItem();

    	return view('user.index', compact('carousel', 'category', 'items', 'best_items'));
    }

    /**
     * Function get data and Show the user product-detail..
     *
     * @return view product-detail
     */
    public function product_detail($slug){
        // dd(Session::get('cart'));
        $category       = $this->category->getAll();
        $item = $this->item->getDetailItem($slug);
        $size_data = array("XS", "S", "M", "L", "XL");
        $items          = $this->item->getNewItem();
        $has_buy = false;
        if ($item->color != null) {
           $has_buy = true;
        }
        return view('user.product-details', compact('items', 'item', 'category', 'size_data', 'has_buy'));
    }

    public function shop_list($slug){
        // danh mục sản phẩm
        $category       = $this->category->getAll();

        if ($slug == "nam") {
            // Tên danh mục
            $category_title = "Thời trang nam";
            // Sản phẩm
            $items = $this->item->getItemBySex(1);
        }
        else if ($slug == "nu") {
            // Tên danh mục
            $category_title = "Thời trang nữ";
            // Sản phẩm
            $items = $this->item->getItemBySex(2);
        }else if ($slug == "tat-ca-san-pham") {
            // Tên danh mục
            $category_title = "Tất cả sản phẩm";
            // Sản phẩm
            $items = $this->item->getItemAll();
        }else{
            // Tên danh mục
            $category_title = $this->category->getCategoryBySlug($slug)->name;
            // Sản phẩm
            $items = $this->item->getItemBySlug($slug);
        }
        return view('user.shop-list', compact('category', 'category_title', 'items'));
    }
    // trang giỏ hàng
    public function shopping_cart(){
        // dd(Session::get('cart'));
        $category       = $this->category->getAll();
        $cart = Session('cart') ? Session::get('cart') : null;
        $items = array();
        $quantity = array();
        $sizes = array();
        $colors = array();
        $keys = array();
        if ($cart) {
            foreach ($cart->items as $key => $value) {
                $item          = $this->item->find($value['id']);
                $quant          = $value['qty'];
                $size          = $value['size'];
                $color          = $value['color'];
                $s_key          = $key;
                array_push($items, $item);
                array_push($quantity, $quant);
                array_push($sizes, $size);
                array_push($colors, $color);
                array_push($keys, $s_key);
            }
        }
        return view('user.shopping-cart', compact('category', 'cart', 'items', 'quantity', 'sizes', 'colors', 'keys'));
    }
    // trang đặt hàng
    public function checkout(){
        // kiểm tra băt buộc đăng nhập
        $customer = Session('customer') ? Session::get('customer') : null;
        if ($customer == null) {
           return redirect()->route('user.login');
        }
        // nếu đăng nhâp thì chạy tiếp
        $category       = $this->category->getAll();
        $cart = Session('cart') ? Session::get('cart') : null;
        $customer_data = null;
        if ($customer) {
            $customer_data = $this->user->with('user_detail')->find($customer->customer['id']);
        }
        $items = array();
        $quantity = array();
        $sizes = array();
        $colors = array();
        $keys = array();
        if ($cart) {
            foreach ($cart->items as $key => $value) {
                $item          = $this->item->find($value['id']);
                $quant          = $value['qty'];
                $size          = $value['size'];
                $color          = $value['color'];
                $s_key          = $key;
                array_push($items, $item);
                array_push($quantity, $quant);
                array_push($sizes, $size);
                array_push($colors, $color);
                array_push($keys, $s_key);
            }
        }
        return view('user.checkout', compact('category', 'cart', 'items', 'quantity', 'sizes', 'colors', 'keys', 'customer_data'));
    }
    // đặt hàng thành công
    public function submit_cart(){
        // kiểm tra băt buộc đăng nhập và có dữ liệu trong giỏ hàng
        $customer = Session('customer') ? Session::get('customer') : null;
        $cart = Session('cart') ? Session::get('cart') : null;
        // dd($cart->totalPrice);
        if ($customer == null || $cart == null) {
           return redirect()->route('user.index');
        }else{
            // lấy dữ liệu từ session
            $customer_data = $this->user->with('user_detail')->find($customer->customer['id']);

            // thêm vào bảng order
            $order_id = $this->order->createOrder($cart->totalPrice)->id;
            // thêm vào bảng user_order
            $user_order_id = $this->userorder->submitUserOrder($customer->customer['id'], $order_id);
            // thêm vào bảng order_detail
            foreach ($cart->items as $key => $value) {
                $item           = $this->item->find($value['id']);
                $item_price     = $item->price - ($item->price / 100 * $item->discount);
                $user_order_detail = $this->order_detail->submitSubOrder($order_id, $value['id'], $value['qty'], $value['size'], $value['color'], $item_price);
            }
            Session::remove('cart');
            return redirect()->route('customer.history');
        }
    }
    // cập nhật thông tin cá nhân
    public function updateData(Request $request){
        if (Auth::check()) {
            $customer = Session('customer') ? Session::get('customer') : null;
            $data = $this->user->updateData($request, $customer->customer['id']);
            return redirect()->back();
        }else{
            return redirect()->route('user.login');
        }
    }
    // Hiển thị lịch sử mua hàng
    public function history(){
        if (Auth::check()) {
            $customer = Session('customer') ? Session::get('customer') : null;
            $data = $this->userorder->getUserOrder($customer->customer['id']);
            $category       = $this->category->getAll();
            return view('user.history', compact('category', 'data'));
        }else{
            return redirect()->route('user.login');
        }
    }
    // Hiển thị lịch sử mua hàng - chi tiết
    public function historyDetail($id){
        if (Auth::check()) {
            $customer = Session('customer') ? Session::get('customer') : null;
            $data = $this->userorder->getDetailOrder($id);
            // dd($data);
            $category       = $this->category->getAll();
            return view('user.history-detail', compact('category', 'data'));
        }else{
            return redirect()->route('user.login');
        }
    }
    // Hiển thị thông tin cá nhân
    public function purchase(){
        if (Auth::check()) {
            $customer = Session('customer') ? Session::get('customer') : null;
            $data = $this->user->with('user_detail')->find($customer->customer['id']);
            $category       = $this->category->getAll();
            return view('user.purchase', compact('category', 'data'));
        }else{
            return redirect()->route('user.login');
        }
    }
    /**
     * Function AJAX update view on click item.
     *
     * @return 
     */
    public function view(Request $request){
        $view =  DB::table('item')->where('id', $request->id)->first()->view;
        $view = $view + 1;
        DB::table('item')->where('id', $request->id)->update([
            'view' => $view,
            "updated_at"        => \Carbon\Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return $view;
    }

    public function search(Request $request){
        // danh mục sản phẩm
        $category       = $this->category->getAll();

        // Tên danh mục
        $category_title = "Danh mục sản phẩm";
        // Sản phẩm
        $items = $this->item->findItem($request);

        return view('user.shop-list', compact('category', 'category_title', 'items'));
    }
    public function contact(){
        // danh mục sản phẩm
        $category       = $this->category->getAll();
        return view('user.contact-us', compact('category'));
    }
}
