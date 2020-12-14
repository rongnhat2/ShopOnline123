@extends('user.component.layout')
@section('body')

	<!--[if lt IE 8]>
	    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<header>
	 	@include('user.component.header_area')
	 	@include('user.component.header_menu')
	</header>

		<!-- START SINGLE PRODUCT AREA START -->
		<div class="single-product-area">
			<div class="container">
	 			@include('user.component.notification')
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<!--zoom-section start-->
						<div class="zoom-section">    	  
							<div class="zoom-small-image">
								<div class="cloud-zoom-wrap">
									<a href="{{ asset($item->image) }}" class="cloud-zoom" id="zoom1" rel="adjustX:10, adjustY:-4"> 
										<img src="{{ asset($item->image) }}" alt="" title="Optional title display"> 
									</a>
									<div class="mousetrap"></div>
								</div>
							</div>
							<div class="zoom-desc">       
								<div class="thubm-pro owl-carousel owl-theme">
									<div class="owl-item">
										<a href="{{ asset($item->image) }}" class="cloud-zoom-gallery" title="Red" rel="useZoom:'zoom1',smallImage:'{{ asset($item->image) }}'">
											<img class="zoom-tiny-image" src="{{ asset($item->image) }}" alt="Thumbnail 1">
										</a>
									</div>
									<?php foreach ($item->images as $k => $v): ?>
										<div class="owl-item">
											<a href="{{ asset($v->url) }}" class="cloud-zoom-gallery" title="Red" rel="useZoom:'zoom1',smallImage:'{{ asset($v->url) }}'">
												<img class="zoom-tiny-image" src="{{ asset($v->url) }}" alt="Thumbnail 1">
											</a>
										</div>
									<?php endforeach ?>
								</div>
							</div>
						</div>
						<!--zoom-section end-->
					</div>
					<div class="col-md-8 col-sm-8 col-xs-12">
						<div class="single-product-description">
							<div class="pro-desc">
								<div class="pro-desc-left">
									<h2><a href="#"><?php echo $item->name ?></a></h2>
									<div class="rating-box">
									</div>
									<div class="pro-availability">
										<p class="availability">Trạng thái :
											<span> 
											<?php if ($has_buy) {
												echo "Còn hàng";
											}else{
												echo "Hiện chưa bán";
											} ?>
											
											</span></p>
										<p class="availability">Lượt xem :<span> <?php echo $item->view ?></span></p>
									</div>
								</div>
								<div class="pro-desc-right">
									<h4 class="list-pro-price">
										<?php if ($item->discount == 0): ?>
											<span class="old"><?php echo number_format($item->price) . ' đ' ?></span>
										<?php else: ?>
										<span class="new"><?php echo number_format($item->price) . ' đ' ?></span>
										<span class="old"><?php echo number_format($item->price - $item->price*$item->discount/100) . ' đ' ?></span>
										<?php endif ?>
									</h4>
								</div>
							</div>
							<div class="short-description-block">
							</div>
							<form method="post" action="{{ route('customer.add_to_cart') }}" id="form_buy" enctype="multipart/form-data">
								@csrf
								<input type="hidden" name="id" value="<?php echo $item->id ?>" class="item_id">
								<div class="product-attributes clearfix">
									<div id="attributes">
										<fieldset class="attribute-fieldset select_data color">
											<label class="attribute-label">Màu sắc :   </label>
											<div class="attribute-list">
											  	<input type="text" value="" name="color_data" class="color_data" required="">
											  	<input type="text" value="" name="color_id" class="color_id" required="">
												<?php foreach ($item->color as $key => $value): ?>
													<label class="select_wrapper color_select" 
														data-value="<?php echo $value->hex ?>" 
														data-id="<?php echo $value->id ?>" 
														style="background-color: <?php echo $value->hex ?>">
													</label>
												<?php endforeach ?>
											</div>
										</fieldset>
										<fieldset class="attribute-fieldset select_data size">
											<label class="attribute-label">Kích thước :   </label>
											<div class="attribute-list">
											  	<input type="text" value="" name="size_data" class="size_data" required="">
												<?php foreach ($item->color as $key => $value): ?>
													<div class="size_wrapper color_<?php echo $value->id ?>">
														<?php foreach ($size_data as $key1 => $value1): ?>
															<label class="select_wrapper size_select {{ $value->quantitys[$key1]->quantity == 0 ? 'cant_buy' : 'has_buy' }}" 	 size-value="<?php echo $value1 ?>" 
																quantity-value="<?php echo $value->quantitys[$key1]->quantity ?>">
																<div class="value_data">
																	<?php echo $value1?>
																</div>
															</label>
														<?php endforeach ?>
													</div>
												<?php endforeach ?>
											</div>
										</fieldset>
										<span class="quantity_value"></span>
										<fieldset class="attribute-fieldset quantity_value_submit">
											<label class="attribute-label">Nhập số lượng :  </label>
											<div class="attribute-list">
												<input type="number" class="item_order" name="quantity" id="" pattern="[0-9]*" required="" value="1" min="1" max="42">
											</div>
										</fieldset>
									</div>
								</div>
								<div class="shop-icon-action">
									<button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
								</div>
							</form>
						</div>
					</div>
					<!-- SINGLE-PRODUCT INFO TAB START -->
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="product-more-info-tab">
							<!-- Nav tabs -->
							<ul class="nav nav-tabs more-info-tab">
								<li class=""><a href="#moreinfo" data-toggle="tab" aria-expanded="false">Mô tả chi tiết</a></li>
								<!-- <li class=""><a href="#review" data-toggle="tab" aria-expanded="false">REVIEWS</a></li> -->
								<li class="active"><a href="#datasheet" data-toggle="tab" aria-expanded="true">Các thuộc tính</a></li>
							</ul>
							  <!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane" id="moreinfo">
									<div class="tab-description">
										<?php echo $item->detail ?>
									</div>
								</div>
								<!-- <div class="tab-pane" id="review">
									<div class="row tab-review-row">
										<div class="col-xs-5 col-sm-4 col-md-4 col-lg-3 padding-5">
											<div class="tab-rating-box">
												<span>Grade</span>
												<div class="rating-box">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-half-empty"></i>
												</div>	
												<div class="review-author-info">
													<strong>write A REVIEW</strong>
													<span>06/22/2015</span>
												</div>															
											</div>
										</div>
										<div class="col-xs-7 col-sm-8 col-md-8 col-lg-9 padding-5">
											<div class="write-your-review">
												<p><strong>write A REVIEW</strong></p>
												<p>write A REVIEW</p>
												<span class="usefull-comment">Was this comment useful to you? <span>Yes</span><span>No</span></span>
												<a href="#">Report abuse </a>
											</div>
										</div>
										<a href="#" class="write-review-btn">Write your review!</a>
									</div>
								</div> -->
								<div class="tab-pane active" id="datasheet">
									<div class="deta-sheet">
										<table class="table-data-sheet">			
											<tbody>
												<tr class="odd">
													<td>Chất liệu</td>
													<td>
														<?php foreach ($item->composition as $k => $v): ?>
															<?php echo $v->name . ', ' ?>
														<?php endforeach ?>
													</td>
												</tr>
												<tr class="even">
													<td class="td-bg">Phong Cách</td>
													<td class="td-bg">
														<?php foreach ($item->style as $k => $v): ?>
															<?php echo $v->name . ', ' ?>
														<?php endforeach ?>
													</td>
												</tr>
												<tr class="odd">
													<td>Thuộc tính</td>
													<td>
														<?php foreach ($item->property as $k => $v): ?>
															<?php echo $v->name . ', ' ?>
														<?php endforeach ?>
													</td>
												</tr>
											</tbody>
										</table>				
									</div>
								</div>
							</div>									
						</div>
					</div>
					<!-- SINGLE-PRODUCT INFO TAB END -->
				</div>
			</div>
		</div>
		<!-- START SINGLE PRODUCT AREA END -->
	 	<!-- Sản phẩm mới -->
	 	@include('user.component.featured')
 	@include('user.component.footertop')
 	@include('user.component.quickview')
@section('js')
    <!-- CheckValueOfColor js -->
    <script src="{{ asset('user/js/CheckValueOfColor.js') }}"></script>
@endsection()