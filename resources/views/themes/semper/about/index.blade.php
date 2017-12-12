@extends('layouts.themes.semper.index')
@section('content')
<!--ABOUT AREA-->
<section class="about-area section-padding">
	<div class="container wow fadeIn">
		<div class="row">
			<div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
				<div class="area-title">
					<h2>О <span>нас</span></h2>
				</div>
				<div class="about-content">
					{!! $data->description !!}
					<a href="about-us-2.html#" class="read-more">Read more</a>
				</div>
			</div>
			<div class="col-md-4 col-lg-4 col-md-offset-1 col-lg-offset-1 col-sm-12 col-xs-12 hidden-xs">
				<div class="about-video">
					<img src="/themes/semper/img/about/about_circle.png" alt="">
					<a href="https://www.youtube.com/watch?v=H6Yjc37axBY" class="about-video-button" data-effect="mfp-zoom-in"><i class="fa fa-play"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!--ABOUT AREA END-->
@endsection
