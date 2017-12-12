<script src="/_admin/js/plugins/fine-uploader/fine-uploader.js"></script>
<script type="text/template" id="qq-template-icon">
	<div class="qq-uploader-selector">
		<div class="row">
			<div class="col-md-12">
 				<div class="btn btn-info btn-block qq-upload-button-selector qq-upload-button"><i class="fa fa-image"></i> Выбрать файл
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="thumbnail">
					<div class="caption"
					     style="min-height: 220px;background: url('/_admin/img/drop-here.png') 50% 50% no-repeat;background-size: contain;padding:5px 0">
						<div class=" qq-upload-drop-area-selector" style="width: 100%;height:150px"
						     qq-hide-dropzone></div>
						<ul class="qq-upload-list-selector list-unstyled" role="region" aria-live="polite"
						    aria-relevant="additions removals" style="padding: 0;margin: 0">
							<li><span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
								<div class="qq-progress-bar-container-selector qq-progress-bar-container">
									<div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
									     class="qq-progress-bar-selector qq-progress-bar"></div>
								</div>
								<span class="qq-upload-spinner-selector qq-upload-spinner"></span>
								<div class="qq-thumbnail-wrapper">
									<img src="{{  $data->icon   or ''}}" id="picture"
									     class="qq-thumbnail-selector img-responsive img-thumbnail" qq-server-scale>
								</div>
 
								<button type="button"
								        class="btn btn-block btn-danger qq-upload-delete-selector qq-upload-delete">
									<i class="fa fa-trash"></i> Удалить
								</button>
								
								<button type="button" class="btn btn-block btn-warning qq-upload-cancel-selector">
									<i class="fa fa-ban"></i> Закрыть
								</button>
							
							</li>
						</ul>
				
						<dialog class="qq-alert-dialog-selector">
							<div class="qq-dialog-message-selector"></div>
							<button type="button" id="delete-icon" class="btn btn-info qq-cancel-button-selector">
								Закрыть
							</button>
						</dialog>
					</div>
				</div>
			</div>
		</div>
 	</div>
</script>
<div id="fine-uploader-icon"></div>
<script>
 $( function(){

		var uploader = new qq.FineUploader( {
			element   : document.getElementById( "fine-uploader-icon" ),
			template  : 'qq-template-icon',
			debug     : true,
			multiple  : false,
			request   : {
				endpoint : '/iconsave',
				inputName: 'photo',
				params   : {
					table : "{{$data->table}}",
					id    : '{{$data->id,"0"}}',
					_token: "{{csrf_token()}}"
				}
			},
			deleteFile: {
				enabled     : true,
				forceConfirm: true,
				method      : "POST",
				endpoint    : '/icondelete',
				params      : {
					table : "{{$data->table}}",
					id    : '{{$data->id,"0"}}',
					_token: "{{csrf_token()}}"
				}
			},
			validation: {
				allowedExtensions: [ 'jpeg', 'jpg', 'gif', 'png' ],
				sizeLimit        : 2000000,
				image            : {
					minHeight: 50,
					minWidth : 50
				}

			},
			session   : {
				endpoint: '/iconget',
				params  : {
					table : "{{$data->table}}",
					id    : '{{$data->id,"0"}}',
					_token: "{{csrf_token()}}",

				}
			},

			thumbnails: {
				placeholders: {
					waitingPath: '/_admin/js/plugins/fine-uploader/placeholders/waiting-generic.png',
 
				}
			},

			callbacks: {
				onSessionRequestComplete: function( response, success, xhrOrXdr ){

					if( !response.success ){

					/*	$( ".qq-upload-delete-selector" ).hide();*/
						$( ".qq-upload-cancel-selector" ).hide();

					}

				},
				onComplete              : function( id, fileName, responseJSON, xhr ){

					if( responseJSON.success ){

						$( "#icon" ).remove();
						$( '#fine-uploader-icon' ).append( '<input type="hidden" name="icon" id="icon" value="' + responseJSON.message + '" />' );
					}


				},
				onCancel                : function(){
					$( '.caption' ).animate( {
						'background-position-y': 0
					}, 900, function(){
					} );
				}

			},

			messages: {
				sizeError          : 'Файл слишком велик!  Лимит - {sizeLimit}.',
				typeError          : 'Файл имеет недопустимый тип. Допустимые типы: {extensions}.',
				minHeightImageError: 'Высота изображения недопустимо мала!',
				minWidthImageError : 'Ширина изображения недопустимо мала!',
				onLeave            : 'Загрузка файла ещё не завершена! Если вы покините страницу процесс будет прерван!'
			}


		} );
 
	} );
</script>
<style>.qq-alert-dialog-selector{-webkit-box-shadow:2px 6px 15px 0 rgba(50,50,50,0.75);-moz-box-shadow:2px 6px 15px 0 rgba(50,50,50,0.75);box-shadow:2px 6px 15px 0 rgba(50,50,50,0.75);border:1px #9999c1 solid;border-radius:6px;background:-moz-linear-gradient(90deg,#fff 80%,#ff1e00 80%);background:-webkit-linear-gradient(90deg,#fff 80%,#ff1e00 80%);background:-o-linear-gradient(90deg,#fff 80%,#ff1e00 80%);background:linear-gradient(0deg,#fff 80%,#ff1e00 80%)}.qq-dialog-message-selector{padding:20px;font-size:20px;margin-top:10px}.qq-upload-list-selector{padding:0;margin:0}.qq-upload-list-selector li{padding:0;margin:0;text-align:center}.qq-gallery.qq-uploader{position:relative;min-height:220px;overflow-y:hidden;width:inherit;border-radius:6px;border:1px dashed #CCC;background-color:#FAFAFA;padding:8px}</style>