<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Cart;
use Session;
use Hash;
use DB;

class CartController extends Controller
{
    protected $item;

    public function __construct(Item $item)
    {
        $this->item         = new ItemRepository($item);
    }

    public function add_to_cart(Request $request){
        $oldCart    =   Session('cart') ? Session::get('cart') : null;

        // Lấy sản phẩm được chọn
        $item = $this->item->find($request->id);
        // lấy giá trị sản phẩm hiện tại
        $item_price = $item->price - ($item->price / 100 * $item->discount);
        // dd($item_price);

        $cart       =   new Cart($oldCart);
        $cart->add($request, $item_price);
        $request->session()->put('cart', $cart);
        Session::flash('success', 'Đã thêm sản phẩm vào giỏ hàng');
        return redirect()->back();
    }
    public function update_cart(Request $request, $id, $item_id){

        $quantity = $request->quantity;
        // lấy session
        $oldCart    =   Session('cart') ? Session::get('cart') : null;
        // Lấy sản phẩm được chọn
        $item = $this->item->find($item_id);
        // lấy giá trị sản phẩm hiện tại
        $item_price = $item->price - ($item->price / 100 * $item->discount);

        $cart       =   new Cart($oldCart);
        $cart->UpdateAmount($id, $item_price, $quantity);
        $request->session()->put('cart', $cart);
        Session::flash('success', 'Đã Cập nhật giỏ hàng');
        return redirect()->back();
        // return redirect()->Route('customer.shopping_cart');
    }
    public function delete_cart(Request $request, $id, $item_id){
        // lấy session
        $oldCart    =   Session('cart') ? Session::get('cart') : null;
        // Lấy sản phẩm được chọn
        $item = $this->item->find($item_id);
        // lấy giá trị sản phẩm hiện tại
        $item_price = $item->price - ($item->price / 100 * $item->discount);
        
        $cart       =   new Cart($oldCart);
        $cart->DeleteAmount($id, $item_price);
        $request->session()->put('cart', $cart);
        Session::flash('success', 'Đã Cập nhật giỏ hàng');
        return redirect()->back();
        // return redirect()->Route('customer.shopping_cart');
    }

    public function clear(){
        Session::flush();
        return redirect()->Route('user.index');
    }
}
