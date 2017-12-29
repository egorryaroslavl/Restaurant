$( function(){

	var iconPlace = $( '.icon-place' );
	var notConsists = $( '#notConsists' );
	var yetConsists = $( '#yetConsists' );
	var table = $( "[name='table']" ).val();
	var id = $( "[name='id']" ).val();
	var icon_public_id = $( "[name='icon_public_id']" ).val();
	var token = $( "[name='_token']" ).val();
	iconload();
	notconsists_dishes();
	yetconsists_dishes();


	function iconload(){
		if( iconPlace.length > 0 ){
			iconPlace.load( '/iconload', { table: table, id: id, icon_public_id: icon_public_id, _token: token } );
		}
	}

	function notconsists_dishes(){
		if( notConsists.length > 0 ){
			notConsists.load( '/admin/notconsists_dishes', { table: table, id: id, _token: token } );
		}

	}

	function yetconsists_dishes(){
		if( yetConsists.length > 0 ){
			yetConsists.load( '/admin/yetconsists_dishes', { table: table, id: id, _token: token } );
		}
	}

	dishes();

	function dishes(){
		$( "body" ).on( "dblclick", "tr.item", function(){

			var route = $( this ).parent().data( 'route' );
			var dishe_id = $( this ).data( 'dishe_id' );
			$.ajax( {
				method: "POST",
				url   : "/admin/dishes_control",
				data  : {
					route   : route,
					dishe_id: dishe_id,
					menu_id : id,
					table   : table,
					_token  : token
				}
			} )
				.done( function( msg ){
					var res = jQuery.parseJSON( msg );
					if( res.error == 'ok' ){
						notconsists_dishes();
						yetconsists_dishes();
					}
					if( res.error == 'error' ){
						alert( 'Операция закончилась ошибкой!' )
					}
				} );
		} );
	}

} );

