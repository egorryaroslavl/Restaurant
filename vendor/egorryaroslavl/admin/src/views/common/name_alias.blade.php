<div class="row">
    <div class="col-xs-6">
        <label for="name">Имя* <small>( max 255 символов )</small></label>
        <input
                type="text"
                name="name"
                class="form-control"
                id="name"
                value="{{$data->name or ""}}"
                placeholder="Имя">
    </div>
    <div class="col-xs-6">
        <label for="alias">Алиас* <small>( max 255 символов )</small></label>
	    <div class="input-group">
		    <input
			    name="alias"
			    class="form-control alias"
			    id="alias"
			    type="text"
			    value="{{$data->alias or "" }}"
			    placeholder="Алиас"
		    >

		    <div class="input-group-btn">
			    <button
				    type="button"
				    name="update-alias"
				    id="update-alias"
				    class="btn btn-primary update-alias"
				    style="border: 2px #3b8db9 solid"
			    >Обновить
			    </button>
		    </div>
		    <!-- /btn-group -->
	    </div>
    </div>
</div>

