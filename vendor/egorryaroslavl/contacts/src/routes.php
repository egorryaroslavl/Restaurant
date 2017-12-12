<?php



	Route::group( [ 'middleware' => 'web', 'prefix' => 'admin' ], function (){

				Route::get( '/contacts', 'egorryaroslavl\contacts\ContactsController@index' )
					->name( 'admin-contacts' );
				Route::get( '/contacts/edit', 'egorryaroslavl\contacts\ContactsController@edit' )
					->name( 'admin-contacts-edit' );
				Route::post( '/contacts/store', 'egorryaroslavl\contacts\ContactsController@store' )
				->name( 'contacts-store' );
		 		Route::post( '/icondelete', 'egorryaroslavl\admin\AdminController@icondelete' );
	} );

	Route::post( '/iconsave', 'egorryaroslavl\admin\AdminController@iconsave' );