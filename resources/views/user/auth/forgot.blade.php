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
                    <input type="text" name="email" placeholder="Email">
                    <button type="submit">Quên mật khẩu</button>
                </form>
            </div>
        </div>
@endsection()