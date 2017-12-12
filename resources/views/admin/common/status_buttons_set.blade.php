<div data-toggle="buttons-checkbox" class="btn-group">
	<button
		type="button"
		name="public"
		title="@isset($item->public) @if(!$item->public) Не @endisset Публикуется @endisset"
		class="btn btn-xs btn-primary public"
		id="public_{{$item->id or ''}}"
		value="{{$item->public or ''}}"
		data-id="{{$item->id or ''}}"
		data-table="{{$data->table or ''}}"
		data-field="public"
		data-value="{{ $item->public ? '1' : '0' }}"
	><i id="i_public_{{$item->id}}" class="fa fa-eye @if( !$item->public ) shadow @endif"></i></button>
	<button
		type="button"
		name="anons"
		title="@isset($item->anons) @if(!$item->anons) Не @endisset Анонсируется @endisset"
		class="btn btn-xs btn-info anons"
		id="anons_{{$item->id}}"
		value="{{$item->anons}}"
		data-id="{{$item->id}}"
		data-table="{{$data->table or ''}}"
		data-field="anons"
		data-value="{{ $item->anons ? '1' : '0' }}"
	><i id="i_anons_{{$item->id}}" class="fa fa-bullhorn @if( !$item->anons ) shadow @endif "></i></button>
	<button
		type="button"
		name="hit"
		title="@isset($item->hit) @if(!$item->hit) Не @endisset Хит @endisset"
		class="btn btn-xs btn-success hit"
		id="hit_{{$item->id}}"
		value="{{$item->hit}}"
		data-id="{{$item->id}}"
		data-table="{{$data->table or ''}}"
		data-field="hit"
		data-value="{{ $item->hit ? '1' : '0' }}"
	><i id="i_hit_{{$item->id}}" class="fa fa-fire @if( !$item->hit ) shadow @endif"></i></button>
</div>