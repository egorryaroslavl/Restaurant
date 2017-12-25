<?php


	if( !function_exists( 'bytesToHuman' ) ){
		/**
		 * @param $bytes
		 *
		 * @return string
		 */
		function bytesToHuman( $bytes )
		{
			return \App\Http\Controllers\CustomHelpers::bytesToHuman( $bytes );
		}

	}


	if( !function_exists( 'withFirstElement' ) ){
		/**
		 * @param      $sourceArray
		 * @param bool $customText
		 *
		 * @return array|mixed|string
		 */
		function withFirstElement( $sourceArray, $customText = false )
		{
			return \App\Http\Controllers\CustomHelpers::withFirstElement( $sourceArray, $customText = false );
		}

	}


	if( !function_exists( 'ruDate' ) ){
		/**
		 * @param $date
		 *
		 * @return string
		 */
		function ruDate( $date )
		{
			return \App\Http\Controllers\CustomHelpers::ruDate( $date );
		}
	}

	if( !function_exists( 'translite' ) ){
		function translite( $str )
		{
			return \App\Http\Controllers\CustomHelpers::translite( $str );
		}
	}


	if( !function_exists( 'thumbnail' ) ){
		/**
		 * @param $public_id
		 *
		 * @return string
		 */
		function thumbnail( $public_id )
		{
			return \App\Http\Controllers\CustomHelpers::thumbnail( $public_id );
		}
	}


	if( !function_exists( 'randId' ) ){
		/**
		 * @param $length
		 *
		 * @return string
		 */
		function randId(  )
		{
			return \App\Http\Controllers\CustomHelpers::randId( );
		}
	}

