<?php
namespace App\Http\Controllers;
use App\Http\Controllers\UtilsController;
use App\Http\Controllers\ImageController;
?>
<div id="preview-templ" style="display: none;">
	<div id="wrap_ID" class="file-box col-md-4 dz-preview dz-file-preview">
		<div class="file">
			<span class="corner"></span>
			<div class="image"><a href="#" class="btn btn-danger btn-xs close-btn" title="Удалить" data-dz-remove><i
						class="fa fa-trash"></i></a>
				<img class="img-responsive" data-dz-thumbnail alt=""
				     title="Это превью может отображать лишь часть загруженного изображения"/>
			</div>
			<div class="file-name" style="padding: 0">
				{{--<input
					type="text"
					name="comment[ID]"
					id="comment{{$data->id,"0"}}"
					class="form-control img-comment">--}}
				<small data-dz-size></small>
			</div>
		</div>
	</div>
</div>
<div class="wrapper wrapper-content">
	<div class="row">
		<div class="col-md-3">
			<div class="ibox float-e-margins">
				<div class="ibox-content">
					<div class="file-manager click-here"></div>
					<div class="clearfix"></div>
					<p style="text-align: center">Не загружайте более 10-ти файлов за один раз.</p>
				</div>
			</div>
		</div>
		<div class="col-md-9 animated fadeInRight">
			<div class="row">
				<div class="col-md-12 dropzone-previews" id="images-place">
					@if(isset($data->id)
					&& isset($data->images)
					&& is_array($data->images)
					&& count($data->images)>0 )
						@foreach($data->images as $key => $item)
							@if(file_exists(public_path(). $item['image'] ))

								<div id="wrap_{{$key}}" class="file-box col-md-4 dz-preview dz-file-preview">
									<div class="file">
										<span class="corner"></span>
										<div class="image">
											<a
												href="#"
												onclick="return false"
												class="btn btn-danger btn-xs close-btn del-image"
												title="Удалить"
												data-id="{{$data->id,"0"}}"
												data-image="{{$item['image']}}"
												data-image-key="{{$key}}"
											><i
													class="fa fa-trash"></i>
											</a>
											<img src="{{ImageController::thumbnail_middle($item['image'])}}"
											     class="img-responsive {{$key}}" data-dz-thumbnail alt=""
											     title="Это превью может отображать лишь часть загруженного изображения"/>
										</div>
										<div class="file-name" style="padding: 0">

											<small data-dz-size
											       title="Показан вес файла исходного изображения.  Не этого превью!">
												<strong>{{ UtilsController::formatBytes(filesize( public_path(). $item['image'])) }}</strong>
											</small>
										</div>
									</div>
									<input
										type="text"
										name="comment[{{$key}}]"
										id="comment{{$data->id,"0"}}"
										value="{{$item['comment']}}"
										class="form-control img-comment">
									<input type="hidden" name="images[{{$key}}]" value="{{$item['image']}}">
								</div>

							@endif
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
<script>
	var paramsData = {

		table : '{{$data->table}}',
		id    : '{{$data->id or "0"}}',
		_token: '<?php echo csrf_token() ?>'
	};


	var getRandomInt = function( min, max ){
		return Math.floor( Math.random() * max ) + min;
	};

	var rand = getRandomInt( 1111, 9999 );


	Dropzone.createElement_ = function( string ){
		var div;
		div = document.createElement( "div.file-name" );
		div.innerHTML = string;
		return div.childNodes[ 0 ];
	};


	var html = function( id ){
		var str = document.getElementById( 'preview-templ' ).innerHTML;
		return str.replace( /ID/g, id );

		//return str.replace( "ID", rand );
	};

	Dropzone.autoDiscover = false;
	var imageDropzone = new Dropzone( ".file-manager",
		{
			url               : "/imagesave",
			clickable         : '.click-here',
			params            : paramsData,
			parallelUploads   : 5,
			maxFilesize       : 5,
			uploadMultiple    : false,
			addRemoveLinks    : false,
			thumbnailWidth    : 200,
			thumbnailHeight   : 200,
			paramName         : "photo",
			previewsContainer : "#images-place",
			previewTemplate   : html( rand ),
			//previewTemplate   : document.getElementById( 'preview-templ' ).innerHTML,
			acceptedFiles     : "image/*",
			dictDefaultMessage: "Бросьте изображение сюда.<br>Или кликните здесь.",


			init: function(){

				/*	this.on("success", function(file, msg) {
				 var res = jQuery.parseJSON( msg );

				 var removeButton = Dropzone.createElement_("<input type='text' name='comment["+res.rand_id+"] class='form-control img-comment' >");

				 file.previewElement.appendChild(removeButton);
				 });
				 */


				this.on( "success", function( file, msg ){


					var res = jQuery.parseJSON( msg );
					if( res.error == 'ok' ){

						var send_data = {
							table          : res.table,
							id             : res.id,
							image          : res.image,
							thumbnail_large: res.thumbnail_large,
							thumbnail_small: res.thumbnail_small,

						};


						var inpt = '<input type="hidden" name="images[' + res.rand_id + ']" value="' + res.image + '">';
						$( 'form' ).append( inpt );

						var inptComm = '<input type="text" name="comment[' + res.rand_id + ']" class="form-control img-comment" value="">';
						var commentInput = Dropzone.createElement_( inptComm );

						file.previewElement.appendChild( commentInput );


					}
					if( res.error == 'error' ){
						alert( 'Загрузка закончилась ошибкой!' )
					}


				} );

				this.on( "complete", function( file ){
					if( file.size > 2 * 1024 * 1024 ){
						this.removeFile( file );
						alert( "Загружаемый файл изображения слишком велик!\nМаксимальный размер файла не должен превышать 2Mb!" );
						return false;
					}

					if( !file.type.match( 'image.*' ) ){
						this.removeFile( file );
						alert( 'Это не изображение!' );
						return false;
					}
				} )


			}
		}
	);
	Dropzone.options.maxFiles = 10;

</script>