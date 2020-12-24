
		<!-- HEADAR AREA START -->
		<div class="header-area">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="header-left">
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="header-middle">
							<ul>
								<li>
									<a href="#">
										<img src="{{ asset('img/icon/phone.png') }}" alt="" />
										0981 948 966
									</a>
								</li>
								<li>
									<a href="#">
										<img src="{{ asset('img/icon/mail.png') }}" alt="" />
										phamthanhhoai96@gmail.com
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="header-right {{ Auth::check() ? 'customer' : ''}} ">
							<ul>
                        		@guest
								<li class="login">
									<a class="act" href="{{ route('user.login') }}">
										Đăng nhập
									</a>
								</li>
                        		@else
								<li>
									<a href="{{ route('customer.purchase') }}">
										{{ Session::get('customer')->customer['username'] }}
										<i class="fa fa-angle-down"></i>
									</a>
									<ul>
										<li><a href="{{ route('customer.purchase') }}">Tài khoản</a></li>
										<li><a href="{{ route('customer.history') }}">Đơn mua</a></li>
										<li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
			                            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
			                                @csrf
			                            </form>
									</ul>
								</li>
                        		@endguest
								<li><a href="{{ route('customer.shopping_cart') }}">Đặt hàng</a></li>
								<li class="search-area">
									<a><img src="{{ asset('img/icon/search.png') }}" alt="" /></a>
									<div class="header-search">
										<form method="post" action="{{ route('customer.search') }}" class="search-box">
											@csrf
											<div>
												<input type="text" placeholder="Tìm kiếm" value="" name="search_value">
											</div>
										</form>						            
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- HEADAR AREA START -->