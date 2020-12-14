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
							<div class="main_wrapper">
								<div class="main_title">
									<h3>Lịch sử đơn hàng</h3>
								</div>
								<div class="main_content">
									<table class="table">
									    <thead>
									      	<tr>
										        <th>Mã đơn hàng</th>
										        <th>Thành tiền</th>
										        <th>Trạng thái</th>
										        <th>Chi tiết đơn hàng</th>
									      	</tr>
									    </thead>
									    <tbody>
									    	<?php foreach ($data as $key => $value): ?>
										      	<tr>
											        <td><?php echo $value->order->code ?></td>
											        <td><?php echo number_format($value->order->prices) . ' đ' ?></td>
											        <td>
											        	<?php if ($value->order->status == -1): ?>
											        		<span class="btn btn-danger">Đã hủy</span>
											        	<?php elseif ($value->order->status == 0): ?>
											        		<span class="btn btn-warning">Đang chờ</span>
											        	<?php elseif ($value->order->status == 1): ?>
											        		<span class="btn btn-primary">Đang vận chuyển</span>
											        	<?php elseif ($value->order->status == 2): ?>
											        		<span class="btn btn-success">Thành công</span>
											        	<?php endif ?>
											        </td>
											        <td><a href="{{ route('customer.historyDetail', ['id' => $value->id]) }}">Chi tiết</a></td>
										      	</tr>
									    	<?php endforeach ?>
									    </tbody>
									</table>
							    	{!! $data->links() !!}
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