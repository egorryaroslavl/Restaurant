<?php

	namespace App\Http\Controllers;

	use App\Models\Icon;
	use Illuminate\Http\Request;
	use Intervention\Image\Image;
	use JD\Cloudder\Facades\Cloudder;

	class IconController extends Controller
	{

		private $thumbParams = '';

		/**
		 * @param bool $arr
		 *
		 * @return array|mixed|string
		 */
		public function thumbParams( $arr = false )
		{
			$this->thumbParams = config( 'admin.settings.thumb_params' );

			return $arr ? array_merge( $this->thumbParams, $arr ) : $this->thumbParams;

		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function load( Request $request )
		{
			if( isset( $request->table ) ){

				$data = new Icon();

				$icon_public_id = \DB::table( $request->table )
					->where( 'id', $request->id )
					->pluck( 'icon_public_id' )
					->first();

				$iconPublicId = $icon_public_id === null
					? 'no-image_rn9n3d.png'
					: $icon_public_id;

				$data->tumbUrl = \Cloudder::show( $iconPublicId,
					$this->thumbParams( [ 'default_image' => 'no-image_rn9n3d.png' ] ) );


				$data->table          = $request->table;
				$data->id             = $request->id;
				$data->icon_public_id = $icon_public_id;
				return view( 'admin.common.icon', [ 'iconData' => $data ] );

			}


		}


		/**
		 * @param \Illuminate\Http\Request $request
		 */
		public function save( Request $request )
		{

			if( $request->hasFile( 'photo' ) ){

				$tags     = [ 'restaurant', 'icons', $request->table ];
				$options_ = config( 'admin.settings.icons_params' );

				$options = array_merge( $options_, $tags );

				/* Создаём public_id  используя рандомные числа */
				$publicId = 'icon' . title_case( $request->table ) . 'Id' . randId();

				$filename = $request->file( 'photo' );

				$uploadResult = \Cloudder::upload( $filename, $publicId, $options, $tags );

				$imageData = $uploadResult->getResult();

				if( $request->id !== null ){
					/* если это обновление, нужно удалить старую картинку и обновить поле public_id в БД */
					$ex = \DB::table( $request->table )
						->where( 'id', $request->id )
						->pluck( 'icon_public_id' )
						->first();
					if( $ex !== null ){
						Cloudder::destroyImage( $ex );
					}
					\DB::table( $request->table )
						->where( 'id', $request->id )
						->update( [ 'icon_public_id' => $publicId ] );

				}

				$thumbnail = \Cloudder::show( $publicId, $this->thumbParams( [ 'version' => $imageData[ 'version' ] ] ) );

				$report = [ 'url' => $thumbnail, 'publicId' => $publicId ];

				echo json_encode( $report );
			}

		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return string
		 */
		public function delete( Request $request )
		{

			if( $request->id != 0 ){

				Cloudder::destroyImage( $request->icon_public_id );
				$res = Icon::where( 'parent_id', '=', $request->id )
					->where( 'parent_table', '=', $request->table )
					->where( 'public_id', '=', $request->icon_public_id )
					->delete();

				if( $res > 0 ){
					return json_encode( [ 'error' => 'ok' ] );
				}
			}

			return json_encode( [ 'error' => 'error' ] );

		}


	}
