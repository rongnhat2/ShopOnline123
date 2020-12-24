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
                <form class="login_form" method="post" action="{{ route('user.postlogin') }}" enctype="multipart/form-data">
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
                    <h1 class="title_form">Đăng nhập</h1>
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <button type="submit">Đăng nhập</button>
                    <a href="{{ route('user.getpassword') }}" class="forgot">Quên mật khẩu ?</a>
                    <div class="register_wrapper"><span>hoặc</span><a href="{{ route('user.getregister') }}">Đăng kí</a></div>
                </form>
            </div>
        </div>
@endsection()