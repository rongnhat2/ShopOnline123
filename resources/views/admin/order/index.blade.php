@extends('admin.layout')
@section('body')

    <div class="row grid-margin">
        @if ( Session::has('error') )
        <div class="col-12 grid-margin">
            <div class="alert alert-fill-danger" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                {{ Session::get('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>
        @endif
        @if ( Session::has('success') )
        <div class="col-12 grid-margin">
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                {{ Session::get('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        </div>
        @endif
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Đơn hàng</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tổng giá</th>
                                    <th>Hình thức</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><?php echo $value->code ?></td>
                                        <td><?php echo number_format($value->prices) . ' đ' ?></td>
                                        <td>
                                            <?php if ($value->payment == 1): ?>
                                                <span class="btn btn-primary">Thanh toán khi nhận hàng</span>
                                            <?php elseif ($value->payment == 2): ?>
                                                <span class="btn btn-success">Đã thanh toán online</span>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.detail_order', ['id' => $value->id]) }}" class="btn btn-outline-primary">Chi tiết</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()