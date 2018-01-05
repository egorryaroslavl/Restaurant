<?php

	namespace App\Console\Commands;

	use Illuminate\Console\Command;

	class ServerRun extends Command
	{
		/**
		 * The name and signature of the console command.
		 *
		 * @var string
		 */
		protected $signature = 'sr';

		/**
		 * The console command description.
		 *
		 * @var string
		 */
		protected $description = 'Alias "php artisan serve"';

		/**
		 * Create a new command instance.
		 *
		 * @return void
		 */
		public function __construct()
		{
			parent::__construct();
		}

		/**
		 * Execute the console command.
		 *
		 * @return mixed
		 */
		public function handle()
		{

			$this->call( 'serve' );

		}
	}
