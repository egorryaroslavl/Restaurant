<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Image extends Model
	{
		protected $table = 'images';

		protected $fillable = [
			'public_id',
			'version',
			'url',
			'parameters',
			'alt',
			'description',
			'parent_table',
			'parent_id',
		];

		protected $casts = [
			'parameters' => 'array',
		];




	}
