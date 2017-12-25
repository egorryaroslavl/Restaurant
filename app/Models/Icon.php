<?php

	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;

	class Icon extends Model
	{
		protected $table = 'icons';

		protected $fillable = [
			'public_id',
			'version',
			'url',
			'thumbnail',
			'parameters',
			'alt',
			'description',
			'parent_table',
			'parent_id',
		];

		protected $casts = [
			'parameters' => 'array',
		];


		public function menu()
		{
			return $this->belongsTo( 'App\Models\Menu', 'parent_id' );
		}

		public function dishe()
		{
			return $this->belongsTo( 'App\Models\Dishe', 'parent_id' );
		}

	}
