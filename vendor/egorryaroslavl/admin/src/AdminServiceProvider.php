<?php

	namespace Egorryaroslavl\Admin;

	use Illuminate\Support\ServiceProvider;

	class AdminServiceProvider extends ServiceProvider
	{

		public function boot()
		{
			$this->loadViewsFrom( __DIR__ . '/views', 'admin' );
			$this->loadRoutesFrom( __DIR__ . '/routes.php' );
			$this->publishes( [ __DIR__ . '/views' => resource_path( 'views/admin' ) ], 'admin' );
			$this->publishes( [ __DIR__ . '/public' => public_path( '_admin' ) ], 'admin' );
			$this->publishes( [ __DIR__ . '/config/menu.php' => config_path( '/admin/menu.php' ) ], 'admin-menu' );
			$this->publishes( [ __DIR__ . '/config/settings.php' => config_path( '/admin/settings.php' ) ], 'admin-settings' );
			$this->publishes( [ __DIR__ . '/Classupload' => app_path( 'Classupload' ) ], 'classupload' );
 
		}


		public function register()
		{

			$this->app->make( 'Egorryaroslavl\Admin\AdminController' );
			$this->mergeConfigFrom( __DIR__ . '/config/menu.php', 'admin-menu' );
			$this->mergeConfigFrom( __DIR__ . '/config/settings.php', 'admin-settings' );
		}
	}
