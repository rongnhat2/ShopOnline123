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
@endsection()