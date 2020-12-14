<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CarouselRepository;
use App\Models\Carousel;
use Session;
use Hash;
use DB;

class CarouselController extends Controller
{
    protected $carousel;

    public function __construct(Carousel $carousel)
    {
        $this->carousel = new CarouselRepository($carousel);
    }


    /**
     * show Carousel Index List
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
    	$carousel = $this->carousel->getCarousel();
        return view('admin.carousel.index', compact('carousel'));
    }

    /**
     *  Create new Carousel
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request){
    	// Kiểm tra ảnh đã được tải lên hay chưa ?
        $valid_image = $this->carousel->check_valid($request);
        if ($valid_image == null) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { insert to table "Carousel" }');
        }else{
            $this->carousel->createCarousel($valid_image, $request);
        }
        return redirect()->back();
    }

    /**
     * show Carousel Edit Form
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id){
        $carousel = $this->carousel->getModel()->find($id);
        return view('admin.carousel.edit', compact('carousel'));
    }

    /**
     *  Create new Carousel
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, $id){
        $valid_image = $this->carousel->check_valid($request);
        if ($valid_image == null) {
            Session::flash('error', 'Có lỗi sảy ra, vui lòng thử lại -- ERROR { insert to table "images" }');
        }else{
            $this->carousel->updateCarousel($valid_image, $request, $id);
        }
        return redirect()->back();
    }


    /**
     *  Remove a Carousel
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id){
        $this->carousel->deleteCarousel($id);
        return redirect()->route('carousel.index');
    }

}
