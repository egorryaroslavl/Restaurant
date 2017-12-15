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


	Route::get( 'admin/menus', 'MenusController@index' )->name( 'admin-menus' );
	Route::get( 'admin/menus/create', 'MenusController@create' )->name( 'admin-menus-create' );
	Route::post( 'admin/menus/store', 'MenusController@store' )->name( 'admin-menus-store' );



	Route::post( 'iconsave', 'egorryaroslavl\admin\AdminController@iconsave' );
	Route::get( 'iconget', 'egorryaroslavl\admin\AdminController@iconget' );
	Route::any( 'icondelete', 'egorryaroslavl\admin\AdminController@icondelete' );