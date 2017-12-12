<?php

	namespace Egorryaroslavl\Contacts;

	use Illuminate\Support\ServiceProvider;


	class ContactsServiceProvider extends ServiceProvider
	{

		public function boot()
		{

			$this->loadRoutesFrom( __DIR__ . '/routes.php' );
			$this->loadViewsFrom( __DIR__ . '/views', 'contacts' );


			$this->publishes( [ __DIR__ . '/views' => resource_path( 'views/admin/contacts' ) ], 'contacts' );

			$this->publishes( [ __DIR__ . '/config/contacts.php' => config_path( 'admin/contacts.php' ) ], 'config' );

			$this->publishes( [
				__DIR__ . '/migrations/2017_05_31_150718_create_contacts_table.php' => base_path( 'database/migrations/2017_05_31_150718_create_contacts_table.php' )
			], '' );


		}


		public function register()
		{

			$this->app->make( 'Egorryaroslavl\Contacts\ContactsController' );

		}
	}
