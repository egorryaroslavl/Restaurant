@if($data && count(count( (array) $data ))>0)
 
	<table class="table table-striped table-hover dishes-table">
		<caption><span class="text-muted small pull-right" title="Количество: {{count((array)$data )}}">Количество: <i
					class="fa fa-unlink"></i> {{count((array)$data )}}</span></caption>
		<tbody @if($route === 'admin-yetconsists-dishes') id="sortable" @endif class="ui-sortable"
		       data-route="{{$route}}" data-table="{{$data->table or ''}}">
		
		@foreach($data as $item )
			<tr class="ui-state-default social-avatar item" id="id_{{$item->id}}" data-dishe_id="{{$item->id}}">
				<td><img alt="" src="{{iconThumbnail($item->icon_public_id)}}"></td>
				<td><a href="/admin/dishes/{{$item->id}}/edit" target="_blank"
				       title="Редактировать" class="client-link">{{$item->name}}</a></td>
				<td>
					<div data-table="{{$data->table or ''}}" @if($route === 'admin-yetconsists-dishes')
					class="dishes-reorder reorder" @endif></div>
				</td>
			</tr>
		
		@endforeach
		
		</tbody>
	</table>
	<script>
		/* Сортировка */
		$( "#sortable" ).sortable( {
			placeholder         : "ui-state-highlight",
			handle              : ".reorder",
			forceHelperSize     : true,
			forcePlaceholderSize: true,
			revert              : true,
			update              : function( ev, ui ){
				var sort_data = $( this ).sortable( 'serialize' );
				$.ajax( {
					type: 'POST',
					url : '/admin/dishes_reorder',
					data: {
						id       : $( "[name='id']" ).val(),
						sort_data: sort_data,
						table    : 'dishes_menus',
						_token   : $( "[name='_token']" ).val()
					}
				} );
			}
		} );
	</script>
@else
	<p><i class="fa fa-frown-o"></i> Пусто...</p>
@endif