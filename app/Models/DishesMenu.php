<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class DishesMenu extends Model
	{
		protected $table = 'dishes_menus';
		public $timestamps = false;
		protected $fillable = [
			'menu_id',
			'dishe_id',
			'pos',
		];
	}
