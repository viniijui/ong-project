@extends('layouts.admin.main')

@section('content')
	@include('layouts.admin.partials.alerts')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{$title}}</h3>
					<div class="btn-group pull-right">
						<a href="{{ route('admin.reserve.list') }}" class="btn btn-default btn-xs">
							<i class="fa fa-undo fa-fw"></i> Voltar
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						{!! Form::open(['method' => (isset($data) ? 'PUT' : 'POST'), 'route' => $route_form , 'class' => 'form-horizontal']) !!}

							<div class="form-group {{ $errors->has('day') ? ' has-error' : '' }}">
								{!! Form::label('day', 'Data:') !!}
								{!! Form::date('day', (isset($data) ? $data->day : null), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('day') }}</small>
							</div>
							<div class="form-group{{ $errors->has('patrimony') ? ' has-error' : '' }}">
								{!! Form::label('patrimony', 'Patrimonio: ') !!}
								{!! Form::select('patrimony', $array_patrimony, (isset($data) ? $patrimony_input : null), ['id' => 'patrimony', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('patrimony') }}</small>
							</div>

							@if (isset($type) and $type == 'evento')
								{!! Form::hidden('event', $aux) !!}
							@else
								<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
									{!! Form::label('subject', 'Turma:') !!}
									{!! Form::select('subject', $options, (isset($data) ? $data->subject_time_id : null), ['id' => 'subject', 'class' => 'form-control', 'required' => 'required']) !!}
									<small class="text-danger">{{ $errors->first('subject') }}</small>
								</div>
							@endif
							<div class="row">
								<div class="btn-group pull-right">
									{!! Form::submit("Cadastrar", ['class' => 'btn btn-primary']) !!}
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
	<script src="{{ url('asset/ckeditor/ckeditor.js') }}"></script>
	<script>
		CKEDITOR.replace('ckeditor', {
			filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
			filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
			filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
			filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
		});
	</script>
@endsection
