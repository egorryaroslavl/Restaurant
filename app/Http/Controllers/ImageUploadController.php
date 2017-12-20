<?php

	namespace App\Http\Controllers;

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
				$res = Cloudder::getResult();

				$options_ = [
					"public_id" => $publicId . "_thumbnail",
					"crop"      => "fill",
					"width"     => 300,
					"height"    => 220,
					"tags"      => [ "restaurant", "thumbnail" ],
					"version"   => $res[ 'version' ],
				];


				$thumb      = Cloudder::show( $publicId, $options_ );
				$result     = array_merge( $res, [ 'thumb' => $thumb ] );
				$menu       = Menu::find( $request->id );
				$menu->icon = $publicId;
				//$menu->icon = json_encode( $result );
				//$menu->icon = $result[ 'url' ];
				$menu->save();
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
