<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            {{Form::label('description','Текст')}}
            {{Form::textarea('description',$data->description,['class'=>'form-control','id'=>'description' ])}}
            {{Form::label('short_description','Краткий текст( не более '. config('admin.settings.text_limit.short_description') .' символов)')}}
            {{Form::textarea('short_description',$data->short_description,['class'=>'form-control','id'=>'short_description','rows'=>'3'])}}
        </div>
    </div>
</div>