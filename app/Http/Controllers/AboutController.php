<?php

	namespace App\Http\Controllers;

	use Egorryaroslavl\About\Models\AboutModel;
	use Illuminate\Http\Request;
	use Egorryaroslavl\About;

	class AboutController extends Controller
	{


		public function index()
		{

		$data =  AboutModel::find( 1 )->first();
		return view('themes.semper.about.index',['data'=>$data]);

		}

	}
