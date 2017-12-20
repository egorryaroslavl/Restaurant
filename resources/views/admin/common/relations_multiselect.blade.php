<script type="text/javascript" src="/_admin/js/plugins/multiselect-two-sides/dist/js/multiselect.js"></script>

<div class="row">

	<div class="col-xs-5">
		{!! \App\Http\Controllers\AdminController::relatedSelect($data->table,$data->id)['not_related'] !!}
	</div>
	<div class="col-xs-2">
		<button type="button" id="to_right_All" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i>
		</button>
		<button type="button" id="to_right_Selected" class="btn btn-block"><i
				class="glyphicon glyphicon-chevron-right"></i></button>
		<button type="button" id="to_left_Selected" class="btn btn-block"><i
				class="glyphicon glyphicon-chevron-left"></i></button>
		<button type="button" id="to_left_All" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i>
		</button>
	</div>
	<div class="col-xs-5">
		{!! \App\Http\Controllers\AdminController::relatedSelect($data->table,$data->id)['related'] !!}
		<span id="relatedInputsList"></span>
	</div>
</div>

<script>
	jQuery( document ).ready( function( $ ){

		inputsList( 'select#to option' );

		$( '#from' ).multiselect( {
			right           : '#to',
			rightAll        : '#to_right_All',
			rightSelected   : '#to_right_Selected',
			leftSelected    : '#to_left_Selected',
			leftAll         : '#to_left_All',
			search          : {
				left : '<input type="text" name="q" class="form-control" placeholder="Поиск...">',
				right: '<input type="text" name="q" class="form-control" placeholder="Поиск...">',
			},
			fireSearch      : function( value ){
				return value.length > 3;
			},
			afterMoveToRight: function(){
				inputsList( 'select#to option' );
				optionsList( 'select#to option' );

			},
			afterMoveToLeft : function(){
				inputsList( 'select#to option' );
				optionsList( 'select#to option' );
			}

		} );

		function optionsList( el ){

			var related = $( el ).map( function(){
				return {
					parent_id : '{{$data->id}}',
					related_id: $( this ).val(),
					table     : '{{$data->table}}'
				}

			} ).get();

			$.ajax( {
				method    : "POST",
				url       : "/admin/related",
				data      : {
					related: $.toJSON( related ),
					table  : '{{$data->table}}',
					id     : '{{$data->id}}',
					_token : '{{csrf_token()}}'
				}, success: function( msg ){
				}
			} );

		}

		function inputsList( el ){

			var related = $( el ).map( function(){
				return {
					parent_id : '{{$data->id}}',
					related_id: $( this ).val(),
					table     : '{{$data->table}}'
				}
			} ).get();

			if( related.length > 0 && $( "input[name='id']" ).length === 0 ){
				for( var i = 0; i < related.length; i++ ){
					var related_id = related[ i ].related_id;
					$( '#relatedInputsList' ).empty().append( '<input name="related[related_id][]" type="hidden" value="' + related_id + '">' );
				}
			}

		}

	} );
</script>