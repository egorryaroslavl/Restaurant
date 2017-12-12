$( function(){

	var token = $( "[name='_token']" ).val();

	$( '.i-checks' ).iCheck( {
		checkboxClass: 'icheckbox_square-green',
		radioClass   : 'iradio_square-green',
	} );

	if( $( "#description" ).length > 0 ){
		CKEDITOR.config.allowedContent = true;
		CKEDITOR.replace( 'description', { height: '100', toolbar: 'CustomToolbarMax' } );
	}
	if( $( "#text" ).length > 0 ){
		CKEDITOR.config.allowedContent = true;
		CKEDITOR.replace( 'text', { height: '100', toolbar: 'CustomToolbarMax' } );
	}
	if( $( "#seo_text" ).length > 0 ){
		CKEDITOR.config.allowedContent = true;
		CKEDITOR.replace( 'seo_text', { height: '100', toolbar: 'CustomToolbarMin' } );
	}


	if( $( "#message" ).length > 0 ){
		CKEDITOR.replace( 'message' );
		CKEDITOR.config.allowedContent = true;
		CKEDITOR.config.height = 150;
	}

	/**
	 * Транслитерация
	 */
	/* в режиме редактирования делаем поле alias только для чтения */
	var url = document.location.pathname;
	if( /(edit)/.test( url ) ){
		$( "#alias" ).attr( 'readonly', true );
	}
	/* генерим alias транслитерацией поля name */
	$( "#name,#title,#question" ).keyup( function(){
		var url = document.location.pathname;
		if( /(create)/.test( url ) ){
			var res = jQuery.parseJSON( getAlias( $( "#name,#title,#question" ).val() ) );

			$( "[name='alias']" ).val( res.alias );
		} else{
			return false;
		}
	} );

	/* разрешаем обновление значения поля alias */
	$( "body" ).on( "click", "#update-alias", function(){
		var alias = $.trim( $( "#alias" ).val() );
		if( alias != '' ){
			if( confirm( "Будет сгенерирован новый алиас\n и он заменит собой существующий\nПродолжить?" ) ){
				var res = jQuery.parseJSON( getAlias( $( "#name,#title,#question" ).val() ) );
				$( "[name='alias']" ).val( res.alias );
			}
		}
	} );


	/**
	 * Get transliterated words
	 */
	function getAlias( alias ){
		response = $.ajax( {
			type : 'POST',
			url  : '/translite',
			async: false,
			data : { alias_source: alias, _token: token }
		} ).responseText;

		return response;
	}

	/**
	 * Конец Транслитерация
	 */


	/* Изменение статуса .public,.hit,.anons" */
	$( "body" ).on( "click", ".public,.hit,.anons", function(){
		var id = $( this ).data( 'id' );
		var table = $( this ).data( 'table' );
		var field = $( this ).attr( 'name' );
		var value = $( this ).val();
		var elId = field + "_" + id;
		$.ajax( {
			type   : "POST",
			url    : "/changestatus",
			data   : {
				table : table,
				id    : id,
				field : field,
				value : value,
				_token: token
			},
			success: function( msg ){
				var res = jQuery.parseJSON( msg );
				if( res.error == 'ok' ){
					changeStatus( field, elId, value );
				}
				if( res.error == 'error' ){
					alert( 'Изменение статуса закончилось ошибкой!' )
				}
			}
		} );

	} );

	changeStatus = function(field, elId, value) {

		var Idle = "i_" + elId;
		var newValue = value == 0 ? 1 : 0;
		$("#" + elId).val(newValue); // меняем значение кнопки
		if (newValue == 0) {
			$("#" + Idle).addClass('shadow');
			if (field == 'public') {
				$("#name_" + elId).addClass('shadow');
			}
		}
		if (newValue == 1) {
			$("#" + Idle).removeClass('shadow');
			if (field == 'public') {
				$("#name_" + elId).removeClass('shadow');
			}
		}

	}

	/* Сортировка */
	$("#sortable").sortable({
		placeholder: "ui-state-highlight",
		handle: ".reorder",
		forceHelperSize: true,
		forcePlaceholderSize: true,
		revert: true,
		update: function(ev, ui) {
			var sort_data = $(this).sortable('serialize');
			var table = $(this).data('table');
			$.ajax({
				type: 'POST',
				url: '/reorder',
				data: {
					sort_data: sort_data,
					table: table,
					_token: token
				}
			});
		}
	});
} );

