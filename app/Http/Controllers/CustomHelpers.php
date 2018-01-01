<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\View\View;
	use Illuminate\Support\Facades\Route;
	use Collective\Html\HtmlFacade;
	use JD\Cloudder\Facades\Cloudder;
	use Carbon\Carbon;

	class CustomHelpers extends Controller
	{


		public static function iconThumbnail( $public_id, $params )
		{
			$width  = 150;
			$height = 150;
			if( $params ){
				$width  = $params[ 0 ];
				$height = $params[ 1 ];
			}

			$thumbParams = [ "width"         => $width,
			                 "height"        => $height,
			                 "crop"          => "fill",
			                 'default_image' => 'no-image_rn9n3d.png' ];

			$url = Cloudder::show( $public_id, $thumbParams );

			return $url != '' ? $url : '/images/no-image.png';


		}


		public static function thumbnail( $public_id )
		{
			$thumbParams = [ "width"         => 20,
			                 "height"        => 20,
			                 "crop"          => "fit",
			                 "html_width"    => 20,
			                 "html_height"   => 20,
			                 'default_image' => 'no-image_rn9n3d.png' ];
			$thumbUrl    = Cloudder::show( $public_id, $thumbParams );
			return '<span class="thumbnail_20x20" style="background-image:url(' . $thumbUrl . ')"></span>';

		}


		public static function bytesToHuman( $bytes )
		{
			$units = [ 'B',
				'KiB',
				'MiB',
				'GiB',
				'TiB',
				'PiB' ];

			for( $i = 0; $bytes > 1024; $i++ ){
				$bytes /= 1024;
			}

			return round( $bytes, 1 ) . ' ' . $units[ $i ];
		}


		public static function randId()
		{

			return str_replace( '.', '', uniqid( '', true ) );

		}


		public static function withFirstElement( $sourceArray, $customText = false )
		{
			$firstItem = config( 'admin.settings.first_item' );

			if( $customText ){
				$firstItem = [ null => ' :: ' . $customText . ' :: ' ];
			}

			if( count( $sourceArray ) === 0 ){
				$firstItem .= [ null => '   Список пуст...   ' ];
			}

			return $firstItem + $sourceArray;

		}

		public static function prev_next( $data, $id, $routeName )
		{
			$next = $data::where( 'id', '>', $id )->first();
			$prev = $data::where( 'id', '<', $id )->first();

			$nextLnk = '<a href="#" disabled="disabled" title="Пусто..." style="cursor:no-drop;opacity:0.5"><i class="fa fa-ban"></i></a>  ';
			if( $next !== null ){
				$nextLnk = '<a href="' . route( $routeName, $next ) . '" title="' . $next->name . '"><i class="fa fa-angle-right"></i> </a>  ';
			}
			$prevLnk = '<a href="#" disabled="disabled" title="Пусто..." style="cursor:no-drop;opacity:0.5"><i class="fa fa-ban"></i></a>  ';
			if( $prev !== null ){
				$prevLnk = '<a href="' . route( $routeName, $prev ) . '" title="' . $prev->name . '"><i class="fa fa-angle-left"></i></a>  ';
			}


			return $prevLnk . $nextLnk;

		}

		public static function priceFormat( $price )
		{
			$r = ' &#8381;';
			//$r = '  &#x20bd;';
			if( $price == 0 ){
				return '';
			}
			return number_format( $price, 2, ',', ' ' ) . $r;
		}


		public static function ruDate( $date )
		{
			$month = array( 1 => "января",
				"февраля",
				"марта",
				"апреля",
				"мая",
				"июня",
				"июля",
				"августа",
				"сентября",
				"октября",
				"ноября",
				"декабря" );
			if( $date !== null ){
				$carbon = Carbon::parse( $date );
				$d      = $carbon::parse( $date )->format( 'd' );
				$m      = $carbon::parse( $date )->format( 'n' );
				$y      = $carbon::parse( $date )->format( 'Y' );
				return $d . ' ' . $month[ $m ] . ' ' . $y;
			}
		}


		public static function translite( $string )
		{
			$dictionary = array(
				"А" => "a",
				"Б" => "b",
				"В" => "v",
				"Г" => "g",
				"Д" => "d",
				"Е" => "e",
				"Ж" => "zh",
				"З" => "z",
				"И" => "i",
				"Й" => "y",
				"К" => "K",
				"Л" => "l",
				"М" => "m",
				"Н" => "n",
				"О" => "o",
				"П" => "p",
				"Р" => "r",
				"С" => "s",
				"Т" => "t",
				"У" => "u",
				"Ф" => "f",
				"Х" => "h",
				"Ц" => "ts",
				"Ч" => "ch",
				"Ш" => "sh",
				"Щ" => "sch",
				"Ъ" => "",
				"Ы" => "yi",
				"Ь" => "",
				"Э" => "e",
				"Ю" => "yu",
				"Я" => "ya",
				"а" => "a",
				"б" => "b",
				"в" => "v",
				"г" => "g",
				"д" => "d",
				"е" => "e",
				"ж" => "zh",
				"з" => "z",
				"и" => "i",
				"й" => "y",
				"к" => "k",
				"л" => "l",
				"м" => "m",
				"н" => "n",
				"о" => "o",
				"п" => "p",
				"р" => "r",
				"с" => "s",
				"т" => "t",
				"у" => "u",
				"ф" => "f",
				"х" => "h",
				"ц" => "ts",
				"ч" => "ch",
				"ш" => "sh",
				"щ" => "sch",
				"ъ" => "y",
				"ы" => "y",
				"ь" => "",
				"э" => "e",
				"ю" => "yu",
				"я" => "ya",
				"-" => "_",
				" " => "_",
				"," => "_",
				"." => "_",
				"?" => "",
				"!" => "",
				"«" => "",
				"»" => "",
				":" => "",
				'ё' => "e",
				'Ё' => "e",
				"*" => "",
				"(" => "",
				")" => "",
				"[" => "",
				"]" => "",
				"<" => "",
				">" => "",
			);
			$string     = preg_replace( '/[^\w\s]/u', ' ', $string );
			$string     = mb_strtolower( strtr( strip_tags( trim( $string ) ), $dictionary ) );
			return preg_replace( '/[_]+/', '_', $string );
		}


	}
