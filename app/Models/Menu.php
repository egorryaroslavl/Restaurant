<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

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
	}
