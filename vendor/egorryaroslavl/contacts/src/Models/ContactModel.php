<?php


	namespace Egorryaroslavl\Contacts\Models;

	use Illuminate\Database\Eloquent\Model;


	class ContactModel extends Model
	{
		protected $table = 'contacts';

		protected $fillable = [
			'name',
			'short_name',
			'address',
			'legal_address',
			'phones',
			'email',
			'map',
			'schedule',
			'block1',
			'block2',
			'block3',
			'h1',
			'metatag_title',
			'metatag_description',
			'metatag_keywords',
			'icon'
		];

		protected $casts = [];



	}