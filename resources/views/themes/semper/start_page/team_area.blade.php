@php $data = \App\Models\Team::team();  @endphp
@if(count($data)>0)
<!--TEAM AREA-->
<section class="team-area section-padding">
	<div class="container wow fadeIn">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<div class="area-title text-center">
					<h2>Delicius</h2>
					<h3>Awesome chefs</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 team-slider">
			@foreach($data as $item )
					<div class="single-team-member text-center">
						<div class="team-member-img ">
							<img src="{{iconThumbnail($item->icon_public_id,[210,250])}}" alt="">
						 
						</div>
						<div class="member-details">
							<h3>{{$item->name}}</h3>
							<h5>{{$item->position}}</h5>
							<p>{!! $item->description  !!}</p>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
<!--TEAM AREA END-->
@endif