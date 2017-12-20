@inject('Cloudder', '\JD\Cloudder\Facades\Cloudder')
@php

$imgUrl = Cloudder::show($data->icon,['version'=>447676863];
@endphp
<script src="/_admin/js/plugins/dropzone/dropzone.js"></script>
<div class="ibox" style="padding: 0">
	<div class="ibox-title" style="padding: 5px 0 5px 0; min-height:20px;border-bottom: none">
		<div class="ibox-tools">
			<a class="dropdown-toggle btn btn-white btn-bitbucket" data-toggle="dropdown" href="#">
				<i class="fa fa-bars"></i>
			</a>
			<ul class="dropdown-menu dropdown-user">
				<li><a href="#" class="icon-delete" data-public_id="{{$data->icon or 'null'}}"
				       onclick="return false"><i
							class="fa fa-trash"></i> Удалить</a></li>
			</ul>
		</div>
	</div>
	<div class="ibox-content" style="border: none;padding:0">
		<div id="iconLoad" class="icon_dropzone " style="margin-bottom: 20px"></div>
		<div id="iconPreview"><img src="{{Cloudder::show($data->icon,['version'=>447676863])  }}?t={{uniqid()}}"
		                           class="img-responsive img-thumbnail"></div>
		<div id="icon-preview" class="visually-hidden"></div>
	
	</div>
	<div class="ibox-footer">
	</div>
</div>
<script>
	var paramsData = {

		table : '{{$data->table}}',
		id    : '{{$data->id or "0"}}',
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
			$( "#iconPreview" ).html( '<figure class="image"><img src="' + dataUrl + '" class="img-responsive img-thumbnail animated fadeInDown" style="filter: blur(3px);"><figcaption style="color: #4874fc;font-size:20px;text-align:center">Идёт загрузка...</figcaption></figure>' );
		},
		success              : function( file, msg ){
			var res = jQuery.parseJSON( msg );
			$( "#iconPreview img" ).addClass( 'animated fadeOut' );
			/* $( "#iconPreview" ).html( '<img src="' + res.url + '" class="img-responsive img-thumbnail  animated fadeInDown">' );*/
			$( "#iconPreview" ).html( '<img src="' + res.thumb + '?t={{uniqid()}}" class="img-responsive img-thumbnail  animated fadeInDown">' );
		}
	} );


	$( "body" ).on( "click", '.icon-delete', function(){
		var public_id = $( this ).data( 'public_id' );
	 
		$.ajax( {
			method : "POST",
			url    : "/icondelete",
			data   : { public_id: public_id, _token: '{{csrf_token()}}' },
			success: function( msg ){
				console.log(  msg )
			}
		} )
	} );

</script>
