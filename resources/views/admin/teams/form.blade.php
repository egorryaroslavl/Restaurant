@extends('admin.layouts.basic')
@section('content')
	@include('admin.common.errors_block')
	{{ Form::open( [ 'route' =>  $data->act ,'enctype'=>'multipart/form-data' ] ) }}
	@if(isset( $data->id ) ) {{ Form::hidden('id',$data->id )}} @endif
	@if(isset( $data->icon_public_id ) ) {{ Form::hidden('icon_public_id',$data->icon_public_id )}} @endif
	<div class="tabs-container">
		<ul class="nav nav-tabs">
			<li class="active"><a data-toggle="tab" href="#tab-1" onclick="return false">Основные данные</a>
			</li>
			<li><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
		</ul>
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">
				<div class="panel-body">
					@include('admin.common.name_alias_position')
					<div class="hr-line-dashed"></div>
					@include('admin.common.icon_description_short_description')
 					<div class="hr-line-dashed"></div>
					@include('admin.common.public_anons_hit')
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
@endsection