@extends('user.component.layout')
@section('body')

	<!--[if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<header>
	 	@include('user.component.header_area')
	 	@include('user.component.header_menu')
	</header>

	<main>
		<div class="I-purchase">
			<div class="wrapper">
				<div class="purchase_wrapper">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
							<div class="navigation_wrapper">
								<a href="{{ route('customer.purchase') }}"><span class="icon user"><i class="fas fa-user"></i></span>Hồ sơ</a>
								<a href="{{ route('customer.history') }}"><span class="icon buying"><i class="fas fa-shopping-cart"></i></span>Đơn mua</a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9 col-xl-9">
							<form class="main_wrapper" method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
								@csrf
	 							@include('user.component.notification')
								<div class="main_title">
									<h3>Hồ sơ của tôi</h3>
									<p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
								</div>
								<div class="main_content">
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Họ và tên
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<input type="" name="" value="<?php echo $data->name ?>" disabled>
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Email
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<input type="" name="" value="<?php echo $data->email ?>" disabled>
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Số điện thoại
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<input type="" name="telephone" value="<?php echo $data->user_detail->telephone ?>">
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Ngày sinh
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<input type="date" name="birthday" value="<?php echo $data->user_detail->birthday ?>">
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Địa chỉ
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<input type="" name="address" value="<?php echo $data->user_detail->address ?>">
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
												<div class="title_data">
													Giới tính
												</div>
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
									        	<?php if ($data->user_detail->sex == 1): ?>
									        		Nam
									        	<?php elseif ($data->user_detail->sex == 2): ?>
									        		Nữ
									        	<?php elseif ($data->user_detail->sex == 3): ?>
									        		Khác
									        	<?php endif ?>
											</div>
										</div>
									</div>
									<div class="data_wrapper">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2">
											</div>
											<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4">
												<a href="{{ route('user.getpassword') }}">Đổi mật khẩu</a>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-8 col-sm-8 col-md-4 col-lg-4 col-xl-4 col-md-offset-2 col-lg-offset-2 col-xl-offset-2">
											<button class="btn btn-success">Lưu lại</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
 	@include('user.component.footertop')
 	@include('user.component.quickview')