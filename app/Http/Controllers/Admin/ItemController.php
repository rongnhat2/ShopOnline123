<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ItemRepository;
use App\Models\Item;
use App\Repositories\StyleRepository;
use App\Repositories\CompositionRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorRepository;
use App\Repositories\QuantityRepository;
use App\Repositories\WarehouseRepository;
use App\Models\Style;
use App\Models\Property;
use App\Models\Category;
use App\Models\Composition;
use App\Models\Color;
use App\Models\Quantity;
use App\Models\Warehouse;
use Session;
use Hash;
use DB;

class ItemController extends Controller
{
    protected $item;
    protected $style;
    protected $property;
    protected $composition;
    protected $category;
    protected $color;
    protected $quantity;
    protected $warehouse;

    public function __construct(Item $item, Style $style, Property $property, Composition $composition, Category $category, Color $color, Quantity $quantity, Warehouse $warehouse)
    {
        $this->item         = new ItemRepository($item);
        $this->style        = new StyleRepository($style);
        $this->property     = new PropertyRepository($property);
        $this->composition  = new CompositionRepository($composition);
        $this->category     = new CategoryRepository($category);
        $this->color        = new ColorRepository($color);
        $this->quantity     = new QuantityRepository($quantity);
        $this->warehouse    = new WarehouseRepository($warehouse);
    }

    /*
	 * Danh sách sản phẩm
    */
    public function index(){
    	$items = $this->item->getAll();
        return view('admin.item.index', compact('items'));
    }

    /*
	 * Mở form Thêm sản phẩm
	 * 
    */
    public function create(){
    	$categories = $this->category->getAll();
        return view('admin.item.add', compact('categories'));
    }

    /*
	 * Thêm sản phẩm
	 * 
    */
    public function store(Request $request){
    	// Kiểm tra ảnh đã được tải lên hay chưa ?
        $valid_image = $this->item->check_valid($request);
        if ($valid_image == null) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { insert to table "images" }');
        }else{
            $this->item->createItem($valid_image, $request);
        }
        return redirect()->route('item.index');
    }

    /**
     * Mở form Sửa sản phẩm
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id){
        $item = $this->item->getModel()->find($id);
    	$categories = $this->category->getAll();
        return view('admin.item.edit', compact('item', 'categories'));
    }

    /*
	 * Cập nhật sản phẩm
	 * 
    */
    public function update(Request $request, $id){
    	// Kiểm tra ảnh đã được tải lên hay chưa ?
        $valid_image = $this->item->check_valid($request);
        if ($valid_image == null) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { insert to table "images" }');
        }else{
            $this->item->updateItem($valid_image, $request, $id);
        }
        return redirect()->route('item.index');
    }

    /*
	 * Xóa sản phẩm
	 * 
    */
    public function delete($id){
        $this->item->deleteItem($id);
        return redirect()->route('item.index');
    }


    /*
     * mở form sửa thuộc tính sản phẩm
    */
    public function createDetail($id){
        $compositions    = $this->composition->getAll();
        $styles          = $this->style->getAll();
        $properties      = $this->property->getAll();

        $getAllStyleOf          = DB::table('item_style')->where('item_id', $id)->pluck('style_id');
        $getAllPropertyOf       = DB::table('item_property')->where('item_id', $id)->pluck('property_id');
        $getAllCompositionOf    = DB::table('item_composition')->where('item_id', $id)->pluck('composition_id');

        return view('admin.item.list', compact('id', 'styles', 'properties', 'compositions', 'getAllStyleOf', 'getAllPropertyOf', 'getAllCompositionOf'));
    }
    /*
     * cập nhật thuộc tính
    */
    public function storeDetail(Request $request, $id){
        $item_detail    = $this->item->updateDetail($request, $id);
        return redirect()->route('item.detail', compact('id'));
    }

    /*
     * Mở form thêm ảnh sản phẩm
    */
    public function createImage($id){
        $images    = $this->item->getImage($id);
        return view('admin.item.image', compact('id', 'images'));
    }
    /*
     * Thêm ảnh sản phẩm
    */
    public function storeImage(Request $request, $id){
        $images    = $this->item->createImage($request, $id);
        return redirect()->back();
    }
    /*
     * Xóa ảnh sản phẩm
    */
    public function deleteImage($id, $c_id){
        $images    = $this->item->deleteImage($id, $c_id);
        return redirect()->back();
    }

    /*
     * Mở form thêm màu sản phẩm
    */
    public function createCopy($id){
        $colors    = $this->color->getColor($id);
        return view('admin.item.color', compact('id', 'colors'));
    }
    /*
     * Thêm màu sản phẩm
    */
    public function storeCopy(Request $request, $id){
        $colors         = $this->color->createColor($request, $id);
        $quantityModule = $this->quantity->createModuleQuantity($colors->id);
        return redirect()->back();
    }
    /*
     * Xóa màu sản phẩm
    */
    public function deleteCopy($id, $c_id){
        $color          = $this->color->deleteColor($c_id);
        // $quantity       = $this->quantity->deleteModuleQuantity($c_id);
        return redirect()->back();
    }

    /*
     * Mở form thêm số lượng sản phẩm
    */
    public function createQuantity($id, $c_id){
        $item_quantity    = $this->quantity->getQuantity($c_id);
        return view('admin.item.copy', compact('id', 'c_id', 'item_quantity'));
    }
    /*
     * Cập nhật số lượng sản phẩm
    */
    public function storeQuantity(Request $request, $id, $c_id){
        // Tạo lịch sử nhập kho
        $history_warehouse    = $this->warehouse->createQuantity(Session::get('customer')->customer['id'], $request, $id, $c_id);
        // Cập nhật số lượng sản phẩm
        $item_quantity    = $this->quantity->updateQuantity($request, $id, $c_id);
        return redirect()->back();
    }

    /*
     * lịch sử nhập kho
    */
    public function warehouse(){
        // Lấy nhập kho
        $history_warehouse    = $this->warehouse->getWarehouse();
        return view('admin.item.warehouse', compact('history_warehouse'));
    }


}
