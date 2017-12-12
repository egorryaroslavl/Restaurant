@extends('layouts.index')
@section('content')
<!--MENUS AREA-->
<section class="style-two home-three menus-area section-padding">
	<div class="container wow fadeIn">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
				<div class="area-title text-center">
					<h3>Today’s menu</h3>
				</div>
			</div>
		</div>
		<div class="row">
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
		</div>
		<div class="row food-menu-list">
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu breakfast coffee snacks">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_1.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$20.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu dinner snacks">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_2.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$22.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu breakfast">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_3.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$17.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu dinner lunch breakfast snacks">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_4.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$28.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu lunch coffee">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_5.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$120.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
			<div class="mix col-md-6 col-lg-6 col-sm-12 col-xs-12 single-menu breakfast">
				<div class="single-menu-details">
					<div class="food-menu-img"><img src="/themes/semper/img/menu/menu_style_two_6.jpg" alt=""></div>
					<div class="food-menu-details">
						<h3>Cupcake Recipes <span class="menu-price">$100.00</span></h3>
						<p class="menu-speacification"><span>- Juice Fruit</span> <span>- Checken</span> <span>- Cherry</span></p>
						<p class="menu-speacification"><span>- Vegetable</span> <span>- Milk</span> <span>- Potato</span></p>
						<p class="menu-speacification"><span>- Tomato</span> <span>- Chilli</span> <span>- Sesame</span></p>
					</div>
				</div>
			</div>
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
@endsection