<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shop - Admin</title>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('vendors/iconfonts/mdi/font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
      <!-- plugin css for this page -->
      <link rel="stylesheet" href="{{ asset('vendors/iconfonts/ti-icons/css/themify-icons.css') }}" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('vendors/summernote/dist/summernote-bs4.css') }}">
    <!-- endinject -->
    <!-- <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" /> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <!-- custom Css -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- plugin css for this page -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="{{ asset('user/css/vendon/cropper.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/vendon/main.css') }}">
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href=""><img src="{{ asset('img/home-one/logo.png') }}" alt="Logo Shop" /></a>
                <a class="navbar-brand brand-logo-mini" href=""><img src="{{ asset('img/home-one/logo.png') }}" alt="LS" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            @if ( Session::has('shipper') )
                                {{ Session::get('shipper')->customer['username'] }}
                            @endif
                            <!-- <img src="../../images/faces/face5.jpg" alt="profile" /> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="">
                                <i class="mdi mdi-settings text-primary"></i>
                                Đổi mật khẩu
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('admin_ship.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="mdi mdi-logout text-primary"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin_ship.order_index') }}">
                            <i class="mdi mdi-cart menu-icon"></i>
                            <span class="menu-title">Đơn hàng</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Danh Mục</h4>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="order-listing" class="table">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Mã đơn hàng</th>
                                                    <th>Tổng giá</th>
                                                    <th>Tên khách</th>
                                                    <th>Địa chỉ</th>
                                                    <th>Số điện thoại</th>
                                                    <th>Hình thức thanh toán</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($order as $key => $value): ?>
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td><?php echo $value->code ?></td>
                                                        <td><?php echo number_format($value->prices) . ' đ' ?></td>
                                                        <td><?php echo $value->user_order[0]->user->name ?></td>
                                                        <td><?php echo $value->user_order[0]->user->user_detail->address ?></td>
                                                        <td><?php echo $value->user_order[0]->user->user_detail->telephone ?></td>
                                                        <td>
                                                            <?php if ($value->payment == 1): ?>
                                                                <span class="btn btn-primary">Thanh toán khi nhận hàng</span>
                                                            <?php elseif ($value->payment == 2): ?>
                                                                <span class="btn btn-success">Đã thanh toán online</span>
                                                            <?php endif ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href=" " ></a>. All rights reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">From Pham Thanh Hoai With Luv <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script src="{{ asset('js/avgrund.js') }}"></script>
    <!-- End custom js for this page-->
    <script src="{{ asset('js/formpickers.js') }}"></script>
    <script src="{{ asset('js/form-addons.js') }}"></script>
    <script src="{{ asset('js/x-editable.js') }}"></script>
    <script src="{{ asset('js/dropify.js') }}"></script>
    <script src="{{ asset('js/dropzone.js') }}"></script>
    <script src="{{ asset('js/jquery-file-upload.js') }}"></script>
    <script src="{{ asset('js/formpickers.js') }}"></script>
    <script src="{{ asset('js/form-repeater.js') }}"></script>
    <!-- End custom js for this page-->
    <!-- Custom js for this page-->
    <script src="{{ asset('js/data-table.js') }}"></script>
    <!-- plugin js for this page -->
    <script src="{{ asset('vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('vendors/tinymce/themes/modern/theme.js') }}"></script>
    <script src="{{ asset('vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('js/editorDemo.js') }}"></script>

    <!-- custom javascript -->
    <script src="{{ asset('js/effect_custom.js') }}"></script>
    <script src="{{ asset('js/bootstrap3.js') }}"></script>

</body>

</html>
