<div class="col-lg-6">
	<label>Поиск
		<small>(минимум 3 символа)</small>
	</label>
	<div class="input-group">

		<input
			type="text"
			class="form-control partner-search"
			name="partner_search"
			id="partner-search"
			list="partner-datalist"
			placeholder="Название или Email или Обращение">

		{{--<datalist id="partner-datalist"></datalist>--}}
		<span class="input-group-btn">
        <button
	        class="btn btn-default start-search"
	        name="start_search"
	        type="button">Найти</button>
      </span>
	</div>
</div>