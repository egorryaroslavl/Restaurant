$( function(){

	$( "#ingredientsList" ).sortable();
	$( "#ingredientsList" ).disableSelection();

	var iconPlace = $( '.icon-place' );
	var table = $( "[name='table']" ).val();
	var id = $( "[name='id']" ).val();
	var icon_public_id = $( "[name='icon_public_id']" ).val();
	var token = $( "[name='_token']" ).val();
	/* Загрузка иконки */
	if( iconPlace.length > 0 ){
		iconPlace.load( '/iconload', {
			table         : table,
			id            : id,
			icon_public_id: icon_public_id,
			_token        : token
		}, function(){
		} );
	}
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

} );


