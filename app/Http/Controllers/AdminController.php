<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;

	class AdminController extends Controller
	{
		public function related( Request $request )
		{


			$relatedArr = json_decode( $request->related );

			/* если массив связанных непуст... */
			if( count( $relatedArr ) > 0 ){

				/* удаляем всё что было  */
				\DB::table( 'related_' . $request->table )
					->where( $request->table . '_id', '=', $request->id )->delete();

				$arr = [];
				/* удаляем всё что было  */
				foreach( $relatedArr as $item ){

					$arr[] = [
						$request->table . '_id' => $item->parent_id,
						'related_id'            => $item->related_id,
					];

				}

				\DB::table( 'related_' . $request->table )->insert( $arr );


			} else{
				\DB::table( 'related_' . $request->table )
					->where( $request->table . '_id', '=', $request->id )->delete();
			}

		}

		public static function relatedSelect( $table, $id )
		{

			$related_ids = \DB::table( 'related_' . $table )
				->where( $table . '_id', '=', $id )
				->pluck( 'related_id' )->all();


			$not_related_ids = \DB::table( $table )
				->whereNotIn( 'id', array_merge( $related_ids, [ $id ] ) )->pluck( 'id' )->all();


			$related = \DB::table( $table )
				->whereIn( 'id', $related_ids )->pluck( 'name', 'id' )->all();

			$not_related = \DB::table( $table )
				->whereIn( 'id', $not_related_ids )->pluck( 'name', 'id' )->all();


			$relatedSelect = \Form::select( 'to[]', $related, null,
				[
					'class'    => 'form-control relatedList related',
					'id'       => 'to',
					'size'     => 10,
					'multiple' => 'multiple',
				] );

			$not_relatedSelect = \Form::select( 'from[]', $not_related, null,
				[
					'class'    => 'form-control relatedList not_related',
					'id'       => 'from',
					'size'     => 10,
					'multiple' => 'multiple',
				] );


			return [ 'related' => $relatedSelect, 'not_related' => $not_relatedSelect ];

		}


	}
