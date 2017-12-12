@extends('admin.layouts.basic')
@section('content')
	@include('admin.common.errors_block')
	
	{{  Form::open( [ 'route' =>  $data->act ,'enctype'=>'multipart/form-data' ] ) }}
	@if(isset( $data->id ) ) {{ Form::hidden('id',$data->id )}} @endif
	<input type="hidden" value="1" name="id"/>
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#tab-1" onclick="return false">Основные данные</a>
			</li>
			<li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
		</ul>
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">
				<div class="panel-body">
					
					<div class="row">
						<div class="col-md-3">
							<label>Логотип<br><small>(предпочтительная ширина - {{config('admin.contacts.icon_width')}}px.)</small></label>
							@include('admin.common.icon')
						</div>
						<div class="col-md-9">
							{{-- Название компании  Краткое название  --}}
							<div class="row">
								<div class="col-xs-6">
									<label for="name">Название компании*
										<small>( max 255 символов )</small>
									</label>
									<input
										type="text"
										name="name"
										class="form-control"
										id="name"
										value="{{$data->name or ''}}"
										placeholder="Название компании">
								</div>
								<div class="col-xs-6">
									<label for="short_name">Краткое название*
										<small>( max 255 символов )</small>
									</label>
									<input
										type="text"
										name="short_name"
										class="form-control"
										id="short_name"
										value="{{$data->short_name or ''}}"
										placeholder="Краткое название">
								</div>
							</div>
							
							
							{{-- Адрес физический  Адрес юридический  --}}
							<div class="row">
								<div class="col-xs-6">
									<label for="address">Адрес физический</label>
									<input
										type="text"
										name="address"
										class="form-control"
										id="address"
										value="{{$data->address or ''}}"
										placeholder="Адрес физический">
								</div>
								<div class="col-xs-6">
									<label for="legal_address">Адрес юридический</label>
									<input
										type="text"
										name="legal_address"
										class="form-control"
										id="legal_address"
										value="{{$data->legal_address or ''}}"
										placeholder="Адрес юридический">
								</div>
							</div>
							{{-- Телефоны  E-mail  --}}
							<div class="row">
								<div class="col-xs-6">
									<label for="phones">Телефоны</label>
									<input
										type="text"
										name="phones"
										class="form-control"
										id="phones"
										value="{{$data->phones or ''}}"
										placeholder="Телефоны">
								</div>
								<div class="col-xs-6">
									<label for="email">E-mail*</label>
									<input
										type="email"
										name="email"
										class="form-control"
										id="email"
										value="{{$data->email or ''}}"
										placeholder="E-mail">
								</div>
							</div>
							
							{{-- map  --}}
							<div class="row">
								<div class="col-xs-12">
									<label for="name">Карта</label>
									<input
										type="text"
										name="map"
										class="form-control"
										id="map"
										value="{{$data->map or ''}}"
										placeholder="Карта">
								</div>
							
							</div>
							@include('admin.common.schedule')
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4">
							<label for="block1">Блок #1</label>
							<textarea
								name="block1"
								class="form-control"
								id="block1"
								rows="6"
								placeholder="Блок #1">{{$data->block1 or ''}}</textarea>
						</div>
						
						<div class="col-xs-4">
							<label for="block2">Блок #2</label>
							<textarea
								name="block2"
								class="form-control"
								id="block2"
								rows="6"
								placeholder="Блок #2">{{$data->block2 or ''}}</textarea>
						</div>
						<div class="col-xs-4">
							<label for="block3">Блок #3</label>
							<textarea
								name="block3"
								class="form-control"
								id="block3"
								rows="6"
								placeholder="Блок #3">{{$data->block3 or ''}}</textarea>
						</div>
					</div>
				</div>
			</div>
			<div id="tab-2" class="tab-pane">
				<div class="panel-body">
					@include('admin.common.metatag_title_metatag_description_metatag_keywords')
				</div>
			</div>
		</div>
	</div>
	<div class="hr-line-dashed"></div>
	<div class="row">
		<div class="col-xs-12" style="margin-bottom: 60px">
			@include('admin.common.submit_button_with_choice_redirect')
			{!! Form::close() !!}
		</div>
	</div>
	<style>
		.dropzone {
			background: #efefef none repeat scroll 0 0;
			border:     1px solid #ededed !important;
			min-height: 150px;
			padding:    3px;
			}
	</style>
@endsection

