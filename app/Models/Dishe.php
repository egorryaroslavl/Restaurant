<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Dishe extends Model
	{
		protected $table = 'dishes';

		protected $fillable = [
			'name',
			'alias',
			'description',
			'short_description',
			'ingredients',
			'price',
			'pos',
			'public',
			'icon_id',
			'icon_public_id',
			'anons',
			'hit',
			'h1',
			'metatag_title',
			'metatag_description',
			'metatag_keywords' ];

		protected $casts = [
			'ingredients' => 'array',
			'public'      => 'boolean',
			'anons'       => 'boolean',
			'hit'         => 'boolean',
		];


		public $thumb;


		public function menus()
		{
			return $this->belongsToMany( '\App\Models\Menu', 'dishes_menus' );
		}


		public function icon()
		{
			$thumb = $this->hasOne( 'App\Models\Icon', 'parent_id', 'id' )->where( 'parent_table', '=', 'dishes' );


			return $thumb;


		}

		public function thumbnail()
		{

			return $this->icon();

		}


	}
