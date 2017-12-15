<?php

	namespace App\Http\Controllers;

	use App\Models\Menu;
	use Illuminate\Http\Request;

	class MenusController extends Controller
	{
		public function index()
		{
			$data        = Menu::paginate( 20 );
			$data->table = 'menus';
			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2>Меню</h2><ol class="breadcrumb"><li><a href="/admin">Главная</a></li></ol></div></div>';
			return view( 'admin.menu.index', [
				'data'        => $data,
				'breadcrumbs' => $breadcrumbs, ] );
		}




		public function create( Request $request )
		{
			$data               = new Menu();
			$data->act          = 'admin-menus-store';
			$data->table        = 'menus';
			$titleAction = '<strong>Создание нового меню</strong>';

			$breadcrumbs = '<div class="row wrapper border-bottom white-bg page-heading"><div class="col-lg-12"><h2><i class="fa flaticon-menu-4"></i> Меню</h2><ol 
class="breadcrumb"><li><a href="/admin">Главная</a></li><li class="active"><a href="/admin/menus">Меню</a></li><li>' . $titleAction . '</li></ol></div></div>';

			return view( 'admin.menu.form', [ 'data' => $data, 'breadcrumbs' => $breadcrumbs ] );


		}




	}
