@extends('admin.layout')
@section('body')


    @include('user.component.notification')
    <form class="row" method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa Nhân Viên</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Họ và tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"  required="" value="<?php echo $shipper->name ?>"  disabled/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="email"  required="" value="<?php echo $shipper->email ?>" disabled />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address"  required="" value="<?php echo $shipper->shipper_detail->address ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Ngày sinh</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="birthday"  required="" value="<?php echo $shipper->shipper_detail->birthday ?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="telephone"  required="" value="<?php echo $shipper->shipper_detail->telephone ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-3">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection()