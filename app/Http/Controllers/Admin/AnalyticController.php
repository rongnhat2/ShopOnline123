<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalyticController extends Controller
{
    /**
     * show analytic Index List
     * 
     *  @return \Illuminate\Contracts\Support\Renderable
     */
    public function analytic(){
    	// $carousel = $this->carousel->getCarousel();
        return view('admin.analytic');
    }
}
