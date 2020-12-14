<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\StyleRepository;
use App\Repositories\CompositionRepository;
use App\Repositories\PropertyRepository;
use App\Repositories\CategoryRepository;
use App\Models\Style;
use App\Models\Property;
use App\Models\Category;
use App\Models\Composition;
use Session;
use Hash;
use DB;

class ItemdetailController extends Controller
{
    protected $style;
    protected $property;
    protected $composition;
    protected $category;

    public function __construct(Style $style, Property $property, Composition $composition, Category $category)
    {
        $this->style 		= new StyleRepository($style);
        $this->property 	= new PropertyRepository($property);
        $this->composition  = new CompositionRepository($composition);
        $this->category     = new CategoryRepository($category);
    }

    // Lấy danh sách Phong cách
    public function indexStyle(){
        $style = $this->style->getAll();
        return view('admin.item_description.indexStyle', compact('style'));
    }
    // thêm mới Phong cách
    public function storeStyle(Request $request){
        $style = $this->style->createStyle($request);
        return redirect()->back();
    }
    // xóa Phong cách
    public function deleteStyle($id){
        $style = $this->style->delete($id);
        return redirect()->back();
    }

    // Lấy danh sách Thuộc tính
    public function indexProperty(){
        $property = $this->property->getAll();
        return view('admin.item_description.indexProperty', compact('property'));
    }
    // thêm mới Thuộc tính
    public function storeProperty(Request $request){
        $property = $this->property->createProperty($request);
        return redirect()->back();
    }
    // xóa Thuộc tính
    public function deleteProperty($id){
        $property = $this->property->delete($id);
        return redirect()->back();
    }

    // Lấy danh sách Chất liệu
    public function indexComposition(){
        $composition = $this->composition->getAll();
        return view('admin.item_description.indexComposition', compact('composition'));
    }
    // thêm mới Chất liệu
    public function storeComposition(Request $request){
        $composition = $this->composition->createComposition($request);
        return redirect()->back();
    }
    // xóa Chất liệu
    public function deleteComposition($id){
        $composition = $this->composition->delete($id);
        return redirect()->back();
    }

    // Lấy danh sách Danh mục
    public function indexCategory(){
        $category = $this->category->getAll();
        return view('admin.item_description.indexCategory', compact('category'));
    }
    // thêm mới Danh mục
    public function storeCategory(Request $request){
        $category = $this->category->createCategory($request);
        return redirect()->back();
    }
    // xóa Danh mục
    public function deleteCategory($id){
        $category = $this->category->delete($id);
        return redirect()->back();
    }


}
