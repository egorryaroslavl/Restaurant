<?php


	Route::group( [ 'middleware' => 'web' ], function (){

		Route::get( '/admin', 'egorryaroslavl\admin\AdminController@index'  );

	} );




 
