@extends('admin.layout')
@section('body')


    <div class="row grid-margin">
        <div class="col-3 grid-margin stretch-card">
            <div class="card">
                <a href="{{ route('item.index') }}" type="button" class="btn btn-primary">Trở về</a>
            </div>
        </div>
    </div>
    <form class="row" method="post" action="" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa sản phẩm</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên sản phẩm *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"  required="" value="<?php echo $item->name ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Danh Mục</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            @foreach($categories as $category)
                                            <div class="form-check col-sm-3 ">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="category" id="optionsRadios1" value="{{ $category->id }}" {{ $category->id == $item->category_id ? 'checked' : '' }}/>
                                                   {{ $category->name }}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Giới tính *</label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="form-check col-sm-3 ">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="1" {{ $item->sex == 1 ? 'checked' : '' }}/>
                                                    Nam
                                                </label>
                                            </div>
                                            <div class="form-check col-sm-3 ">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="2" {{ $item->sex == 2 ? 'checked' : '' }}/>
                                                    Nữ
                                                </label>
                                            </div>
                                            <div class="form-check col-sm-3 ">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="sex" id="optionsRadios1" value="3" {{ $item->sex == 3 ? 'checked' : '' }}/>
                                                    Unisex
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <input type="hidden" name="get_image" class="get_image" required="" value="3">
                                    <div class="component_wrapper">
                                        <div class="component_title">
                                            <h6>Chọn ảnh từ máy tính hoặc thư viện ( 12 x 5 )</h6>
                                                <div style="width: 100%;display: flex;justify-content: center;">
                                                    <img src="{{asset($item->image)}}" alt="" class="image_resurt" style="width: 40%;">
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
                                                    <input type="" name="gallery_image" value="<?php echo $item->image ?>" style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Giá gốc * ( đ )</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price" pattern="[0-9]*" required="" value="<?php echo $item->price ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Giảm giá ( % )</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="discount" pattern="[0-9]*" required="" value="<?php echo $item->discount ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mô tả ngắn ( Giới hạn 250 kí tự )</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="description"  required="" style="height: 200px;" maxlength="250"><?php echo $item->description ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mô tả đầy đủ </label>
                                    <div class="col-sm-9">
                                        <textarea class="summernote" id="summernoteExample2" name="detail" style="min-height: 200px;"><?php echo $item->detail ?></textarea>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
                        <a href="{{ route('item.index') }}" class="btn btn-light">Hủy</a>
                    </form>
                </div>
            </div>
        </div>
    </form>

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