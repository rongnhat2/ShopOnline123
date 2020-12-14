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
                            @if ( Session::has('customer') )
                                {{ Session::get('customer')->customer['username'] }}
                            @endif
                            <!-- <img src="../../images/faces/face5.jpg" alt="profile" /> -->
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="{{ route('admin.getpassword') }}">
                                <i class="mdi mdi-settings text-primary"></i>
                                Đổi mật khẩu
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
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
                        <a class="nav-link" href="{{ route('gallery.index') }}">
                            <i class="mdi mdi-image-filter menu-icon"></i>
                            <span class="menu-title">Thư Viện Ảnh</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#CATEGORY" aria-expanded="false" aria-controls="CATEGORY">
                            <i class="mdi mdi-codepen menu-icon"></i>
                            <span class="menu-title">Danh mục</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="CATEGORY">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('item_description.indexStyle') }}">Phong cách</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('item_description.indexProperty') }}">Thuộc tính</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('item_description.indexComposition') }}">Chất liệu</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('item_description.indexCategory') }}">Danh mục</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('item.index') }}">Sản phẩm</a></li>
                                <li class="nav-item create_services"><a class="nav-link" href="{{ route('item.warehouse') }}"><i class="fas fa-history"></i> Lịch sử Nhập kho</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#ORDER" aria-expanded="false" aria-controls="ORDER">
                            <i class="mdi mdi-cart menu-icon"></i>
                            <span class="menu-title">Đơn hàng</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ORDER">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('order.new_order') }}">Đơn hàng mới</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('order.trans_order') }}">Đơn hàng đang vận chuyển</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('order.history') }}">Lịch sử</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#SHIPPER" aria-expanded="false" aria-controls="SHIPPER">
                            <i class="mdi mdi-account menu-icon"></i>
                            <span class="menu-title">Shipper</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="SHIPPER">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('shipper.index') }}">Quản lí Shipper</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#LAYOUT" aria-expanded="false" aria-controls="LAYOUT">
                            <i class="mdi mdi-cellphone-screenshot menu-icon"></i>
                            <span class="menu-title">Giao diện</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="LAYOUT">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('carousel.index') }}">Carousel</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#form-elements2" aria-expanded="false" aria-controls="form-elements2">
                            <i class="mdi mdi-human menu-icon"></i>
                            <span class="menu-title">Nhân Viên</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements2">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}">Danh Sách Nhân Viên</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('role.index') }}">Chức Vụ</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer_data.index') }}">
                            <i class="mdi mdi-image-filter menu-icon"></i>
                            <span class="menu-title">Thông tin khách hàng</span>
                        </a>
                    </li> -->
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('body')
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
