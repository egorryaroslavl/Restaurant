<?php

	namespace App\Http\Controllers;

	use App\Models\Dishe;
	use App\Models\DishesMenu;
	use App\Models\Menu;
	use Illuminate\Validation\Rule;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Route;
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
			//dishes_ingredients
			$data   = Menu::paginate( 20 );
			$dishes = Dishe::where( 'public', '=', 1 )->get();

			$data->dishes = $dishes;
			return view( 'menu.index', [ 'data' => $data ] );

		}


		public function admin_index()
		{
			$data        = Menu::paginate( config( 'admin.settings.per_page' ) );
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

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i class="fa flaticon-menu-1"></i> Меню</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/menus">Меню</a></li><li>' . $titleAction . '</li></ol></div></div>';

			return view( 'admin.menu.form', [ 'data'        => $data,
			                                  'breadcrumbs' => $breadcrumbs ] );


		}

		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name'  => 'required|unique:menus|max:255',
				'alias' => 'required|unique:menus|max:255',
			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/menus/create' )
					->withErrors( $v )
					->withInput();
			}


			$input = $request->all();
			$input = array_except( $input, [ '_token',
				'q',
				'submit_button_back' ] );

			$menuModel = Menu::create( $input );
			$id        = $menuModel->id;


			\Session::flash( 'message', 'Запись добавлена!' );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/menus' );


		}


		public function edit( $id )
		{

			$data = Menu::where( 'id', $id )->first();


			$data->table = 'menus';
			$data->act   = 'admin-menus-update';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i 
class="fa flaticon-menu-1"></i> Меню</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li 
class="active"><a href="/admin/menus">Меню</a></li><li>Редактирование <strong>[
 <a href="/' . str_singular( $data->table ) . '/' . $data->alias . '" style="color:blue" title="Смотреть на пользовательской части">' . $data->name . ' <img
  src="/_admin/img/extlink.png" alt="" 
 style="margin:0"></a> ]</strong>  ' . prev_next( $data, $id, 'admin-menus-edit' ) . '</li></ol></div></div>';

			return view( 'admin.menu.form', [
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
					Rule::unique( 'menus' )->ignore( $request->id ),
					'max:255',
				],

				'alias'             => [
					'required',
					Rule::unique( 'menus' )->ignore( $request->id ),
					'max:255',
				],
				/*'description'       => 'required',*/
				'short_description' => 'max:600',


			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/menus/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}

			$menu = Menu::find( $request->id );

			$input = $request->all();

			$input = array_except( $input, [ '_token',
				'submit_button_back' ] );
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


		public function detail( Request $request )
		{

			if( $request->alias ){

				$data = Menu::where( 'alias', '=', $request->alias )->first();

				return view( 'menu.detail', [ 'data' => $data ] );

			}

		}


		public function dishesList( Request $request )
		{

			$routeName = Route::currentRouteName();

			if( $routeName === 'admin-yetconsists-dishes' ){


				$sql  = "SELECT `dishe_id`, `pos`,
(select `id` from `dishes` where dishes.id = dishes_menus.dishe_id) as id,
(select `name` from `dishes` where dishes.id = dishes_menus.dishe_id) as name,
(select `alias` from `dishes` where dishes.id = dishes_menus.dishe_id) as alias,
(select `icon_public_id` from `dishes` where dishes.id = dishes_menus.dishe_id) as icon_public_id,
(select `description` from `dishes` where dishes.id = dishes_menus.dishe_id) as description,
(select `short_description` from `dishes` where dishes.id = dishes_menus.dishe_id) as short_description,
(select `price` from `dishes` where dishes.id = dishes_menus.dishe_id) as price,
(select `public` from `dishes` where dishes.id = dishes_menus.dishe_id) as public,
(select `anons` from `dishes` where dishes.id = dishes_menus.dishe_id) as anons,
(select `hit` from `dishes` where dishes.id = dishes_menus.dishe_id) as  hit,
(select `h1` from `dishes` where dishes.id = dishes_menus.dishe_id) as h1,
(select `price` from `dishes` where dishes.id = dishes_menus.dishe_id) as price 
FROM `dishes_menus` WHERE `menu_id`={$request->id} ORDER BY `pos` ASC";
				$data = \DB::select( $sql );


			}

			if( $routeName === 'admin-notconsists-dishes' ){

				$sql0 = "SELECT * FROM `dishes` where `id` NOT in (SELECT `dishe_id` FROM `dishes_menus` WHERE `menu_id` ={$request->id})";
				$data = \DB::select( $sql0 );

			}

			//	$data->table = $request->table;


			return view( 'admin.common.dishes_list', [ 'data'  => (object )$data,
			                                           'route' => $routeName ] );


		}


		public function dishesControl( Request $request )
		{

			// admin-notconsists-dishes
			// admin-yetconsists-dishes

			if( $request->route === 'admin-notconsists-dishes' ){

				$dishesMenu = DishesMenu::firstOrCreate(
					[ 'dishe_id' => $request->dishe_id,
					  'menu_id'  => $request->menu_id ]

				);


				\DB::table( 'dishes_menus' )
					->where( [
						[ 'dishe_id',
							'=',
							$request->dishe_id ],
						[ 'menu_id',
							'=',
							$request->menu_id ],
					] )
					->increment( 'pos' );
				return json_encode( [ 'error'   => 'ok',
				                      'message' => $dishesMenu->id ] );

			}

			if( $request->route === 'admin-yetconsists-dishes' ){

				$dishesMenu = DishesMenu::where( [
					[ 'dishe_id',
						'=',
						$request->dishe_id ],
					[ 'menu_id',
						'=',
						$request->menu_id ],
				] )->delete();

				return json_encode( [ 'error'   => 'ok',
				                      'message' => $dishesMenu ] );

			}
		}

	}
