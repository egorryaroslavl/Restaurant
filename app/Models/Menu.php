<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use JD\Cloudder\Facades\Cloudder;

	class Menu extends Model
	{
		protected $table = 'menus';

		protected $fillable = [
			'name',
			'alias',
			'description',
			'short_description',
			'price',
			'pos',
			'public',
			'anons',
			'icon_id',
			'icon_public_id',
			'hit',
			'h1',
			'metatag_title',
			'metatag_description',
			'metatag_keywords' ];

		protected $casts = [
			/*	'icon'   => 'array',*/
			'public' => 'boolean',
			'anons'  => 'boolean',
			'hit'    => 'boolean',
		];

		public $thumb;


		public function dishes()
		{
				return $this->belongsToMany( '\App\Models\Dishe', 'dishes_menus' )->withPivot( 'pos')->orderBy('dishes_menus.pos');
		}


		public function icon()
		{
			$thumb = $this->hasOne( 'App\Models\Icon', 'parent_id', 'id' )->where( 'parent_table', '=', 'menus' );

			return $thumb;

		}

		public static function menus()
		{

			return self::all()->where( 'public', '=', 1 );

		}


	}
