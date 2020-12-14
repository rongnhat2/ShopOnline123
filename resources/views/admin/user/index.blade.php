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
    <div class="row grid-margin">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('user.add') }}" type="button" class="btn btn-primary">Thêm</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh sách nhân viên</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Nhân Viên</th>
                                    <th>Email</th>
                                    <th>Chức Vụ</th>
                                    <th>Chức Năng</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listUser as $key => $value): ?>
                                    <?php if ($key != 0): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->display_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.edit', ['id' => $value->id]) }}" class="btn btn-outline-success">Sửa</a>
                                            <a href="{{ route('admin.delete', ['id' => $value->id]) }}" class="btn btn-outline-danger">Xóa</a>
                                        </td>
                                    </tr>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()