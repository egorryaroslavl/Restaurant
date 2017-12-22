




/*
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
		acceptedFiles        : "image/!*",
		dictDefaultMessage   : "Бросьте изображение сюда.<br>Или кликните здесь.",
		thumbnail            : function( file, dataUrl ){
			$( "#iconPreview" ).html( '<figure class="image"><img src="' + dataUrl + '" class="img-responsive img-thumbnail animated fadeInDown" style="filter: blur(3px);"><figcaption style="color: #4874fc;font-size:20px;text-align:center">Идёт загрузка...</figcaption></figure>' );
		},
		success              : function( file, msg ){
			var res = jQuery.parseJSON( msg );
			$( "#iconPreview img" ).addClass( 'animated fadeOut' );

			$( "#iconPreview" ).html( '<img src="{{$imgUrl}}?t={{uniqid()}}" class="img-responsive img-thumbnail  animated fadeInDown">' );
		}
	} );

*/


$( function(){

	var iconPlace = $( '.icon-place' );
	var table = $( "[name='table']" ).val();
	var id = $( "[name='id']" ).val();
	var token = $( "[name='_token']" ).val();


	var paramsData = {
		table : table,
		id    : id,
		_token: token
	};





/*	Dropzone.autoDiscover = false;*/
/*
	$( "body" ).on( "click", '.icon_dropzone', function(){
		dropzone();
	});
*/


/*	$( "body" ).on( "click", '.icon-delete', function(){
		var public_id = $( this ).data( 'public_id' );

		$.ajax( {
			method : "POST",
			url    : "/icondelete",
			data   : { public_id: public_id, _token: '{{csrf_token()}}' },
			success: function( msg ){
				console.log( msg )
			}
		} )
	} );*/


} );

