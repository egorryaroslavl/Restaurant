<div class="row">
	<div class="col-md-12">
		<div class="row dualbox">
			<div class="col-md-5 ">
				<h5>
					Выберите адресатов из этого списка кликая двойным кликом по ним.<br>
					Либо выделите нужные пункты кликая по ним и воспользуйтесь кнопками.<br>
					Кнопка Все Туда сработает без выделения.
				</h5>
				<p>Количество: <span id="firstCount" style="font-size: 20px"></span></p>
				<input
					type="text"
					class="form-control"
					name="firstFilter"
					id="firstFilter"
					title="Фильтр списка"
					placeholder="Фильтр списка"
					onkeyup="listFilter('first')"
				/>
				<ul id="first" name="first" class="list-unstyled list-group" title="">
					@if(isset( $first ) && count( $first ) > 0 )
						@foreach( $first as $firstItem )
							<li
								id="item{{$firstItem->id}}"
								class="list-group-item"
								data-id="{{$firstItem->id}}"><i title="{{$firstItem->name}}"></i> {{$firstItem->name}}
							</li>
						@endforeach
 
					@endif
				</ul>
			</div>
			<div class="col-md-2">
				<h5 style="text-align: center">
					Кнопки Туда и Сюда работают с выделенными пунктами.<br>
					Для работы с кнопками Все Туда и Все Сюда ничего выделять не нужно
				</h5>
				<div class="btn-group  btn-group-vertical center-block">
					<button
						class="btn btn-default right allToSecond"
						id="allToSecond"
						type="button">
						Все Туда <i class="fa fa-forward"></i>
					</button>
					<button
						class="btn btn-default firstToSecond"
						id="firstToSecond"
						type="button">
						Туда <i class="fa fa-play"></i>
					</button>
					
					<button
						class="btn btn-default"
						id="n"
						onclick="alert('Позиции списка никуда не были перемещены!')"
						type="button"><i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>
						Никуда <i class="fa fa-ellipsis-v"></i> <i class="fa fa-ellipsis-v"></i>
					</button>
					<button
						class="btn btn-default secondToFirst"
						id="secondToFirst"
						type="button">
						<i class="fa fa-play  fa-flip-horizontal"></i> Сюда
					</button>
					<button
						class="btn btn-default allToFirst"
						id="allToFirst"
						type="button">
						<i class="fa fa-backward"></i> Все Сюда
					</button>
				
				</div>
			</div>
			<div class="col-md-5">
				<h5>
					Удалите адресатов из этого списка рассылки, кликая двойным кликом по ним.<br>
					Либо выделите нужные пункты кликая по ним и воспользуйтесь кнопками.<br>
					Кнопка Все Сюда сработает без выделения.
				</h5>
				<p>Количество: <span id="secondCount" style="font-size: 20px"></span></p>
				<input
					type="text"
					class="form-control"
					name="secondFilter"
					id="secondFilter"
					title="Фильтр списка"
					placeholder="Фильтр списка"
					onkeyup="listFilter('second')"
				/>
				<ul
					id="second"
					name="second"
					class="list-unstyled list-group"
					title=""
					style="border:1px #f8fafb solid;height: 300px;background: #fff8f8">
					@if(isset( $second ) && count( $second ) > 0 )
						@foreach( $second as $secondItem )
							<li
								id="item{{$secondItem->id}}"
								class="list-group-item"
								data-id="{{$secondItem->id}}">{{$secondItem->name}} <input type="hidden" value="{{$secondItem->id}}" id="p{{$secondItem->id}}" name="related[]"/></li> @endforeach
						 
						 
					@endif
				 
				</ul>
			</div>
		</div>
	</div>
</div>
<script>
	function listFilter( name ){
		var input, filter, ul, li, i;
		input = document.getElementById( name + 'Filter' );
		filter = input.value.toUpperCase();
		ul = document.getElementById( name );
		li = ul.getElementsByTagName( 'li' );

		for( i = 0; i < li.length; i++ ){
			liElement = li[ i ];
			if( liElement.innerHTML.toUpperCase().indexOf( filter ) > -1 ){
				liElement.style.display = "";
			} else{
				liElement.style.display = "none";
			}
		}

	}


</script>