<?php

	namespace App\Http\Controllers;

	use App\Models\Menu;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;
	use Intervention\Image\Facades\Image;
	use JD\Cloudder\Facades\Cloudder;


	class MenusController extends Controller
	{

		function messages()
		{
			$strLimit = config( 'admin.settings.text_limit.text_short_description.', 600 );
			return [
				'name.required'         => 'Поле "Имя" обязятельно для заполнения!',
				'alias.required'        => 'Поле "Алиас" обязятельно для заполнения!',
				'name.unique'           => 'Значение поля "Имя" не является уникальным!',
				'alias.unique'          => 'Значение поля "Алиас" не является уникальным!',
				'description.required'  => 'Поле "Текст" обязятельно для заполнения!',
				'short_description.max' => 'Поле "Краткий текст" не должно быть более ' . $strLimit . ' символов!',

			];

		}


		public function index()
		{
			$data        = Menu::paginate( 20 );
			$data->table = 'menus';
			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2>Меню</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li></ol></div></div>';
			return view( 'admin.menu.index', [
				'data'        => $data,
				'breadcrumbs' => $breadcrumbs, ] );
		}


		public function create()
		{
			$data        = new Menu();
			$data->act   = 'admin-menus-store';
			$data->table = 'menus';
			$titleAction = '<strong>Создание нового меню</strong>';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i class="fa flaticon-menu-4"></i> Меню</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/menus">Меню</a></li><li>' . $titleAction . '</li></ol></div></div>';

			return view( 'admin.menu.form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );


		}

		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name' => 'required|unique:menus|max:255',
			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/menus/create' )
					->withErrors( $v )
					->withInput();
			}


			$input     = $request->all();
			$input     = array_except( $input, '_token' );
			$menuModel = Menu::create( $input );
			$id        = $menuModel->id;

			//	dd( [ $id, $input ] );

			/* если в имени файла нет 'upload' значит от ещё в /tmp */
			if( !empty( $request->icon ) && !strpos( $request->icon, 'upload' ) ){

				/* если файла нет, - сообщаем */
				if( !file_exists( $request->icon ) ){
					//	return [ 'error' => 'Файл не неайден!' ];
					return redirect( 'admin/menus/' . $request->id . '/edit' )
						->withErrors( [ 'error' => 'Файл не неайден!' ] )
						->withInput();
				}


				$baseName = basename( $request->icon );


				/* в /tmp файл имеет в имени _token Меняем его не id категории и прибавляем к нему путь для сохранения иконок */
				$fileName = config( 'admin.menus.icons_dir' ) . str_replace( $request->_token, $id, $baseName );
				/* абсоютный путь */
				$filePath = public_path( $fileName );
				/* также делаем для превью */
				$fileNameSmall = config( 'admin.menus.icons_dir' ) . str_replace( $request->_token, $id . '_small', $baseName );
				/* абсоютный путь для превью */
				$filePathSmall = public_path( $fileNameSmall );


				Image::make( $request->icon )
					->save( $filePath )
					->widen( config( 'admin.menus.icon_width' ), function ( $constraint ){
						$constraint->upsize();
					} )
					->heighten( config( 'admin.menus.icon_height' ), function ( $constraint ){
						$constraint->upsize();
					} )->save( $filePathSmall );
				//dd([$fileName,$filePath,$fileNameSmall,$filePathSmall ]);
				/* Теперь обновим поле icon именем с id */
				$menu       = Menu::find( $id );
				$menu->icon = $fileNameSmall;
				$menu->save();

			}

			\Session::flash( 'message', 'Запись добавлена!' );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/menus' );


		}


		public function edit( $id )
		{

			$data        = Menu::find( $id )->first();
			$data->table = 'menus';
			$data->act   = 'admin-menus-update';
			/*$data->icon  = json_decode( $data->icon, true );*/


			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i 
class="fa flaticon-menu-4"></i> Меню</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li 
class="active"><a href="/admin/menus">Меню</a></li><li>Редактирование <strong>[
 <a href="/' . $data->table . '/' . $data->alias . '" style="color:blue" title="Смотреть на пользовательской части">' . $data->name . ' <img
  src="/_admin/img/extlink.png" alt="" 
 style="margin:0"></a> ]</strong></li></ol></div></div>';

			return view( 'admin.menu.form', [
				'data'        => $data,
				'breadcrumbs' => $breadcrumbs,
			] );
		}

		public function update( Request $request )
		{

			dd( $request->related );

			$direct = isset( $request->submit_button_stay ) ? 'stay' : 'back';

			$v = \Validator::make( $request->all(), [
				'name' => [
					'required',
					Rule::unique( 'menus' )->ignore( $request->id ),
					'max:255',
				],

				'alias'             => [
					'required',
					Rule::unique( 'menus' )->ignore( $request->id ),
					'max:255',
				],
				'description'       => 'required',
				'short_description' => 'max:600',


			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/menus/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}

			$menu = Menu::find( $request->id );

			$input = $request->all();

			$input = array_except( $input, [ '_token', 'submit_button_back' ] );
			$menu->update( $input );
			$menu->save();


			\Session::flash( 'message', 'Запись обновлена!' );


			if( $direct == 'back' ){
				return redirect( url( '/admin/menus' ) );
			}

			if( $direct == 'stay' ){
				return redirect()->back();
			}
		}


		public static function iconsave( Request $request )
		{
			if( $request->hasFile( 'photo' ) ){

				$tags     = [ 'restaurant' ];
				$options  = [
					'width'         => 800,
					'height'        => 600,
					'crop'          => 'fill',
					'tags'          => 'restaurant',
					'format'        => 'png',
					'resource_type' => 'image',

				];
				$publicId = uniqid();
				$filename = $request->file( 'photo' );


				/*	$res = \Cloudinary::upload( $_FILES[ "photo" ][ "tmp_name" ],*/
				$options = [
					"public_id" => $publicId,
					"crop"      => "limit", "width" => "2000", "height" => "2000",
					"eager"     => [
						[ "width"  => 200, "height" => 200,
						  "crop"   => "thumb",
						  "radius" => 20 ],
					],
					"tags"      => [ "restaurant" ],
				];

				\Cloudder::upload( $filename, $publicId, $options, $tags );
				$res = \Cloudder::getResult();

				$menu = Menu::find( $request->id );

				$thumb = \Cloudder::show( $publicId,
					[ "width" => 300, "height" => 220, "crop" => "fill" ] );

				$result     = array_merge( $res, [ 'thumb' => $thumb ] );
				$menu->icon = $result[ 'url' ];
				$menu->save();
				echo json_encode( $result );


			}

		}


		public static function iconsave_( Request $request )
		{
			if( $request->hasFile( 'photo' ) ){

				/* Помещаем файл во временную директорию.
				При сохранении остальных данных заберём его оттуда */
				$uploads_dir = sys_get_temp_dir(); // системный /tmp
				$file        = $request->file( 'photo' );
				$ext         = $file->clientExtension();


				$name = 'icon_' . $request->table . "_" . $request->_token . ".png"; // новое имя файла


				$img = \Image::make( $file )
					->widen( config( 'admin.' . $request->table . '.icon_max_width' ), function ( $constraint ){
						$constraint->upsize();
					} )
					->heighten( config( 'admin.' . $request->table . '.icon_max_height' ), function ( $constraint ){
						$constraint->upsize();
					} )->save( $uploads_dir . '/' . $name );


				if( $img ){
					$data = (string)$img->encode( 'data-url' );
					return [ 'success'      => true,
					         'error'        => 'ok',
						//  'thumbnailUrl' => $img,
						     'thumbnailUrl' => $data,
						     'qquuid'       => $request->qquuid,
						     'message'      => $uploads_dir . '/' . $name ];
				}
			}
		}

		public static function iconget( Request $request )
		{


			if( $request->id != 0 ){
				$icon = \DB::table( $request->table )
					->select( [ 'icon' ] )
					->where( 'id', $request->id )->get();

				$resArr = [
					'success'      => false,
					'name'         => '',
					'thumbnailUrl' => '',
					'uuid'         => $request->_token,
				];


				if(
					!is_null( $icon[ 0 ]->icon )
					&& !empty( $icon[ 0 ]->icon )
					&& file_exists( public_path( $icon[ 0 ]->icon ) )
				)

					$resArr = [
						'success'      => true,
						'name'         => $icon[ 0 ]->icon,
						'thumbnailUrl' => $icon[ 0 ]->icon,
						'uuid'         => $request->_token,
					];

				return [ $resArr ];
			}

		}

		public static function icondelete( Request $request )
		{
			if( $request->id != 0 ){
				$icon = \DB::table( $request->table )
					->select( [ 'icon' ] )
					->where( 'id', $request->id )->get();


				if( is_null( $icon[ 0 ]->icon ) or empty( $icon[ 0 ]->icon ) ){

					return json_encode( [ 'error' => 'error', 'message' => 'В процессе удаления возникли ошибки!' ] );

				}
				$iconNameSmall = $icon[ 0 ]->icon;
				$iconName      = str_replace( '_small', '', $iconNameSmall );

				$iconNameSmallPath = public_path() . $iconNameSmall;
				$iconNamePath      = public_path() . $iconName;

				$iconNameSmallDel = false;
				$iconNameDel      = false;
				$resArr           = [
					'error'        => 'error',
					'success'      => false,
					'name'         => null,
					'thumbnailUrl' => null,
					'qquuid'       => $request->qquuid,
					'uuid'         => $request->qquuid,
				];


				if( file_exists( $iconNameSmallPath ) ){
					$iconNameSmallDel = unlink( $iconNameSmallPath );
				}
				if( file_exists( $iconNamePath ) ){
					$iconNameDel = unlink( $iconNamePath );
				}

				if( $iconNameDel && $iconNameSmallDel ){

					\DB::table( $request->table )
						->where( 'id', $request->id )
						->update( [ 'icon' => null ] );

					$resArr = [
						'error'        => 'ok',
						'success'      => true,
						'name'         => null,
						'thumbnailUrl' => null,
						'qquuid'       => $request->qquuid,
						'uuid'         => $request->qquuid,
					];

				}

				return [ $resArr ];


			}

		}

	}
