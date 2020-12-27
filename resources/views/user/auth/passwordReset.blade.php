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
                <form class="login_form" method="post" action="" enctype="multipart/form-data">
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
                    <h1 class="title_form">Cập nhật mật khẩu mới!!!</h1>
                    <input type="hidden" name="id" value="<?php echo $user->id ?>">
                    <input type="password" name="password" placeholder="Mật khẩu mới" required="">
                    <input type="password"  name="password_confirmation" placeholder="Nhập lại mật khẩu mới" required="">
                    <button type="submit" class="btn btn-primary mr-2">Cập Nhật</button>
                </form>
            </div>
        </div>
@endsection()