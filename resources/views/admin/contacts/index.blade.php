@extends('admin.layouts.basic')
@section('content')
	<div class="wrapper wrapper-content animated fadeInRight">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="contact-box">
					
						<div class="col-sm-4">
							<div class="text-center">
								<img alt="logo" style="max-height:150px" class="img-circle m-t-xs img-responsive" src="{{$data->icon or '/_admin/img/no-logo.png'}}">
								<div class="m-t-xs font-bold">{{ $data->name or 'Название компании отсутствует'}}</div>
							</div>
						</div>
						<div class="col-sm-8" style="font-size:16px">
							<h3 style="font-size:24px"><strong>{{$data->name or 'Название компании отсутствует'}}</strong></h3>
							<p><i class="fa fa-map-marker"></i> {{$data->address or 'Почтовый адрес отсутствует'}}</p>
							<p><i class="fa fa-map-marker"></i>
								{{$data->legal_address or 'Юридический адрес отсутствует'}}
							</p>
							
							<p><i class="fa fa-phone"></i>
								{{$data->phones or 'Телефоны отсутствуют'}}
							</p>
							<p><i class="fa fa-envelope"></i>
								{{$data->email or 'Email отсутствует'}}
							</p>
							<p><i class="fa fa-globe"></i>
								{{$data->map or 'Карта отсутствует'}}
							</p>
							
							<p><i class="fa fa-clock-o"></i>
								{{$data->schedule or 'График работы отсутствует'}}
							</p>
							
							
						</div>
						<div class="clearfix"></div>
						
					
				</div>
				<a href="/admin/contacts/edit"><button class="btn btn-info btn-block"> <i class="fa fa-pencil-square"></i>  РЕДАКТИРОВАТЬ</button></a>
			</div>
		</div>
	</div>
@endsection