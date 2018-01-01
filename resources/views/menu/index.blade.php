@extends('layouts.themes.semper.index')
@section('content')
	<!--MENUS AREA-->
	<section class="style-two menus-area section-padding">
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
							@if(isset($data))
								@foreach($data  as $item)
									<li style="margin-bottom: 5px" class="filter"
									    data-filter=".{{$item->alias}}">{{$item->name}}</li>
								@endforeach
							@endif
						</ul>
					</div>
				</div>
			</div>
			
 @include('menu.dishes_list_with_ingridients')
		</div>
	</section>
	<!--MENUS AREA END-->
@endsection