@extends('admin.layout')
@section('body')

    <div class="row grid-margin">
        <div class="offset-md-9 col-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('item.add') }}" type="button" class="btn btn-primary">Thêm</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Sản phẩm</h4>
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
                                <?php foreach ($items as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><?php echo $value->name ?></td>
                                        <td>
                                            <a href="{{ route('item.copy', ['id' => $value->id]) }}" class="btn btn-outline-primary">Bản sao</a>
                                            <a href="{{ route('item.detail', ['id' => $value->id]) }}" class="btn btn-outline-primary">Thuộc tính</a>
                                            <a href="{{ route('item.image', ['id' => $value->id]) }}" class="btn btn-outline-primary">Danh mục ảnh</a>
                                            <a href="{{ route('item.edit', ['id' => $value->id]) }}" class="btn btn-outline-success">Sửa</a>
                                            <a href="{{ route('item.delete', ['id' => $value->id]) }}" class="btn btn-outline-danger">Xóa</a>
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