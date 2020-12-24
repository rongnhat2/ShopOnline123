@extends('user.component.layout')
@section('body')

	<!--[if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<header>
	 	@include('user.component.header_area')
	 	@include('user.component.header_menu')
	</header>

		
		<!-- CHECK OUT AREA START -->
		<div class="checkout-area section-padding">
			<div class="container">
				<div class="row">
					<!-- PAGINATION AREA START -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="pagination-single one">
							<span>1</span>
							<h1>Giỏ hàng</h1>
						</div>
						<div class="pagination-single two active">
							<span>2</span>
							<h1>Đặt hàng</h1>
						</div>
						<div class="pagination-single three">
							<span>3</span>
							<h1>Hoàn tất</h1>
						</div>
					</div>
					<!-- PAGINATION AREA END -->
					<!-- CHECKOUT CONTENT AREA START -->
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="checkout-left-area">
							<h5>Thông tin khách hàng</h5>
                    		@guest
        					<div class="I-login">
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
					                    <h1 class="title_form">Bạn phải đăng nhập trước!!</h1>
					                    <input type="text" name="email" placeholder="Email">
					                    <input type="password" name="password" placeholder="Mật khẩu">
					                    <button type="submit">Đăng nhập</button>
					                    <!-- <a href="" class="forgot">Quên mật khẩu ?</a> -->
					                    <div class="register_wrapper"><span>hoặc</span><a href="{{ route('user.getregister') }}">Đăng kí</a></div>
					                </form>
					            </div>
				            </div>
                    		@else
							<div class="row">
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Họ và tên</label>
										<input type="text" placeholder="" disabled="" value="<?php echo $customer_data->name ?>" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Email</label>
										<input type="text" placeholder="" disabled=""  value="<?php echo $customer_data->email ?>" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Số điện thoại</label>
										<input type="text" placeholder="" disabled=""  value="<?php echo $customer_data->user_detail->telephone ?>" />
									</div>
								</div>
								<div class="col-md-12">
									<div class="checkout-form-list">
										<label>Địa chỉ</label>
										<input type="text" placeholder="" disabled=""  value="<?php echo $customer_data->user_detail->address ?>" />
									</div>
								</div>
							</div>
                    		@endguest
						</div>
					</div>
					<!-- CHECKOUT CONTENT AREA START -->
					<!-- CHECKOUT RIGHT AREA START -->
					<div class="col-md-6 col-sm-12 col-xs-12">
						<div class="checkout-right-area">
							<h5>Giỏ hàng</h5>
							<div class="row">
								<!-- CART TOTAL AREA -->
								<div class="col-md-12">
									<div class="subtotal-main-area">
										<div class="subtotal-area">
											<h2 class="titel">Sản phẩm<span>Giá tiền</span></h2>
										<?php foreach ($items as $key => $value): ?>
											<h2 class="up">
												<?php echo $value->name . ' (' . $sizes[$key]  . ') '.' x ' . $quantity[$key] ?>
												<span>
													<?php if ($value->discount == 0): ?>
														<?php echo number_format($value->price) . ' đ' ?>
													<?php else: ?>
													<?php echo number_format($value->price - $value->price*$value->discount/100) . ' đ' ?>
													<?php endif ?>
												</span>
											</h2>
											<!-- <h2 class="up">Dretria postma X 01<span>$145.00</span></h2> -->
											<!-- <h2 class="up">Miletria ostma X 02<span>$290.00</span></h2> -->
										<?php endforeach ?>
										</div>
										<div class="subtotal-area last">
											<h2>Tổng tiền<span><?php echo number_format($cart->totalPrice) . ' đ' ?></span></h2>
										</div>
									</div>
								</div>
								<!-- CART TOTAL AREA -->
								<!--  PAYMENT MTHHOD AREA -->
								<div class="col-md-12">
									<h5 class="pay-titel">Hình thức thanh toán</h5>
									<div class="payment-method">
										<form action="#">
											 <div class="payment-signal">
												<input type="radio" name="transfer" value="transfer" checked>
												<h3>Tiền mặt khi nhận hàng</h3>
											  </div>
											  <!-- <div class="payment-signal type">
												<input type="radio" name="payment" value="payment">
												<h3>Chuyển khoản ( Tạm thời chưa hỗ trợ ) </h3>
											  </div>  -->
										</form>
									</div>
                    				@guest
                    				@else
			                            <form id="VNPAY" action="{{ route('customer.create_pay') }}" method="POST" style="display: none;">
			                                @csrf
			                            </form>
										<div class="subtotal-button">
											<a href="{{ route('customer.submit_cart') }}">Đặt hàng</a>
											<a href="#" onclick="event.preventDefault(); document.getElementById('VNPAY').submit();" style="color: #fff;background-color: #337ab7">Thanh toán VNPAY</a>
										</div>
                    				@endguest
								</div>
								<!-- PAYMENT MTHHOD AREA -->
							</div>
						</div>
					</div>
					<!-- CHECKOUT RIGHT AREA START -->
				</div>
			</div>
		</div>
		<!-- CHECK OUT AREA END -->

		<!-- START SINGLE PRODUCT AREA END -->
	 	<!-- Sản phẩm mới -->
 	@include('user.component.footertop')
 	@include('user.component.quickview')