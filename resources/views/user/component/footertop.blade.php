
		<!-- FOOTER TOP AREA START -->
		<div class="footertop-area" style="background: #e6e6e6 none repeat scroll 0 0;">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="address-area">
							<a href="index.html"><img src="{{ asset('img/home-one/logo.png') }}" alt="" /></a>
							<div class="contact-details">
								<ul>
									<li>
										<i class="flaticon-location"></i>
										<p>16 Bạch Mai - Thanh Nhàn, Hai Bà Trưng, Hà Nội</p>
									</li>
									<li>
										<i class="flaticon-phone-call"></i>
										<p>Điện thoại : 0981 948 966</p>
									</li>
									<li>
										<i class="flaticon-earth"></i>
										<p>Email: brandshop2110@gmail.com</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-4 col-xs-12">
						<div class="footer-menu">
							<h4>Phân loại</h4>
							<ul>
								<li><a href="{{ route('customer.shop_list', ['slug' => 'tat-ca-san-pham']) }}">Tất cả sản phẩm</a></li>
								<li><a href="{{ route('customer.shop_list', ['slug' => 'nam']) }}">Nam</a></li>
								<li><a href="{{ route('customer.shop_list', ['slug' => 'nu']) }}">Nữ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-md-2 hidden-sm hidden-xs">
						<div class="footer-menu">
							<h4>Danh mục</h4>
							<ul>
                            	<?php foreach ($category as $key => $value): ?>	
                                	<li><a href="{{ route('customer.shop_list', ['slug' => $value->slug]) }}"><?php echo $value->name ?></a></li>
                            	<?php endforeach ?>	
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="footer-menu">
							<h4>Liên hệ với chúng tôi</h4>
							<p></p>
							<div class="contact-from-right">
								<div class="input-text">
									<input type="text" placeholder="Email..." name="name" id="name"/>
								</div>
								<div class="input-message">
									<textarea id="message" placeholder="Tin nhắn..." name="message"></textarea>
								</div>
								<div class="input-submit">
									<input type="submit" value="Gửi" name="submitMessage" id="submitMessage"/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- FOOTER TOP AREA END -->