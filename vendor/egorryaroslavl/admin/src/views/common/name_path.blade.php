<div class="row">
	<div class="col-xs-6">
		<label for="name">Имя*
			<small>( max 255 символов )</small>
		</label>
		<input
			type="text"
			name="name"
			class="form-control"
			id="name"
			value="{{$data->name}}"
			placeholder="Имя">
	</div>
	<div class="col-xs-6">
		<label for="alias">URL*</label>
		<input
			type="text"
			name="path"
			class="form-control"
			id="path"
			value="{{$data->path}}"
			placeholder="URL">
	</div>
</div>