@extends('admin.layout')
@section('body')


    <form method="post" action="{{ route('admin.postpassword') }}" enctype="multipart/form-data">
        @csrf
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @if ( Session::has('success') )
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ( Session::has('error') )
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <h4 class="card-title">Đổi Mật Khẩu</h4>
                    <form class="form-sample">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mật Khẩu Cũ :</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="oldPass" name="current-password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mật Khẩu Mới :</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newPass" name="password" required/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nhập Lại Mật Khẩu :</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </form>

@endsection()