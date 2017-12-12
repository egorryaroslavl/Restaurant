<?php

	return [
		'company_name'      => 'Company Name',
		'company_site'      => '#',
		'image_max_width'   => 1000,
		'image_max_height'  => 800,
		'avatar_max_width'  => 1000,
		'avatar_max_height' => 800,
		'icon_width'        => 370,
		'icon_height'       => 210,
		'avatar_width'      => 200,
		'avatar_height'     => 200,
		'icon'              => [
			'agency'  => 'fa fa-user-secret',
			'tourist' => 'fa fa-heart',
			'staff'   => 'fa fa-user',
			'common'  => 'fa fa-question-circle',
		],
		'thumbnail_prefix'    => [
			'small'  => 'thumb_small_',
			'middle' => 'thumb_middle_',
			'large'  => 'thumb_large_',

		],
		'text_limit'=>[
		'short_description'=>300
		],
		'thumbnail_s'         => [ 'w' => 80, 'h' => 50 ],
		'thumbnail_m'         => [ 'w' => 220, 'h' => 140 ],
		'thumbnail_l'         => [ 'w' => 370, 'h' => 230 ],
		'avatar_thumbnail_s'  => [ 'w' => 50, 'h' => 50 ],
		'avatar_thumbnail_l'  => [ 'w' => 200, 'h' => 200 ],
		'avatar_path_to_save' => public_path() . '/icons/',
		'image_path_to_save'  => public_path() . '/uploads/images/',
		'image_tmp_to_save'   => sys_get_temp_dir() . '/',
		'generate_menu_array' => 1, // если 1, тогда массив для меню будет 
									// гененрироваться из файлов директории config/admin . 
									// Или (если 0) будет браться из конфига admin.menu




	];