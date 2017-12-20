<?php

	namespace App\Providers;

	use Illuminate\Support\ServiceProvider;

	class CloudinaryServiceProvider extends ServiceProvider
	{
		/**
		 * Bootstrap the application services.
		 *
		 * @return void
		 */
		public function boot()
		{
			//
		}

		/**
		 * Register the application services.
		 *
		 * @return void
		 */
		public function register()
		{
			$this->app->singleton( 'cloudinary', function ( $app ){
				return new Cloudinary( $app );
			} );

			$this->app->singleton( 'uploader', function ( $app ){
				return new Uploader( $app );
			} );

			$this->app->singleton( 'api', function (){
				return new Api;
			} );
		}
	}
