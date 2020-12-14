@extends('admin.layout')
@section('body')

    @include('user.component.notification')
    <div class="row grid-margin">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('shipper.add') }}" type="button" class="btn btn-primary">Thêm</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách Shipper</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Shipper</th>
                                    <th>Email</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listShipper as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>
                                            <a href="{{ route('shipper.edit', ['id' => $value->id]) }}" class="btn btn-outline-success">Sửa</a>
                                            <!-- <a href="{{ route('shipper.delete', ['id' => $value->id]) }}" class="btn btn-outline-danger">Xóa</a> -->
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