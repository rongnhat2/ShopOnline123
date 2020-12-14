@extends('admin.layout')
@section('body')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"> Đơn hàng</h4>
                        <p class="card-description"></p>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="exampleInputUsername1">Mã đơn hàng</label>
                                <input type="" class="form-control" disabled=""  value="<?php echo $order->code ?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tổng giá trị</label>
                                <input type="" class="form-control" disabled=""  value="<?php echo number_format($order->prices) . ' đ' ?>" />
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Shipper</label>
                                <input type="" class="form-control" disabled=""  value="<?php echo $order->user_order[0]->shipper->name ?>"/>
                            </div>
                            <a href="{{ route('order.trans_update', ['c_id' => $id, 'id' => '2']) }}" class="btn btn-success mr-2">Thành công</a>
                            <a href="{{ route('order.trans_update', ['c_id' => $id, 'id' => '-1']) }}" class="btn btn-danger mr-2">Hủy đơn</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Khách hàng</h4>
                        <p class="card-description"> </p>
                        <form class="forms-sample">
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Tên khách</label>
                                <div class="col-sm-9">
                                <input type="" class="form-control" disabled=""  value="<?php echo $order->user_order[0]->user->name ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                <input type="" class="form-control" disabled=""  value="<?php echo $order->user_order[0]->user->user_detail->address ?>" />
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                <input type="" class="form-control" disabled=""  value="<?php echo $order->user_order[0]->user->user_detail->telephone ?>" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()