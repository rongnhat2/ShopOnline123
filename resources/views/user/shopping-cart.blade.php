@extends('user.component.layout')
@section('body')

	<!--[if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<header>
	 	@include('user.component.header_area')
	 	@include('user.component.header_menu')
	</header>

		<!-- WISHLIST AREA START -->
		<div class="wishlist-area shopping-cart">
			<div class="container">
	 			@include('user.component.notification')
				<div class="row">
					<!-- PAGINATION AREA START -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="pagination-single one">
							<span>1</span>
							<h1>Giỏ hàng</h1>
						</div>
						<div class="pagination-single two">
							<span>2</span>
							<h1>Đặt hàng</h1>
						</div>
						<div class="pagination-single three">
							<span>3</span>
							<h1>Hoàn tất</h1>
						</div>
					</div>
					<!-- PAGINATION AREA END -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="wishlist-content-area table-responsive">
							<?php if ($items == null): ?>
								<?php echo "Hiện chưa có sản phẩm trong giỏ hàng" ?>
							<?php endif ?>
							<table>
								<thead>
									<tr>
										<!-- <th class="product-remove"></th> -->
										<th class="product-name">Sản phẩm</th>
										<th class="product-price">Đơn giá</th>
										<th class="product-quantity">Số lượng</th>
										<th class="product-price-cart">Tổng</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($items as $key => $value): ?>
										<tr>
    										<form class="row" method="post" action="{{ route('customer.update_cart', ['id' => $keys[$key], 'item_id' => $value->id]) }}" enctype="multipart/form-data" id="cart-form-<?php echo $keys[$key] ?>">
												@csrf	
												<td class="product-image">
													<div class="full-area">
														<a href="#"><img src="<?php echo $value->image ?>" alt="#" style="width: 80px"></a>
														<div class="pro-details">
															<h2><a href="{{ route('customer.product_detail', ['slug' => $value->slug]) }}"><?php echo $value->name ?></a></h2>
															<p><?php echo $value->detail ?> </p>
															<span>Size : <?php echo $sizes[$key] ?></span>
															<p>Màu : <span style="display:inline-block; width: 10px;height: 10px;background-color: <?php echo $colors[$key] ?>"></span></p>
														</div>
													</div>
												</td>
												<td class="price">
													<span> 
														<?php if ($value->discount == 0): ?>
															<?php echo number_format($value->price) . ' đ' ?>
														<?php else: ?>
														<?php echo number_format($value->price - $value->price*$value->discount/100) . ' đ' ?>
														<?php endif ?>
													 </span>
												</td>
												<td class="quantity">
													<input type="number" name="quantity" value="<?php echo $quantity[$key] ?>" min="0">
												</td>
												<td class="total">
													<span><?php echo number_format(($value->price - $value->price*$value->discount/100) * $quantity[$key]). ' đ' ?></span>
													<a href="#" onclick="event.preventDefault(); document.getElementById('cart-form-<?php echo $keys[$key] ?>').submit();"><i class="flaticon-refresh-button"></i></a>
													<a href="{{ route('customer.delete_cart', ['id' => $keys[$key], 'item_id' => $value->id]) }}"><i class="flaticon-rubbish-bin"></i></a>
												</td>									
											</form>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- CART TOTAL AREA -->
					<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 col-sm-offset-3 col-xs-offset-3 margin-50">
						<div class="subtotal-main-area">
							<div class="subtotal-area last">
								<h2>Tổng cộng
									<span>
										<?php if ($cart != null): ?>
											<?php if (sizeof($cart->items) != 0): ?>
												<?php echo number_format($cart->totalPrice) . ' đ'; ?>
											<?php else: ?>
												<?php echo '0'. ' đ' ?>
											<?php endif ?>
										<?php else: ?>
											<?php echo '0'. ' đ' ?>
										<?php endif ?>
									</span>
								</h2>
							</div>
						</div>
						<div class="subtotal-button">
							<a href="{{ $items == null ? '#' : '\checkout' }}">Đặt hàng</a>
						</div>
					</div>
					<!-- CART TOTAL AREA -->
				</div>
			</div>
		</div>
		<!-- WISHLIST AREA END -->

		<!-- START SINGLE PRODUCT AREA END -->
	 	<!-- Sản phẩm mới -->
 	@include('user.component.footertop')
 	@include('user.component.quickview')