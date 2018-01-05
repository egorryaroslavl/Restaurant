<?php

	Auth::routes();

	Route::get( '/', function (){
		return view( 'themes.' . env( 'TEMPLATE_NAME' ) . '.main' );
	} )->name( 'main' );

	Route::get( 'about-us', 'AboutController@index' )->name( 'about-us' );
	Route::get( 'menu', function (){
		return view( 'themes.' . env( 'TEMPLATE_NAME' ) . '.menu.index' );
	} )->name( 'menu' );
	Route::get( 'contact', function (){
		$data = \Egorryaroslavl\Contacts\Models\ContactModel::where( 'id', 1 )->first();
		return view( 'themes.' . env( 'TEMPLATE_NAME' ) . '.contact.index', [ 'data' => $data ] );
	} )->name( 'contact' );


	Route::group( [ 'middleware' => 'auth' ], function (){

		/* MENUS */
		Route::get( 'admin/menus', 'MenusController@admin_index' )->name( 'admin-menus' );
		Route::get( 'admin/menus/create', 'MenusController@create' )->name( 'admin-menus-create' );
		Route::get( 'admin/menus/{id}/edit', 'MenusController@edit' )->name( 'admin-menus-edit' );
		Route::post( 'admin/menus/store', 'MenusController@store' )->name( 'admin-menus-store' );
		Route::post( 'admin/menus/update', 'MenusController@update' )->name( 'admin-menus-update' );

		Route::post( 'admin/notconsists_dishes', 'MenusController@dishesList' )->name( 'admin-notconsists-dishes' );
		Route::post( 'admin/yetconsists_dishes', 'MenusController@dishesList' )->name( 'admin-yetconsists-dishes' );
		Route::post( 'admin/dishes_control', 'MenusController@dishesControl' )->name( 'admin-dishes-control' );

		/* DISHES */
		Route::get( 'admin/dishes', 'DishesController@index' )->name( 'admin-dishes' );
		Route::get( 'admin/dishes/create', 'DishesController@create' )->name( 'admin-dishes-create' );
		Route::post( 'admin/dishes/store', 'DishesController@store' )->name( 'admin-dishes-store' );
		Route::post( 'admin/dishes/update', 'DishesController@update' )->name( 'admin-dishes-update' );
		Route::get( 'admin/dishes/{id}/edit', 'DishesController@edit' )->name( 'admin-dishes-edit' );
		Route::post( 'admin/dishes_reorder', 'DishesController@dishes_reorder' )->name( 'admin-dishes_reorder' );


		/* TEAMS */
		Route::get( 'admin/teams', 'TeamsController@admin_index' )->name( 'admin-teams' );
		Route::get( 'admin/teams/create', 'TeamsController@create' )->name( 'admin-teams-create' );
		Route::get( 'admin/teams/{id}/edit', 'TeamsController@edit' )->name( 'admin-teams-edit' );
		Route::post( 'admin/teams/store', 'TeamsController@store' )->name( 'admin-teams-store' );
		Route::post( 'admin/teams/update', 'TeamsController@update' )->name( 'admin-teams-update' );
		Route::post( 'admin/teams_reorder', 'TeamsController@teams_reorder' )->name( 'admin-teams_reorder' );


		/* ICONS */
		Route::any( 'iconload', 'IconController@load' )->name( 'iconload' );
		Route::any( 'iconsave', 'IconController@save' )->name( 'iconsave' );
		Route::get( 'iconget', 'MenusController@iconget' )->name( 'iconget' );
		Route::any( 'icondelete', 'IconController@delete' )->name( 'icondelete' );


		Route::post( 'admin/related', 'AdminController@related' );


		Route::post( 'reorder', 'AdminController@reorder' );

	} );

	Route::get( 'menu', 'MenusController@index' )->name( 'menuindex' );
	Route::get( 'menu/{alias}', 'MenusController@detail' )->name( 'menusdetail' );

