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
                <h4 class="card-title">Các thuộc tính</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phong cách</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        @foreach($styles as $style)
                                        <div class="form-check col-sm-3 ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="style[]" id="optionsRadios1" value="{{ $style->id }}" {{ $getAllStyleOf->contains($style->id) ? 'checked' : '' }}/>
                                               {{ $style->name }}
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
                                <label class="col-sm-3 col-form-label">Thuộc tính</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        @foreach($properties as $property)
                                        <div class="form-check col-sm-3 ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="property[]" id="optionsRadios1" value="{{ $property->id }}" {{ $getAllPropertyOf->contains($property->id) ? 'checked' : '' }}/>
                                               {{ $property->name }}
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
                                <label class="col-sm-3 col-form-label">Chất liệu</label>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        @foreach($compositions as $composition)
                                        <div class="form-check col-sm-3 ">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="composition[]" id="optionsRadios1" value="{{ $composition->id }}" {{ $getAllCompositionOf->contains($composition->id) ? 'checked' : '' }}/>
                                               {{ $composition->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Cập nhật</button>
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