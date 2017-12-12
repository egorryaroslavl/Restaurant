@if (\Session::has('message'))
	<div class="alert alert-info" style="font-size:22px"
	     onmousemove="setTimeout(function() {$('.alert' ).fadeOut(900);}, 1000)">{{ Session::get('message') }}</div>
@endif
@if(count($errors)>0)
	<div class="container-fluid" id="err">
		<div class="row">
			<div class="col-md-12">
				<div class="modal-header">
					<button type="button" class="close" title="Закрыть" onclick="$('#err' ).fadeOut(900);">×</button>
					<h3 class="modal-title" style="color:red" >Ошибка!</h3>
				</div>
				@foreach($errors->all() as $error)
					<p class="alert alert-danger">{{$error}}</p>
				@endforeach
				<script>
					window.onload = function(){
						document.getElementById( "err" ).focus();
					};
				</script>
			</div>
		</div>
	</div>
@endif