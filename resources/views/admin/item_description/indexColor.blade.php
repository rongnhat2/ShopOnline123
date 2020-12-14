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
    
    <form class="row" method="post" action="{{ route('item_description.storeColor') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thêm danh mục</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên danh Mục</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"  required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Màu</label>
                                    <div class="col-sm-9">
                                        <input type="color" class="form-control" name="hex"  required=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
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
                                    <th>Màu</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($colors as $key => $value): ?>
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><?php echo $value->name ?></td>
                                        <td style="background-color: <?php echo $value->hex ?>"></td>
                                        <td>
                                            <a href="{{ route('item_description.deleteColor', ['id' => $value->id]) }}" class="btn btn-outline-danger">Xóa</a>
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