<?php

	namespace App\Http\Controllers;

	use App\Models\Dishe;
	use Illuminate\Http\Request;
	use Illuminate\Validation\Rule;
	use Intervention\Image\Facades\Image;
	use JD\Cloudder\Facades\Cloudder;

	class DishesController extends Controller
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


		/**
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index()
		{

			$data        = Dishe::paginate( config( 'admin.settings.per_page' ) );
			$data->table = 'dishes';

			return view( 'admin.dishes.index', [ 'data' => $data ] );

		}


		public function create()
		{
			$data        = new Dishe();
			$data->act   = 'admin-dishes-store';
			$data->table = 'dishes';
			$titleAction = '<strong>Создание нового блюда</strong>';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i class="fa flaticon-dishe2"></i> Блюда</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/dishes">Блюда</a></li><li>' . $titleAction . '</li></ol></div></div>';

			return view( 'admin.dishes.form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );


		}


		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name' => 'required|unique:dishes|max:255',
			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/dishes/create' )
					->withErrors( $v )
					->withInput();
			}


			$input      = $request->all();
			$input      = array_except( $input, '_token' );
			$disheModel = Dishe::create( $input );
			$id         = $disheModel->id;


			\Session::flash( 'message', 'Запись добавлена!' );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/dishes' );


		}


		/**
		 * @param $id
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function edit( $id )
		{

			$data = Dishe::where( 'id', $id )->first();
			$data->table = 'dishes';
			$data->act   = 'admin-dishes-update';
			/*$data->icon  = json_decode( $data->icon, true );*/


			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i 
class="fa flaticon-dishe2"></i> Блюда</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li 
class="active"><a href="/admin/dishes">Блюда</a></li><li>Редактирование <strong>[
 <a href="/' . $data->table . '/' . $data->alias . '" style="color:blue" title="Смотреть на пользовательской части">' . $data->name . ' <img
  src="/_admin/img/extlink.png" alt="" 
 style="margin:0"></a> ]</strong></li>  '.prev_next($data,$id,'admin-dishes-edit').'</ol></div></div>';

			return view( 'admin.dishes.form', [
				'data'        => $data,
				'breadcrumbs' => $breadcrumbs,
			] );
		}

		public function update( Request $request )
		{


			$direct = isset( $request->submit_button_stay ) ? 'stay' : 'back';

			$v = \Validator::make( $request->all(), [
				'name' => [
					'required',
					Rule::unique( 'dishes' )->ignore( $request->id ),
					'max:255',
				],

				'alias'             => [
					'required',
					Rule::unique( 'dishes' )->ignore( $request->id ),
					'max:255',
				],
				/*'description'       => 'required',*/
				'short_description' => 'max:600',


			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/dishes/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}

			$dishe = Dishe::find( $request->id );

			$input = $request->all();

			$input = array_except( $input, [ '_token', 'submit_button_back' ] );
			$dishe->update( $input );
			$dishe->save();


			\Session::flash( 'message', 'Запись обновлена!' );


			if( $direct == 'back' ){
				return redirect( url( '/admin/dishes' ) );
			}

			if( $direct == 'stay' ){
				return redirect()->back();
			}
		}

		/**
		 * @param \Illuminate\Http\Request $request
		 *
		 * @return string
		 */
		public function dishes_reorder( Request $request )
		{

			if( isset( $request->sort_data ) ){

				$id        = array();
				$table     = $request->table;
				$sort_data = $request->sort_data;

				parse_str( $sort_data );

				$count = count( $id );
				for( $i = 0; $i < $count; $i++ ){
					\DB::update( 'UPDATE `' . $table . '` SET `pos`=' . $i . ' WHERE `dishe_id`=? AND `menu_id`=? ', [ $id[ $i ] ,  $request->id ] );

				}

				return 'true';
			}

			return 'false';
		}


	}
