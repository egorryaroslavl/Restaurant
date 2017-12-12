<div class="btn-group">
	<a href="/admin/{{$data->table}}/{{$item->id}}/edit"
	   class="btn-info btn btn-xs"
	   title="Редактировать"
	   style="color: #fff"><i class="fa fa-edit"></i></a>
	
	<a href="/admin/{{$data->table}}/{{$item->id}}/delete"
	   class="btn-danger btn btn-xs del"
	   data-id="{{$item->id}}"
	   data-table="{{$data->table}}"
	   title="Удалить"
	   style="color: #fff"><i class="fa fa-trash"></i></a>
</div>