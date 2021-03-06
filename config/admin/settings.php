<?php

	return [
		'company_name'           => 'Ресторан "Буян"',
		'company_site'           => '#',
		'image_max_width'        => 1000,
		'image_max_height'       => 800,
		'avatar_max_width'       => 1000,
		'avatar_max_height'      => 800,
		'icon_width'             => 370,
		'icon_height'            => 220,
		'per_page'               => 20,
		'text_short_description' => 600,
		'first_item'             => ' Выбрать ',
		'no-image'               => 'no-image', // для Cloudinary
		'thumb_params'           => [
			"width"  => 300,
			"height" => 220,
			/*			"gravity" => "face",*/
			"crop"   => "thumb",
		],
		'icons_params'           => [
			'width'         => 1000,
			'height'        => 1000,
			'crop'          => 'fit',
			'format'        => 'png',
			'default_image' => 'no-image',
			'resource_type' => 'image',
			'invalidate'    => true,
		],
		'thumbnail_prefix'       => [
			'small'  => 'thumb_small_',
			'middle' => 'thumb_middle_',
			'large'  => 'thumb_large_',

		],
		'text_limit'             => [
			'short_description' => 300,
		],
		'thumbnail_s'            => [ 'w' => 80, 'h' => 50 ],
		'thumbnail_m'            => [ 'w' => 220, 'h' => 140 ],
		'thumbnail_l'            => [ 'w' => 370, 'h' => 230 ],
		'avatar_thumbnail_s'     => [ 'w' => 50, 'h' => 50 ],
		'avatar_thumbnail_l'     => [ 'w' => 200, 'h' => 200 ],
		'avatar_path_to_save'    => public_path() . '/icons/',
		'image_path_to_save'     => public_path() . '/uploads/images/',
		'image_tmp_to_save'      => sys_get_temp_dir() . '/',
		'generate_menu_array'    => 1, // если 1, тогда массив для меню будет
		// гененрироваться из файлов директории config/admin .
		// Или (если 0) будет браться из конфига admin.menu

		'models' => [
			'menus' => new \App\Models\Menu(),
		],


	];