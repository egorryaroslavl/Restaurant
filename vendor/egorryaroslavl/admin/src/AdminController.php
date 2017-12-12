<?php


	namespace Egorryaroslavl\Admin;

	use App\Http\Controllers\Controller;
	use Illuminate\Http\Request;


	class AdminController extends Controller
	{


		public function index()
		{
			return view( 'admin::index' );

		}

		public function translite( Request $request )
		{
			return json_encode(['alias'=>str_slug( strtolower( $request->alias_source ), '_' )]) ;
		}



 		public static function mainMenu()
		{

			$path = config_path( 'admin' );
			$menu = [];
			$mainLink = config('admin.menu');
			$menu[] = $mainLink[0];
			/* обходим директорию $path в поисках файлов конфигураций */
			foreach( glob( $path . "/*.php" ) as $filename ){
				$basename = basename( $filename );
				$fileName = str_replace( ".php", "", $basename );

				/* если в файле есть массив с ключом "menu" забираем его в массив $menu[]  */
				if( !is_null( config( 'admin.' . $fileName . '.menu' ) ) ){
					$menu[] = config( 'admin.' . $fileName . '.menu' );
				}

			}
			return $menu;
		}


		public static function iconsave( Request $request )
		{
			if( $request->hasFile( 'photo' ) ){

				/* Помещаем файл во временную директорию.
				При сохранении остальных данных заберём его оттуда */
				$uploads_dir = sys_get_temp_dir(); // системный /tmp
				$file        = $request->file( 'photo' );
				$ext         = $file->clientExtension();


				$name = 'icon_' . $request->table . "_" . $request->_token . ".png"; // новое имя файла


				$img = \Image::make( $file )
					->widen( config( 'admin.'.$request->table.'.icon_max_width' ), function ( $constraint ){
						$constraint->upsize();
					} )
					->heighten( config( 'admin.'.$request->table.'.icon_max_height' ), function ( $constraint ){
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
					'uuid'         => $request->_token
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
						'uuid'         => $request->_token
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
					'uuid'         => $request->qquuid
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
						'uuid'         => $request->qquuid
					];

				}

				return [ $resArr ];


			}

		}

	}