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
                <a href="{{ route('product.create') }}" type="button" class="btn btn-primary">Thêm</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Danh Mục</h4>
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($product as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><?php echo $value->name ?></td>
                                        <td>
                                            <a href="{{ route('product.edit', ['id' => $value->id]) }}" class="btn btn-outline-success">Sửa</a>
                                            <a href="{{ route('product.delete', ['id' => $value->id]) }}" class="btn btn-outline-danger">Xóa</a>
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