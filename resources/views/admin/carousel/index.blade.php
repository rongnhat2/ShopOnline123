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
                    <form class="row" method="post" action="{{ route('carousel.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="get_image" class="get_image" required="">
                        <div class="component_wrapper">
                            <div class="component_title">
                                <h6>Chọn ảnh từ máy tính hoặc thư viện ( 12 x 5 )</h6>
                                <div style="width: 100%;display: flex;justify-content: center;">
                                    <img src="" alt="" class="image_resurt" style="width: 40%;">
                                </div>
                            </div>
                            <div class="component_content">
                                <div class="select_image_wrapper">
                                    <div class="select_on on_pc">
                                        <label class="" for="upload_image">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                        <input type="file" name="upload_image" id="upload_image" class="image_upload" style="display: none;">
                                    </div> 
                                    <div class="select_on on_gallery get_image_gallery" data-toggle="modal" data-target="#myModal" >
                                        <label class="">
                                            <i class="fas fa-images"></i>
                                        </label>
                                        <input type="" name="gallery_image" value="" style="display: none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="component_wrapper">
                            <div class="component_title">
                                <h6>Tiêu đề</h6>
                            </div>
                            <div class="component_content">
                                <div class="input_wrapper">
                                    <input type="text" class="input_render" name="title">
                                </div>
                            </div>
                        </div>
                        <div class="component_wrapper">
                            <div class="component_title">
                                <h6>Mô tả</h6>
                            </div>
                            <div class="component_content">
                                <div class="input_wrapper">
                                    <input type="text" class="input_render" name="detail">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <button type="submit" class="btn btn-primary">Tạo mới</button>
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
                        <table id="order-listing" class="table">
                            <thead>
                                <tr>
                                    <th>Icon</th>
                                    <th>Tên</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($carousel as $key => $value): ?>
                                    <tr>
                                        <td><img src="{{asset($value->image)}}" alt="" /></td>
                                        <td><?php echo $value->title ?></td>
                                        <td>
                                            <a href="{{ route('carousel.edit', ['id' => $value->id]) }}" class="btn btn-warning">Sửa</a>
                                            <a href="{{ route('carousel.delete', ['id' => $value->id]) }}" class="btn btn-danger">Xóa</a>
                                        </td>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection()