<?php

namespace App;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty = $oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $item_price){

        $giohang = ['qty'=> 0, 'id' => $item->id, 'size' => $item->size_data, 'color' => $item->color_data];
        if($this->items){
            if(array_key_exists($item->color_id.'_'.$item->size_data, $this->items)){
                $giohang = $this->items[$item->color_id.'_'.$item->size_data];
            }
        }
        $giohang['qty'] += $item->quantity;
        
        $this->totalQty += $item->quantity;
        $this->totalPrice += $item_price * $item->quantity;
        $this->items[$item->color_id.'_'.$item->size_data] = $giohang;
        // dd($this->items);
    }

	// Cập Nhật Sản Phẩm
	public function UpdateAmount($id, $item_price, $quantity){
		// dd($this->items[$id]);
		// lấy ra sản phẩm
		$item_cache = $this->items[$id];

		// lấy ra số lượng
		$item_cache_quantity = $item_cache['qty'];
		// Tính toán giá trị hiện tại
		$item_cache_prices = $item_cache['qty'] * $item_price;

		// số lương trừ đi số cũ
		$this->totalQty -= $item_cache_quantity;
		// tổng tiền trừ đi giá cũ
		$this->totalPrice -= $item_cache_prices;

		// giá trị mới
		$item_now_prices = $quantity * $item_price;
		// tổng tiền mới
		$this->totalPrice += $item_now_prices;
		// số lương mới
		$this->totalQty += $quantity;

		$this->items[$id]['qty'] = $quantity;
	}

	// Xóa Sản Phẩm
	public function DeleteAmount($id, $item_price){
		try{
			// lấy ra sản phẩm
			$item_cache = $this->items[$id];
			// lấy ra số lượng
			$item_cache_quantity = $item_cache['qty'];
			// Tính toán giá trị hiện tại
			$item_cache_prices = $item_cache['qty'] * $item_price;

			// số lương trừ đi số cũ
			$this->totalQty -= $item_cache_quantity;
			// tổng tiền trừ đi giá cũ
			$this->totalPrice -= $item_cache_prices;

			// xóa khỏi session
			unset($this->items[$id]);
		}catch(\Exception $exception){
            Session::flash('error', 'Đã có lỗi sảy ra');
		}
	}
}
