@extends('user.component.layout')
@section('body')
	<header>
	 	@include('user.component.header_area')
	 	@include('user.component.header_menu')
	</header>
	<main>
	 	@include('user.component.slider')
	 	<br>
	 	@include('user.component.service')
	 	<!-- Sản phẩm nổi bật -->
	 	@include('user.component.arrival')
	 	<!-- Sản phẩm mới -->
	 	@include('user.component.featured')
	</main>
 	@include('user.component.footertop')
 	@include('user.component.quickview')
		
@endsection()
