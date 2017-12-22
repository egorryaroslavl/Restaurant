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
			'icon',
			'hit',
			'h1',
			'metatag_title',
			'metatag_description',
			'metatag_keywords' ];

		protected $casts = [
			'icon'   => 'array',
			'public' => 'boolean',
			'anons'  => 'boolean',
			'hit'    => 'boolean',
		];

		public $thumb;


		public function icon()
		{
			$thumb = $this->hasOne( 'App\Models\Icon', 'parent_id', 'id' )->where( 'parent_table', '=', 'menus' );


			return $thumb;


		}

		public function thumbnail()
		{


			return	$this->icon();




		}
	}
