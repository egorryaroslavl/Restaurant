$( function(){

	var iconPlace = $( '.icon-place' );
	var table = $( "[name='table']" ).val();
	var id = $( "[name='id']" ).val();
	var token = $( "[name='_token']" ).val();

	if( iconPlace.length > 0 ){
		iconPlace.load( '/iconload', { table: table, id: id, _token: token }, function(){
		} );
	}


} );

