<?php



	Auth::routes();

	Route::get( '/', function (){
		return view( 'themes.semper.main' );
	} )->name('main') ;



	Route::get( 'about-us', 'AboutController@index' )->name( 'about-us' );
	Route::get( 'menu', function (){
		return view( 'themes.semper.menu.index' );
	} )->name( 'menu' );
	Route::get( 'contact', function (){
		$data = \Egorryaroslavl\Contacts\Models\ContactModel::where( 'id', 1 )->first();
		return view( 'themes.semper.contact.index', [ 'data' => $data ] );
	} )->name( 'contact' );
