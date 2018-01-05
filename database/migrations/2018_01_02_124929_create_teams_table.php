<?php

	use Illuminate\Support\Facades\Schema;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Database\Migrations\Migration;

	class CreateTeamsTable extends Migration
	{
		/**
		 * Run the migrations.
		 *
		 * @return void
		 */
		public function up()
		{
			Schema::create( 'teams', function ( Blueprint $table ){
				$table->increments( 'id' );
				$table->string( 'name' )->nullable();
				$table->string( 'alias' )->nullable();
				$table->string( 'icon_public_id' )->nullable();
				$table->text( 'description' )->nullable();
				$table->string( 'short_description',600 )->nullable();
				$table->integer( 'pos' )->default( 0 );
				$table->boolean( 'public' )->default( 1 );
				$table->boolean( 'anons' )->default( 0 );
				$table->boolean( 'hit' )->default( 0 );
				$table->timestamps();
			} );
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down()
		{
			Schema::dropIfExists( 'teams' );
		}
	}
