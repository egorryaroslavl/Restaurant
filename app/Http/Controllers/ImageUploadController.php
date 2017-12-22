<?php

	namespace App\Http\Controllers;

	use App\Models\Image;
	use App\Models\Menu;
	use Illuminate\Http\Request;
	use JD\Cloudder\Facades\Cloudder;

	class ImageUploadController extends Controller
	{
		public function uploadImages( Request $request )
		{

			if( $request->hasFile( 'photo' ) ){

				$tags    = [ 'restaurant' ];
				$options = [
					'width'         => 800,
					'height'        => 600,
					'crop'          => 'fill',
					'tags'          => 'restaurant',
					'format'        => 'png',
					'resource_type' => 'image',
					'invalidate'    => true,

				];
				//$publicId = uniqid();
				$publicId = 'iconMenuId' . $request->id;
				$filename = $request->file( 'photo' );


				Cloudder::upload( $filename, $publicId, $options, $tags );
				$result = Cloudder::getResult();
				/*			'public_id',
							'version',
							'url',
							'parameters',
							'alt',
							'description',
							'parent_table',
							'parent_id',*/



				\DB::table( 'icons' )->insert(
					[ 'public_id'  => $publicId,
					  'version'    => $result[ 'version' ],
					  'url'        => $result[ 'url' ],
					  'parameters' => json_encode( $result ),
                      'parent_table' => $request->table,
                      'parent_id'    => $request->id,
					]
				);


/*				$menu       = Menu::find( $request->id );
				$menu->icon = $publicId;

				$menu->save();*/
				echo json_encode( $result );
			}
		}

		public function deleteImages( Request $request )
		{

			//	require '../vendor/cloudinary/cloudinary_php/src/Api.php';
			//	$api = new \Cloudinary\Api();
			//	echo	$api->delete_resources([$request['public_id']] );

			/*URL:
DELETE /resources/image/upload?public_ids[]=image1&public_ids[]=image2
PHP:
$api->delete_resources(array("image1", "image2"));*/

			Cloudder::destroyImage( 'iconMenuId1' );


		}


	}
