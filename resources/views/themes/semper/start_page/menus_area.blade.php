<!--MENUS AREA-->
<section class="menus-area section-padding" id="menu">
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
						<li class="filter" data-filter=".all">Все</li>
						@if(isset($data))
							@foreach($data->dishes as $item)
								<li style="margin-bottom: 5px" class="filter"
								    data-filter=".{{$item->alias}}">{{$item->name}}</li>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="row food-menu-list">
			@if(isset($data))
				@foreach($data->dishes as $item)
					<div class="mix col-md-3 col-lg-3 col-sm-6 col-xs-12 single-menu all {{$item->alias}}">
						<div class="food-menu-img">
							<a href="{!! iconThumbnail($item->icon_public_id,[800,600] )!!}" class="menu-popup" data-effect="mfp-zoom-out"><img
									src="{!! iconThumbnail($item->icon_public_id,[270,200] )!!}" alt=""></a>
						</div>
						<div class="food-menu-details">
							<h4>{{$item->name}}</h4>
							<p class="menu-price">{{$item->price or '--'}}&#8381;</p>
						</div>
					</div>
				
				@endforeach
			@endif
		</div>
	</div>
</section>
<!--MENUS AREA END-->