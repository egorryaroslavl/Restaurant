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
			<li class=""><a data-toggle="tab" href="#tab-2" onclick="return false">SEO</a></li>
		</ul>
		<div class="tab-content">
			<div id="tab-1" class="tab-pane active">
				<div class="panel-body">
					@include('admin.common.name_alias')
					<div class="hr-line-dashed"></div>
					@include('admin.common.icon_description_short_description')
					
					<div class="row">
						<div class="col-xs-3 col-xs-offset-3">
							{{Form::label('price','Цена')}}
							{{Form::text('price',$data->price,['class'=>'form-control','id'=>'price', ])}}
						</div>
						
						<div class="col-xs-6">
							{{Form::label('ingr','Ингридиенты')}}
							{{Form::text('ingr','',['class'=>'form-control','id'=>'ingr', ])}}
						
						</div>
						<style>
							
							#ingredientsList {
								padding-top: 5px;
								}
							
							.ingredientsItem {
								
								margin-bottom: 5px;
								margin-right:  5px;
								cursor:        default;
								
								}
							
							.ingredientsItem i {
								cursor: pointer;
								}
							
							.ing-delete {
								margin-right: 5px;
								cursor:       pointer;
								}
						</style>
						
						<script>
							$( "body" ).on( "keydown", "#ingr", function( e ){

								var ingr = $( this ).val();

								if( e.keyCode == 13 ){
									e.preventDefault();
									if( $.trim( ingr ) !== '' ){

										$( "#ingredientsList" ).append( '<div class="btn btn-success btn-xs ingredientsItem"><i class="fa fa-times" onclick="$(this).parent().remove();"></i>&nbsp;&nbsp;<span class="ingr">' + ingr + '</span><input type="hidden" name="ingredients[]" value="' + ingr + '"></div>' );
										$( this ).val( '' )

									}

								}


							} );


							$( function(){


								$( "#ingredientsList" ).sortable();
								$( "#ingredientsList" ).disableSelection();


							} );
							
						
						</script>
					
					</div>
					
					<div class="row">
						<div class="col-xs-3 col-xs-offset-3">
						</div>
						
						<div class="col-xs-6">
							<div id="ingredientsList">@if(isset($data->ingredients) && is_array($data->ingredients) && count($data->ingredients)>0)
									@foreach($data->ingredients as $item)
										<div class="btn btn-success btn-xs ingredientsItem"><i class="fa fa-times" title="Удалить"  onclick="$(this).parent().remove();"></i>&nbsp;&nbsp;<span class="ingr">{{$item}}</span><input type="hidden" name="ingredients[]" value="{{$item}}"></div> @endforeach
								@endif</div>
						</div>
					</div>
					
					<div class="hr-line-dashed"></div>
					@include('admin.common.public_anons_hit')
					<div class="hr-line-dashed"></div>
					@include('admin.common.relations_multiselect')
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