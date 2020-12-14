@extends('user.component.layout')
@section('body')
        <div class="I-login">
            <div class="login_header">
                <div class="wrapper">
                    <div class="image_wrapper">
                        <a href="/"><img src="{{ asset('img/home-one/logo.png') }}"></a>
                    </div>
                </div>
            </div>
            <div class="login_content">
                <form class="login_form" method="post" action="{{ route('user.postpassword') }}" enctype="multipart/form-data">
                    @csrf
                    @if ( Session::has('error') )
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    @if ( Session::has('success') )
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1 class="title_form">Đổi mật khẩu</h1>
                    <input type="password" name="current-password" placeholder="Mật khẩu cũ" required="">
                    <input type="password" name="password" placeholder="Mật khẩu mới" required="">
                    <input type="password"  name="password_confirmation" placeholder="Nhập lại mật khẩu mới" required="">
                    <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                </form>
            </div>
        </div>
@endsection()