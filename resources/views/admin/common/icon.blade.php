<script src="/_admin/js/plugins/dropzone/dropzone.js"></script>
<div id="iconLoad" class="icon_dropzone" style="margin-bottom:3px"></div>
<div id="iconPreview" class="imageWrap">
	<input type="hidden" name="icon_public_id" value="{{$iconData->icon_public_id or 'null'}}">
	<div class="controls">
		<button
			class="btn btn-danger btn-circle icon-delete"
			type="button"
			title="Удалить"
			data-icon_public_id="{{$iconData->icon_public_id or 'null'}}"
			data-table="{{$iconData->table or 'null'}}"
			data-id="{{$iconData->id or 'null'}}"
		><i class="fa fa-trash fa-lg"></i></button>
	</div>
	<img src="{{$iconData->tumbUrl}}"
	     class="img-responsive img-thumbnail">
</div>
<div id="icon-preview" class="visually-hidden"></div>
<style>
	.imageWrap {
		position: relative;
		}
	
	.imageWrap .controls {
		position:           absolute;
		left:               10px;
		width:              25px;
		height:             25px;
		top:                -30px;
		opacity:            0.0;
		z-index:            9999;
		-webkit-transition: all 0.5s ease;
		-moz-transition:    all 0.5s ease;
		-o-transition:      all 0.5s ease;
		transition:         all 0.5s ease;
		}
	
	.imageWrap .controls button {
		box-shadow: 3px 3px 6px #232323;
		border:     1px #ff2850 solid;
		}
	
	.imageWrap:hover .controls {
		top:     10px;
		opacity: 1.0;
		}
	
	.wait {
		position:   absolute;
		top:        0;
		left:       0;
		width:      100%;
		height:     100%;
		z-index:    9999;
		color:      #0a5400;
		font-size:  20px;
		text-align: center;
		background: rgba(255, 255, 255, 0.3);
		padding:    10px 5px;
		}
	
	.blure {
		filter: blur(3px);
		}
</style>
<script>
	var paramsData = {
		table : $( "[name='table']" ).val(),
		id    : '{{$iconData->id or "null"}}',
		_token: '{{csrf_token()}}'

	};
	Dropzone.autoDiscover = false;
	var iconDropzone = $( "div#iconLoad" ).dropzone( {
		previewsContainer    : "#icon-preview",
		autoProcessQueue     : true,
		createImageThumbnails: true,
		thumbnailWidth       : 350,
		thumbnailHeight      : 220,
		url                  : "/iconsave",
		params               : paramsData,
		parallelUploads      : 1,
		maxFilesize          : 5,
		paramName            : "photo",
		acceptedFiles        : "image/*",
		dictDefaultMessage   : "Бросьте изображение сюда.<br>Или кликните здесь.",
		thumbnail            : function( file, dataUrl ){
			$( "#iconPreview img.img-thumbnail" ).attr( 'src', dataUrl ).addClass( 'animated fadeIn blure' );
			$( "#iconPreview" ).prepend( '<div class="wait"><i class="fa fa-cloud-upload"></i> Идёт загрузка... </div>' );

		},
		success              : function( file, msg ){
			var res = jQuery.parseJSON( msg );
			var newUrl = res.url;
			/* Если это добавление новой записи  */
			if( res.publicId !== 'null' ){
				console.log( res.publicId )
				$( "[name='icon_public_id']" ).val( res.publicId );
				/*$( "#iconPreview" ).prepend( '<input type="hidden" name="icon_public_id" value="' + res.tmpId + '" >' );*/


			}
			$( "#iconPreview img" ).attr( { 'src': newUrl } ).addClass( 'animated fadeIn' ).removeClass( 'blure' );
			$( "#iconPreview div.wait" ).addClass( 'animated fadeOut' );
		}
	} );
	/* Удаление */
	$( "body" ).on( "click", ".icon-delete", function(){
		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		var public_id = $( this ).data( 'public_id' );
		if( $( "#iconPreview img" ).attr( 'src' ) === '/_admin/img/no-image.png' ){
			alert( "Чтобы удалить что-то ненужное, сначала нужно загрузить что-то ненужное.\nНечего удалять!" );
			return false;
		}
		$.ajax( {
			method : "POST",
			url    : "/icondelete",
			data   : {
				table         : table,
				id            : id,
				icon_public_id: icon_public_id,
				_token        : '{{csrf_token()}}'
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error === 'ok' ){
					$( "#iconPreview img" ).attr( { 'src': '/_admin/img/no-image.png' } ).addClass( 'animated fadeIn' );

				}
				if( res.error === 'error' ){
					alert( 'Удаление закончилось ошибкой!' )
				}
			}
		} );
	} );
</script>