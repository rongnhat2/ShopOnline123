<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Original URL: http://www.urbanui.com/serein/template/demo/vertical-default-light/pages/samples/login.html
Date Downloaded: 11/30/2018 1:56:41 PM !-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Shop - Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="{{ asset('favicon.png') }}" /> -->
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
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
                            <h4>Đăng nhập Admin</h4>
                            <form class="pt-3 admin_login" method="POST" action="{{ route('admin.postlogin') }}" id="login-form">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" required="" />
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Mật khẩu"  name="password" required="" />
                                </div>
                                <div class="mt-3">
                                    <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" onclick="event.preventDefault(); document.getElementById('login-form').submit();">Đăng Nhập</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>

<script type="text/javascript">
    
document.getElementById('login-form').onkeydown = function(e){
    if(e.keyCode == 13){
        document.getElementById('login-form').submit();
    }
};
</script>

</html>
