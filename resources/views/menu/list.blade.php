@extends('layouts.themes.semper.index')
@section('content')
		{{--{{dd($data)}}--}}
	
	@if(count($data)>0)
 
		
		<!--MENUS AREA-->
		<section class="style-two home-three menus-area section-padding">
			<div class="container wow fadeIn">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="area-title text-center">
							<h3>Меню</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="food-menu-list-menu">
							<ul>
								<li class="filter active" data-filter="all">Все</li>
								@foreach($data as $item)
									<li class="filter" data-filter=".{{$item->alias}}">{{$item->name}}</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
				<div class="row food-menu-list">
					@foreach($data->dishes as $item)
					<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu {{$item->alias}}">
						<div class="single-menu-details">
							<div class="food-menu-img"><img src="{!! iconThumbnail($item->icon_public_id )!!}"  alt=""></div>
							<div class="food-menu-details">
								<h3>{{$item->name}} <span class="menu-price">{{$item->price or '--'}}&#8381;</span></h3>
								<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span>
									<span>- Cherry</span></p>
								<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span>
									<span>- Potato</span></p>
								<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span>
									<span>- Sesame</span></p>
							</div>
						</div>
					</div>
					@endforeach
 
				</div>
				
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<ul class="page-pagination">
							<li><a href="menu-2.html#"><i class="fa fa-angle-left"></i></a></li>
							<li class="active"><a href="menu-2.html#">1</a></li>
							<li><a href="menu-2.html#">2</a></li>
							<li><a href="menu-2.html#">3</a></li>
							<li><a href="menu-2.html#"><i class="fa fa-angle-right"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<!--MENUS AREA END-->
	
	
	
	
	@else
		<section class="style-two home-three menus-area section-padding">
			<div class="container wow fadeIn">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="area-title text-center">
							<h3>Извините, раздел пуст...</h3>
						</div>
					</div>
				</div>
			</div>
		</section>
	
	@endif

@endsection