<?php

	namespace App\Http\Controllers;

	use App\Models\Icon;
	use Illuminate\Http\Request;
	use Intervention\Image\Image;
	use JD\Cloudder\Facades\Cloudder;

	class IconController extends Controller
	{

		private $thumbParams = '';

		public function thumbParams( $arr = false )
		{
			$this->thumbParams = config( 'admin.settings.thumb_params' );

			return $arr ? array_merge( $this->thumbParams, $arr ) : $this->thumbParams;

		}

		public function load( Request $request )
		{
			if( isset( $request->table ) ){

				$data = Icon::where( [
					[ 'parent_id', '=', $request->id ],
					[ 'parent_table', '=', $request->table ],
				] )->first();


				if( $data === null ){
					$data          = new Icon();
					$data->tumbUrl = '/_admin/img/no-image.png';
				} else{
					$data->tumbUrl = \Cloudder::show( $data->public_id,
						$this->thumbParams( [ 'version' => $data->version ] ) );
				}
				$data->table = $request->table;
				$data->id    = $request->id;
				return view( 'admin.common.icon', [ 'iconData' => $data ] );

			}


		}


		public function save( Request $request )
		{

			if( $request->hasFile( 'photo' ) ){

				$tags    = [ 'restaurant', 'icons' ];
				$options = [
					'width'         => 1000,
					'height'        => 1000,
					'crop'          => 'fill',
					'tags'          => $tags,
					'format'        => 'png',
					'resource_type' => 'image',
					'invalidate'    => true,

				];

				$publicId = 'iconMenuId' . $request->id;
				$filename = $request->file( 'photo' );

				$uploadResult = \Cloudder::upload( $filename, $publicId, $options, $tags );

				$imageData = $uploadResult->getResult();


				$thumbnail = \Cloudder::show( $publicId, $this->thumbParams( [ 'version' => $imageData[ 'version' ] ] ) );


				$count = Icon::where( [
					[ 'parent_id', '=', $request->id ],
					[ 'parent_table', '=', $request->table ],
					[ 'public_id', '=', $publicId ],
				] )->count();

				if( $count > 0 ){

					Icon::where( 'parent_id', '=', $request->id )
						->where( 'parent_table', '=', $request->table )
						->where( 'public_id', '=', $publicId )
						->update(
							[
								'version'    => $imageData[ 'version' ],
								'url'        => $imageData[ 'url' ],
								'thumbnail'  => $thumbnail,
								'parameters' => json_encode( $imageData ),
							]

						);
				} else{

					$icon               = new Icon();
					$icon->parent_id    = $request->id;
					$icon->parent_table = $request->table;
					$icon->public_id    = $publicId;
					$icon->version      = $imageData[ 'version' ];
					$icon->url          = $imageData[ 'url' ];
					$icon->thumbnail    = $thumbnail;
					$icon->parameters   = json_encode( $imageData );
					$icon->save();

				}


				echo json_encode( [ 'url' => $thumbnail ] );
			}

		}

		public function delete( Request $request )
		{

			if( $request->id != 0 ){

				Cloudder::destroyImage( $request->public_id );
				$res = Icon::where( 'parent_id', '=', $request->id )
					->where( 'parent_table', '=', $request->table )
					->where( 'public_id', '=', $request->public_id )
					->delete();

				if( $res > 0 ){
					return json_encode( [ 'error' => 'ok' ] );
				}
			}

			return json_encode( [ 'error' => 'error' ] );

		}


	}
