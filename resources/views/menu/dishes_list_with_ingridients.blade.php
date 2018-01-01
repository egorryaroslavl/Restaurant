<div class="row food-menu-list">
	@php
		$Collection = collect($data->dishes);
		$dishes = $Collection->sortBy('pos');
	@endphp
	@foreach($dishes as $item)
		
		@php $cl ='';  foreach($item->menus as $it){ $cl .= $it->alias .' ';  }   @endphp
		<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu {{$cl}}">
			<div class="single-menu-details">
				<div class="food-menu-img"><img src="{!! iconThumbnail($item->icon_public_id )!!}" alt=""></div>
				<div class="food-menu-details">
					<h3>{{$item->name}} <span class="menu-price">{{priceFormat($item->price)}}</span></h3>
					@if(isset($item->ingredients))
						
						@php
							$collection = collect($item->ingredients);
							$chunks = $collection->chunk(3);
						@endphp
						@if(count( $chunks) == 0 ||count( $chunks)<2 ) <p class="menu-speacification"
						                                                  style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
							<span>&nbsp;</span></p> @endif
						@foreach( $chunks as $ingrArray)
							<p class="menu-speacification"
							   style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
								@if($loop->index<=1)
									
									@foreach($ingrArray as $ingrName)
										<span>- {{$ingrName}}</span>
									@endforeach
								
								@endif
							</p>
						@endforeach
					@endif
				
				</div>
			</div>
		</div>
	@endforeach
</div>
			


