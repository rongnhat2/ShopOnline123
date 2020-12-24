@extends('user.component.layout')
@section('body')

<header>
 	@include('user.component.header_area')
 	@include('user.component.header_menu')
</header>

<main>
	<!-- CONTACT ADREES AREA START -->
	<div class="contact-address-area">
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12 mb-t">
					<div class="adress-signal">
						<ul>
							<li>
								<i class="flaticon-location"></i>
								<p>16 Bạch Mai - Thanh Nhàn, Hai Bà Trưng, Hà Nội</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 col-xs-12 mb-t">
					<div class="adress-signal">
						<ul>
							<li>
								<i class="flaticon-phone-call"></i>
								<p>Telephone : 0981 948 966</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-4 hidden-sm col-xs-12">
					<div class="adress-signal">
						<ul>
							<li>
								<i class="flaticon-earth"></i>
								<p>Email: phamthanhhoai96@gmail.com</p>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- CONTACT ADREES AREA END -->
	<!-- MAP AREA START -->
	<div class="mapmain-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="map-area">
						<div id="googleMap" style="width:100%;height:395px;"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59587.977854497476!2d105.80194401556894!3d21.022736016270045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab9bd9861ca1%3A0xe7887f7b72ca17a9!2zSMOgIE7hu5lpLCBIb8OgbiBLaeG6v20sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1608806761375!5m2!1svi!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- MAP AREA START -->
</main>
@include('user.component.footertop')
@include('user.component.quickview')
@endsection()