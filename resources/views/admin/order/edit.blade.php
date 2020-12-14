@extends('admin.layout')
@section('body')


    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Chi tiết đơn hàng</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Kích cỡ</th>
                                    <th>Màu sắc</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetail as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><?php echo $value->item->name ?></td>
                                        <td><?php echo $value->quantity ?></td>
                                        <td><?php echo $value->size ?></td>
                                        <td style="background-color: <?php echo $value->color ?>"></td>
                                        <td><?php echo number_format($value->price) . ' đ' ?></td>
                                        <td><?php echo number_format($value->quantity * $value->price) . ' đ' ?></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Phân công cho</h4>
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên shipper</label>
                                <div class="col-sm-6">
                                    <select name="shipper">
                                        <?php foreach ($listShipper as $key => $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-primary mr-3">Phân công</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection()