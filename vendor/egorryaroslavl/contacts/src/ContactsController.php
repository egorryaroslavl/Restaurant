<?php

	namespace Egorryaroslavl\Contacts;

	use App\Http\Controllers\Controller;
	use Egorryaroslavl\Contacts\Models\ContactModel;
	use Illuminate\Http\Request;


	class ContactsController extends Controller
	{

		function messages()
		{

			return [
				'name.required'  => 'Поле "Название компании" обязятельно для заполнения!',
				'name.max'       => 'Поле "Название компании" не должно быть более 255 символов!',
				'email.required' => 'Поле "Email" обязятельно для заполнения!',
				'email.email'    => 'Поле "Email" должно быть корректным email адресом!',
			];

		}

		public function index()
		{
			$breadcrumbs = '<h2>Контакты</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li><li><a>Контакты</a></li></ol>';


			/*  Если записи в БД нет, создаём пустую  */
			$count = \DB::table( 'contacts' )->count();
			if( $count === 0 ){
				\DB::table( 'contacts' )->insert( [ 'id' => 1, 'name' => '' ] );
			}

			$data = ContactModel::where( 'id', 1 )->first();

			return view( 'contacts::index', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );

		}


		public function edit()
		{
			$breadcrumbs = '<h2>Контакты</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li><li><a><a href="/admin/contacts">Контакты</a> [ редактирование ]</li></ol>';

			/*  Если записи в БД нет, создаём пустую  */
			$count = \DB::table( 'contacts' )->count();
			if( $count === 0 ){
				\DB::table( 'contacts' )->insert( [ 'id' => 1, 'name' => '' ] );
			}
			
			$data        = ContactModel::where( 'id', 1 )->first();
			$data->act   = 'contacts-store';
			return view( 'contacts::form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );

		}

		public function store( Request $request )
		{

			if( !empty( $request->icon ) && !strpos( $request->icon, 'uploads' ) ){

				$path_parts = pathinfo( $request->icon );
				$ext        = $path_parts[ 'extension' ];
				/*				$rand            = str_random( 6 );*/
				//	$file_name = "/uploads/icons/icon_contacts_logo." . $ext;
				$file_name = "/uploads/icons/icon_contacts_logo.png";
				//$file_name_small = "/uploads/icons/icon_contacts_logo_small." . $ext;
				$file_name_small = "/uploads/icons/icon_contacts_logo_small.png";

				$icon       = str_replace( '//', '/', public_path( $file_name ) );
				$icon_small = str_replace( '//', '/', public_path( $file_name_small ) );
				$img        = \Image::make( $request->icon )->encode( 'png', 75 );

				$img->save( $icon );
				$img->widen( config( 'admin.contacts.icon_width' ) );
				$img->save( $icon_small );

				$request->icon = $file_name_small;

			}


			//	dd( $request->all() );

			$v = \Validator::make( $request->all(), [
				'name'  => 'required|max:255',
				'email' => 'required|email',
			], $this->messages() );


			if( $v->fails() ){
				return redirect( 'admin/contacts/edit' )
					->withErrors( $v )
					->withInput();
			}

			$input = $request->all();

			$input = array_except( $input, [ 'submit_button_stay', 'submit_button_back', '_token' ] );

			if( isset( $file_name_small ) ){
				$input[ 'icon' ] = $file_name_small;
			}


			$contact = ContactModel::updateOrCreate( [ 'id' => $input[ 'id' ] ], $input );


			\Session::flash( 'message', 'Запись обновлена!' );

			if( isset( $request->submit_button_stay ) ){
				return redirect()->back();
			}
			return redirect( '/admin/contacts' );


		}

	}