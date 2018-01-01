<div class="row">
	<div class="col-xs-5 col-xs-push-1">
		<input
			type="submit"
			class="btn btn-primary btn-block"
			name="submit_button_back"
			value="ГОТОВО и к списку">
	</div>
	<div class="col-xs-5 col-xs-pull-0">
		<input
			type="submit"
			class="btn btn-info btn-block"
			name="submit_button_stay"
			value="@if(preg_match('/create/',url()->current()) ) ГОТОВО и добавить ещё @else ГОТОВО и остаться @endif">
	</div>
</div>