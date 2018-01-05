<?php

	namespace App\Http\Controllers;

	use App\Models\Team;
	use Illuminate\Validation\Rule;
	use Illuminate\Http\Request;

	class TeamsController extends Controller
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


		public function admin_index()
		{
			$data        = Team::paginate( config( 'admin.settings.per_page' ) )->sortBy( 'pos' );
			$data->table = 'teams';
			return view( 'admin.teams.index', [ 'data'=> $data ] );
		}



		public function create()
		{
			$data        = new Team();
			$data->act   = 'admin-teams-store';
			$data->table = 'teams';
			$titleAction = '<strong>Создание новой записи</strong>';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i class="fa flaticon-chef"></i> Команда</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/teams">Команда</a></li><li>' . $titleAction . '</li></ol></div></div>';

			return view( 'admin.teams.form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );


		}

		public function store( Request $request )
		{

			$v = \Validator::make( $request->all(), [
				'name' => 'required|unique:teams|max:255',
			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/teams/create' )
					->withErrors( $v )
					->withInput();
			}


			$input      = $request->all();
			$input      = array_except( $input, '_token' );
			$teamModel = Team::create( $input );
			$id         = $teamModel->id;


			\Session::flash( 'message', 'Запись добавлена!' );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/teams' );


		}

		public function edit( $id )
		{

			$data = Team::where( 'id', $id )->first();
			$data->table = 'teams';
			$data->act   = 'admin-teams-update';
			/*$data->icon  = json_decode( $data->icon, true );*/


			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i 
class="fa flaticon-chef"></i> Команда</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li 
class="active"><a href="/admin/teams">Команда</a></li><li>Редактирование <strong>[
 <a href="/' . $data->table . '/' . $data->alias . '" style="color:blue" title="Смотреть на пользовательской части">' . $data->name . ' <img
  src="/_admin/img/extlink.png" alt="" 
 style="margin:0"></a> ]</strong></li>  '.prev_next($data,$id,'admin-teams-edit').'</ol></div></div>';

			return view( 'admin.teams.form', [
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
					Rule::unique( 'teams' )->ignore( $request->id ),
					'max:255',
				],

				'alias'             => [
					'required',
					Rule::unique( 'teams' )->ignore( $request->id ),
					'max:255',
				],
				/*'description'       => 'required',*/
				'short_description' => 'max:600',


			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/teams/' . $request->id . '/edit' )
					->withErrors( $v )
					->withInput();
			}

			$menu = Team::find( $request->id );

			$input = $request->all();

			$input = array_except( $input, [ '_token',
				'submit_button_back' ] );
			$menu->update( $input );
			$menu->save();


			\Session::flash( 'message', 'Запись обновлена!' );


			if( $direct == 'back' ){
				return redirect( url( '/admin/teams' ) );
			}

			if( $direct == 'stay' ){
				return redirect()->back();
			}
		}





	}
