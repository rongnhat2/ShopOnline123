
		<!-- FEATURED PRODUCT AREA START -->
		<div class="featured-area section-padding">
			<div class="container">
				<div class="section-titel">
					<h3>Sản phẩm mới</h3>
					<!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor psum dolor sit ame</p> -->
				</div>

				<div class="shop-area section-padding" style="padding: 0px;">
					<div class="container">
						<div class="row custom-row">
							<div class="col-md-12 col-left-right">
								<div class="shop-right-area">
									<div class="shop-tab-area">
										<!--NAV PILL-->
										<div class="tab-content">
											<div class="row tab-pane custom-row active" id="grid">
												<?php foreach ($items as $key => $value): ?>
													<!-- Single Product -->
													<div class="col-md-3 col-left-right">
														<div class="single-product">
															<input type="hidden" class="id_item" name="id" value="<?php echo $value->id ?>">
															<div class="product-titel">
																<h4><a href="{{ route('customer.product_detail', ['slug' => $value->slug]) }}"><?php echo $value->name ?></a></h4>
																<div class="rating-box">
																	<span><?php echo $value->view ?> lượt xem</span>
																</div>
															</div>
															<div class="box-content">
																<div class="product-img">
																	<a href="{{ route('customer.product_detail', ['slug' => $value->slug]) }}"><img src="{{ asset($value->image) }}" alt="None Image" /></a>
																</div>
															<div class="overlay-content">
																<p><?php echo $value->description ?></p>
																<ul>
																	<li>
																		<a title="Quick View" href="#" data-toggle="modal" data-target="#productModal" class="view_item">
																			<i class="flaticon-symbols"></i>
																		</a>
																	</li>
																</ul>
															</div>
															</div>
															<div class="price-box">
																<?php if ($value->discount == 0): ?>
																	<span class="price"><?php echo number_format($value->price) . ' đ' ?></span>
																<?php else: ?>
																	<span class="old-price"><?php echo number_format($value->price) . ' đ' ?></span>
																	<span class="price"><?php echo number_format($value->price - $value->price*$value->discount/100) . ' đ' ?></span>
																<?php endif ?>
															</div>
														</div>
													</div>
													<!-- Single Product -->
												<?php endforeach ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- FEATURED PRODUCT AREA END -->