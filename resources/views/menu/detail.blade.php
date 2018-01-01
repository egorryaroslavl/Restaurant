@extends('layouts.themes.semper.index')
@section('content')
	@if(count($data)>0)
		<!--MENUS AREA-->
		<section class="menus-area section-padding" id="menu">
			<div class="container wow fadeIn">
				<div class="row">
					<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
						<div class="area-title text-center">
							<h2>{{$data->name}}</h2>
							<h3>Сегодня в меню</h3>
						</div>
					</div>
				</div>
				{{--		<div class="row">
							<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
								<div class="food-menu-list-menu">
									<ul>
										<li class="filter active" data-filter="all">All</li>
										<li class="filter" data-filter=".breakfast">Breakfast</li>
										<li class="filter" data-filter=".lunch">Lunch</li>
										<li class="filter" data-filter=".dinner">Dinner</li>
										<li class="filter" data-filter=".coffee">Coffe</li>
										<li class="filter" data-filter=".snacks">Snacks</li>
									</ul>
								</div>
							</div>
						</div>--}}
				<div class="row food-menu-list">
					@php $Data = $data->dishes()->orderBy('pos')->get();  @endphp
					@foreach($Data as $item)
						<div class="mix col-md-3 col-lg-3 col-sm-6 col-xs-12 single-menu breakfast coffee snacks">
							<div class="food-menu-img">
								<a href="{{iconThumbnail($item->icon_public_id,[800,600])}}" class="menu-popup" data-effect="mfp-zoom-out"><img src="{{iconThumbnail($item->icon_public_id,[270,200])}}" alt=""></a>
							</div>
							<div class="food-menu-details">
								<h4 class="ellipsis" title="{{$item->name}}">{{$item->name}}</h4>
								<p class="menu-price">{{priceFormat($item->price)}}</p>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
		<!--MENUS AREA END-->
	@endif
@endsection