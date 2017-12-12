<!doctype html>
<html lang="en-US">
@include('admin.head')
<body>
<div id="wrapper">
	@include('admin.header.menu.main_menu')
	<div id="page-wrapper" class="gray-bg">
		@include('admin.navbar_static_top')
		<div class="row wrapper border-bottom white-bg page-heading">
			<div class="col-lg-10">
				@if(isset($breadcrumbs))
					{!! $breadcrumbs !!}
				@else
					<h2>Стартовая страница</h2>
					<ol class="breadcrumb">
						<li class="active">
							<strong>Стартовая страница</strong>
						</li>
					</ol>
				@endif
			</div>
			<div class="col-lg-2">
			</div>
		</div>
		<div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
				<div class="col-lg-12">
					@yield('content' )
				</div>
			</div>
		</div>
		@include('admin.footer')
	</div>
</div>
</body>
@include('admin.scripts')
</html>
