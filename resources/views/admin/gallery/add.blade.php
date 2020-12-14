@extends('admin.layout')
@section('body')
    <form class="row" method="post" action="{{ route('gallery.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title d-flex">Chọn một hoặc nhiều Ảnh ( Tối đa 20 đối tượng )</h4>
                    <input type="file" class="dropify" id="LoadImage" multiple="" name="image[]" required="" />
                </div>
                <div id="lightgallery" class="row lightGallery gallery_wrapper">

                </div>
            </div>
        </div>
        <div class="offset-md-3 col-6 grid-margin stretch-card">
            <div class="card">
                <button type="submit" class="btn btn-primary">Tải Lên</button>
            </div>
        </div>
    </form>
@endsection()