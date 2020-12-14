@extends('user.component.layout')
@section('body')

<div class="I-login">
    <div class="login_header">
        <div class="wrapper">
            <a href="/" class="image_wrapper">
                <img src="{{ asset('img/home-one/logo.png') }}">
            </a>
        </div>
    </div>
    <div class="login_content">
        <form class="login_form" method="post" action="{{ route('user.register') }}" enctype="multipart/form-data">
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
            <h1 class="title_form">Đăng Kí</h1>
            <input type="text" name="email" placeholder="Email" required="">
            <input type="password" name="password" placeholder="Mật khẩu" required="">
            <input type="text" name="name" placeholder="Họ và tên" required="">
            <input type="text" name="address" placeholder="Địa chỉ">
            <input type="date" name="birthday" placeholder="Ngày sinh">
            <input type="text" name="telephone" placeholder="Số điện thoại">
            <select name="sex">
                <option value="0">Giới tính</option>
                <option value="1">Nam</option>
                <option value="2">Nữ</option>
                <option value="3">Khác</option>
            </select>
            <button type="submit">Đăng Kí</button>
            <div class="register_wrapper"><span>hoặc</span><a href="{{ route('user.login') }}">Đăng nhập</a></div>
        </form>
    </div>
</div>
@endsection()