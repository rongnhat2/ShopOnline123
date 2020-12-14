<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ShipperRepository;
use App\Models\Shipper;
use Hash;
use DB;

class ShipperController extends Controller
{
    private $shipper;

    public function __construct(Shipper $shipper)
    {
        $this->shipper         = new ShipperRepository($shipper);
    }

    public function index()
    {
        $listShipper = $this->shipper->getAll();
        return view('admin.shipper.index', compact('listShipper'));
    }

    public function create()
    {
        return view('admin.shipper.add');
    }

    public function store(Request $request)
    {
        $createShipper = $this->shipper->createShipper($request);
        return redirect()->route('shipper.index');
    }

    /**
     * @param $id
     * show form edit
     */
    public function edit($id)
    {
        $shipper = $this->shipper->getShipper($id);
        return view('admin.shipper.edit', compact('shipper'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */

    public function update(Request $request, $id)
    {
        $shipper = $this->shipper->updateShipper($request, $id);
        return redirect()->back();
    }


    public function delete($id)
    {
        $shipper = $this->shipper->deleteShipper($id);
        return redirect()->back();
    }
}
