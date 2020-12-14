@extends('admin.layout')
@section('body')

    
    <form class="row">
        <div class="card col-12">
            <div class="card-body">
                <h4 class="card-title">Lịch sử nhập kho</h4>
                <div class="row">
                    <div class="col-12">
                        <div>
                            <table id="order-listing" class="table">
                                <thead>
                                    <tr>
                                        <th>Người nhập kho</th>
                                        <th>Sản phẩm</th>
                                        <th>Màu</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Thời gian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($history_warehouse as $key => $value): ?>
                                        <tr>
                                            <td><?php echo $value->admin->name ?></td>
                                            <td><?php echo $value->name ?></td>
                                            <td style="background-color: <?php echo $value->color ?>"></td>
                                            <td><?php echo $value->size ?></td>
                                            <td><?php echo $value->quantity ?></td>
                                            <td><?php echo $value->created_at ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection()