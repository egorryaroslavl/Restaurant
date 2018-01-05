<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Team extends Model
	{
		protected $fillable = [
			'name',
			'alias',
			'position',
			'description',
			'short_description',
			'pos',
			'public',
			'anons',
			'icon_public_id',
			'hit',
		];

		protected $casts = [
			'public' => 'boolean',
			'anons'  => 'boolean',
			'hit'    => 'boolean',
		];

		public static function team()
		{

			return self::where('public', '=', 1)->orderBy('pos')->get();

		}

	}
