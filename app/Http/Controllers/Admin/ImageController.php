<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ImageRepository;
use App\Models\Image;
use Session;
use Hash;
use DB;

class ImageController extends Controller
{
    private $image;
    public function __construct(Image $image)
    {
        $this->image = new ImageRepository($image);
    }
    
    /**
     * Show the Gallery Index.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $images = $this->image->getGallery();
        return view('admin.gallery.index', compact('images'));
    }

    /**
     * show form Import Image to Gallery
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(){
        return view('admin.gallery.add');
    }

    /**
     * Import Image to Gallery
     *
     * @return Gallery Index
     */
    public function store(Request $request){
        $this->image->createGallery( $request);
        return redirect()->route('gallery.index');
    }

    /**
     * Show the Image Cropper.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cropper(){
        return view('admin.gallery.cropper');
    }

    /**
     * AJAX function get Image
     *
     * @return Image
     */
    public function getLibrary()
    {
        // $gallery = DB::table('images')->orderBy('images.created_at', 'desc')->get();
        $gallery = $this->image->getGallery();
        // dd($gallery);
        return $gallery;
    }
}
