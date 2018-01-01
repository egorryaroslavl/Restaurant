<!--START TOP AREA-->
<header class="top-area @if(!is_null(\Route::currentRouteName())){{\Route::currentRouteName()}}-page @endif" id="home">
	<div class="page-barner-bg"></div>
	@include('themes.'.env('TEMPLATE_NAME').'.header.header_top_area')
	@if(\Route::currentRouteName()==='main')
		@include('themes.'.env('TEMPLATE_NAME').'.header.slider_area')
	@else
		@yield('page_head')
	@endif
<!--PAGE BARNER AREA-->
	<div class="page-barner-area">
		<div class="container wow fadeIn">
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="barner-text">
						<h1><span>Наши</span> Меню</h1>
						<ul class="page-location">
							<li><a href="/">Главная</a></li>
							<li><i class="fa fa-angle-right"></i></li>
							<li class="active"><a href="/menu">Наши меню</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--PAGE BARNER AREA END-->
</header>
<!--END TOP AREA-->