<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateContactsTable extends Migration
	{

		public function up()
		{
			Schema::create( 'contacts', function ( Blueprint $table ){
				$table->increments( 'id' );
				$table->string( 'name' );
				$table->string( 'short_name' )->nullable();
				$table->string( 'address' )->nullable();
				$table->string( 'legal_address' )->nullable();
				$table->string( 'phones' )->nullable();
				$table->string( 'email' )->nullable();
				$table->string( 'map' )->nullable();
				$table->string( 'icon' )->nullable();
				$table->string( 'schedule' )->nullable();
				$table->text( 'block1' )->nullable();
				$table->text( 'block2' )->nullable();
				$table->text( 'block3' )->nullable();
				$table->string( 'h1' )->nullable();
				$table->string( 'metatag_title' )->nullable();
				$table->string( 'metatag_description' )->nullable();
				$table->string( 'metatag_keywords' )->nullable();
				$table->timestamps();
			} );
		}


		public function down()
		{
			//
		}
	}
