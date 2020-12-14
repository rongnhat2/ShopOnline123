
		<!-- MENU ARAE START -->
		<div class="menu-main-area">
			<div class="container">
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-7">
						<div class="logo-area">
							<a href="{{ route('user.index') }}"><img src="{{ asset('img/home-one/logo.png') }}" alt="" /></a>
						</div>
					</div>
					<div class="col-md-8 col-sm-12 col-xs-0">
						<div class="mainmenu">
                            <nav>
                                <ul id="nav">
                                    <li class="current"><a href="{{ route('user.index') }}">Trang chủ</a> </li>
                                    <li><a href="{{ route('customer.shop_list', ['slug' => 'nam']) }}">Nam</a></li>
                                    <li class="hot"><a href="{{ route('customer.shop_list', ['slug' => 'nu']) }}">Nữ</a></li>
                                    <li><a href="{{ route('customer.shop_list', ['slug' => 'tat-ca-san-pham']) }}">Danh mục</a>
                                    	<ul class="sub-menu">
                                        	<?php foreach ($category as $key => $value): ?>	
                                            	<li><a href="{{ route('customer.shop_list', ['slug' => $value->slug]) }}"><?php echo $value->name ?></a></li>
                                        	<?php endforeach ?>	
                                        </ul>
									</li>
                                    <li><a href="#">Liên Hệ</a></li>
                                </ul>
                            </nav>
                        </div>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-5">
						<div class="cart-area">
							<ul>
								<li class="cart-active">
									<a href="{{ route('customer.shopping_cart') }}">
										<img src="{{ asset('img/icon/cart.png') }}" alt="" />
										<p>({{ Session('cart') ? Session::get('cart')->totalQty : 0 }})</p>
										<span>({{ number_format(Session('cart') ? Session::get('cart')->totalPrice : 0) . ' đ'  }})</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- MENU ARAE END -->
		<!-- MOBILE-MENU-AREA START --> 
		<div class="mobile-menu-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
					<div class="mobile-area">
						<div class="mobile-menu">
							<nav id="mobile-nav">
								<ul>
									<li><a href="{{ route('user.index') }}">Trang chủ </a></li>
                                    <li><a href="{{ route('customer.shop_list', ['slug' => 'nam']) }}">Nam</a></li>
                                    <li class="hot"><a href="{{ route('customer.shop_list', ['slug' => 'nu']) }}">Nữ</a></li>
                                    <li><a href="{{ route('customer.shop_list', ['slug' => 'tat-ca-san-pham']) }}">Danh mục</a>
										<ul>
                                        	<?php foreach ($category as $key => $value): ?>	
                                            	<li><a href="{{ route('customer.shop_list', ['slug' => $value->slug]) }}"><?php echo $value->name ?></a></li>
                                        	<?php endforeach ?>	
										</ul>
									</li>
									<li><a href="#"> Liên hệ </a></li>
								</ul>
							</nav>
						</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- MOBILE-MENU-AREA END  -->