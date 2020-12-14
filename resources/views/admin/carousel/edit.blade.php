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
        <div class="col-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('carousel.index') }}" type="button" class="btn btn-primary">Trở về</a>
            </div>
        </div>
    </div>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="row" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="get_image" class="get_image" required="" value="3">
                    <div class="component_wrapper">
                        <div class="component_title">
                            <h6>Chọn ảnh từ máy tính hoặc thư viện ( 12 x 5 )</h6>
                                <div style="width: 100%;display: flex;justify-content: center;">
                                    <img src="{{asset($carousel->image)}}" alt="" class="image_resurt" style="width: 40%;">
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
                                    <input type="" name="gallery_image" value="<?php echo $carousel->image ?>" style="display: none;">
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
                                <input type="text" class="input_render" name="title" value="<?php echo $carousel->title ?>">
                            </div>
                        </div>
                    </div>
                    <div class="component_wrapper">
                        <div class="component_title">
                            <h6>Mô tả</h6>
                        </div>
                        <div class="component_content">
                            <div class="input_wrapper">
                                <input type="text" class="input_render" name="detail" value="<?php echo $carousel->detail ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </div>
                </form>
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