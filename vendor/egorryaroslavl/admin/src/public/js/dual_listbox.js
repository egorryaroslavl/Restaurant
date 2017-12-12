$( function(){


	oneItemToSecond();
	oneItemToFirst();
	allToSecond();
	allToFirst();
	allSelectedToSecond();
	allSelectedToFirst();
	listCount();

	$( "body" ).on( "click", "#first li,  #second li", function(){
		$( this ).toggleClass( 'ui-selected' )
	} );

	/*  Туда  */
	function oneItemToSecond(){

		$( "body" ).on( "dblclick", "#first li", function(){

			var element = $( this );
			var id = element.data( 'id' );
			var hiddenInput = '<input type="hidden" value="' + id + '" id="p' + id + '" name="related[]">';
			var clone = $( element )
				.clone()
				.removeClass( 'animated slideOutLeft' )
				.addClass( 'animated slideInLeft' ).append( hiddenInput );

			clone.prependTo( "#second" );
			element.addClass( 'animated slideOutRight' );
			setTimeout( function(){
				element.remove()
			}, 900 );
			listCount();
		} );
	}

	/*  Сюда  */
	function oneItemToFirst(){

		$( "body" ).on( "dblclick", "#second li", function(){
			var element = $( this );
			var id = element.data( 'id' );
			var clone = $( element )
				.clone()
				.removeClass( 'animated slideOutLeft slideInRight' )
				.addClass( 'animated slideInRight' );
			clone.prependTo( "#first" );
			$( '#p' + id ).remove();
			element.removeClass( 'animated slideOutLeft slideInRight' )
				.addClass( 'animated slideInLeft' );
			setTimeout( function(){
				element.remove()
			}, 900 );
			listCount();
		} );
	}

	/*  Все туда  */
	function allToSecond(){

		$( "body" ).on( "click", "#allToSecond", function(){

			var allOptions = $( "#first li " );

			if( allOptions.length > 0 ){
				allOptions.each( function( i ){
					var element = allOptions[ i ];
					var clone = $( element )
						.addClass( 'animated slideInRight' )
						.clone();
					var id = clone.data( 'id' );
					var hiddenInput = '<input type="hidden" value="' + id + '" id="p' + id + '" name="related[]">';
					clone.append( hiddenInput );
					clone.prependTo( "#second" );
					element.remove();
					listCount();
				} );

			}
		} );
	}


	/*  Все Сюда  */
	function allToFirst(){
		$( "body" ).on( "click", "#allToFirst", function(){
			var allOptions = $( "#second li:visible" );
			if( allOptions.length > 0 ){
				allOptions.each( function( i ){
					var element = allOptions[ i ];
					var clone = $( element )
						.addClass( 'animated slideInRight' )
						.clone();
					var id = clone.data( 'id' );
					clone.prependTo( "#first" );
					$( "#p" + id ).remove();
					element.remove();
					listCount();
				} );

			}

		} );

	}

	/* кнопка туда */
	function allSelectedToSecond(){

		$( "body" ).on( "click", "#firstToSecond", function(){
			var allOptions = $( "#first .ui-selected" );
			if( allOptions.length > 0 ){
				allOptions.each( function( i ){
					var element = allOptions[ i ];
					var clone = $( element )
						.addClass( 'animated slideInLeft' )
						.removeClass( 'ui-selected' )
						.clone();
					var id = clone.data( 'id' );
					var hiddenInput = '<input type="hidden" value="' + id + '" id="p' + id + '" name="related[]">';
					clone.append( hiddenInput );
					clone.prependTo( "#second" ).prop( 'selected', true );
					element.remove();
					listCount();
				} );

			}

		} );
	}


	function allSelectedToFirst(){

		$( "body" ).on( "click", "#secondToFirst", function(){

			var allOptions = $( "#second .ui-selected" );
			if( allOptions.length > 0 ){
				allOptions.each( function( i ){
					var element = allOptions[ i ];
					var clone = $( element )
						.addClass( 'animated slideInRight' )
						.removeClass( 'ui-selected' )
						.clone();
					var id = clone.data( 'id' );
					clone.prependTo( "#first" );
					$( "#p" + id ).remove();
					element.remove();
					listCount();
				} );
			}
		} );

	}

	function listCount(){

		var ulFirst, ulSecond, li, showFirstNum, showSecondNum, numFirst, numSecond;

		if( document.getElementById( 'first' ) !== null ){

			ulFirst = document.getElementById( 'first' );
			ulSecond = document.getElementById( 'second' );
			showFirstNum = document.getElementById( 'firstCount' );
			showSecondNum = document.getElementById( 'secondCount' );
			numFirst = ulFirst.getElementsByTagName( 'li' ).length;
			numSecond = ulSecond.getElementsByTagName( 'li' ).length;
			showFirstNum.innerHTML = numFirst;
			showSecondNum.innerHTML = numSecond;
		}

	}

} );