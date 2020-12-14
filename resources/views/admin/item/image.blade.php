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
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="row" method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputName1">Chọn Ảnh  ( 1x2 [HD] )</label>
                                <div class="input_form image_loader">
                                    <label class="W100" data-toggle="modal" data-target="#myModal">
                                        <i class="fas fa-upload"></i>
                                    </label>
                                    <div class="image_loading">
                                        <img src="" >
                                    </div>
                                    <input type="text" name="image_id" value="" style="display: none;" required="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách hình ảnh</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($images->images as $key => $value): ?>
                                    <tr>
                                        <td><img src="{{asset($value->url)}}" alt="" /></td>
                                        <td><a href="{{ route('item.imagedelete', ['id' => $id, 'c_id' => $value->id]) }}">Xóa</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    <div id="myModal" class="modal fade gallery_modal" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-body list_image_library" style="overflow: hidden;">
                    <div id="lightgallery" class="row lightGallery">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()