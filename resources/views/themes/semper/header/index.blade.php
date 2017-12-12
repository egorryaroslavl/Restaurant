<!--START TOP AREA-->
<header class="top-area @if(!is_null(\Route::currentRouteName())) {{\Route::currentRouteName()}}-page @endif" id="home">
	<div class="page-barner-bg"></div>
	@include('themes.'.env('TEMPLETE_NAME').'.header.header_top_area')
	@if(\Route::currentRouteName()==='main')
		@include('themes.'.env('TEMPLETE_NAME').'.header.slider_area')
	@else
		@yield('page_head')
	@endif
</header>
<!--END TOP AREA-->