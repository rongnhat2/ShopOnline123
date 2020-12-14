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
	 			@include('user.component.notification')
				<div class="purchase_wrapper">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 col-xl-3">
							<div class="navigation_wrapper">
								<a href="{{ route('customer.purchase') }}"><span class="icon user"><i class="fas fa-user"></i></span>Hồ sơ</a>
								<a href="{{ route('customer.history') }}"><span class="icon buying"><i class="fas fa-shopping-cart"></i></span>Đơn mua</a>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-9 col-lg-9 col-xl-9">
							<div class="main_wrapper">
								<div class="main_title">
									<h3>Chi tiết đơn hàng: <?php echo $data->order->code ?></h3>
								</div>
								<div class="main_content">
									<table class="table">
									    <thead>
									      	<tr>
										        <th>Tên sản phẩm</th>
										        <th>Size</th>
										        <th>Màu</th>
										        <th>Số lượng</th>
										        <th>Đơn giá</th>
										        <th>Tổng tiền</th>
									      	</tr>
									    </thead>
									    <tbody>
									    	<?php foreach ($data->order->order_detail as $key => $value): ?>
										      	<tr>
											        <td><?php echo $value->item->name ?></td>
											        <td><?php echo $value->size ?></td>
											        <td style="background-color: <?php echo $value->color ?>"></td>
											        <td><?php echo $value->quantity ?></td>
											        <td><?php echo number_format($value->price) . ' đ' ?></td>
											        <td><?php echo number_format($value->quantity * $value->price) . ' đ' ?></td>
										      	</tr>
									    	<?php endforeach ?>
									    </tbody>
									</table>
									<h3>Tổng giá trị: <?php echo number_format($value->order->prices) . ' đ' ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
 	@include('user.component.footertop')
 	@include('user.component.quickview')