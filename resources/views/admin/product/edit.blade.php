@extends('admin.layout')
@section('body')


    <form class="row" method="post" action="{{ route('product.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sửa sản phẩm</h4>
                    <input type="hidden" name="id" value="<?php echo $products->id ?>">
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Tên Danh Mục</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name"  required="" value="<?php echo $products->name ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Giá gốc</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price" pattern="[0-9]*" value="<?php echo $products->price ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Giảm bán ra</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="discount"  required="" pattern="[0-9]*" value="<?php echo $products->discount ?>"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mô tả ngắn</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="detail"  required=""><?php echo $products->detail ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleInputName1">Chọn ảnh</label>
                                    <div class="input_form image_loader">
                                        <label class="W100" data-toggle="modal" data-target="#myModal">
                                            <i class="fas fa-upload"></i>
                                        </label>
                                        <div class="image_loading">
                                            <img src="{{ asset($products->image_url) }}" >
                                        </div>
                                        <input type="text" name="image_id" value="<?php echo $products->image_id ?>" style="display: none;" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                        <button class="btn btn-light">Hủy</button>
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