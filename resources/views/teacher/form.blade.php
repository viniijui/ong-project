@extends('layouts.admin.main')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{$title}}</h3>
					<div class="btn-group pull-right">
						<a href="{{ route('admin.teacher.list') }}" class="btn btn-default btn-xs">
							<i class="fa fa-undo fa-fw"></i> Voltar
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						{!! Form::open(['method' => (isset($data) ? 'PUT' : 'POST'), 'route' => $route_form , 'class' => 'form-horizontal']) !!}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								{!! Form::label('name', 'Nome:') !!}
								{!! Form::text('name', (isset($data) ? $data->name : false), ['class' => 'form-control', 'required' => 'reqired']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="form-group{{ $errors->has('situation') ? ' has-error' : '' }}">
								{!! Form::label('situation', 'Situação:') !!}
								{!! Form::select('situation', ['Inativo', 'Ativo'], (isset($data) ? $data->situation : 1), ['id' => 'situation', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('situation') }}</small>
							</div>

							<div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
								{!! Form::label('cpf', 'CPF:') !!}
								{!! Form::text('cpf', (isset($data) ? $data->cpf : null), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('cpf') }}</small>
							</div>

							<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
								{!! Form::label('address', 'Endereço:') !!}
								{!! Form::text('address', (isset($data) ? $data->address : false), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('address') }}</small>
							</div>

							<div class="form-group{{ $errors->has('begin_date') ? ' has-error' : '' }}">
								{!! Form::label('begin_date', 'Data de admissão:') !!}
								{!! Form::date('begin_date', (isset($data) ? $data->begin_date : null), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('begin_date') }}</small>
							</div>
							@if (!isset($data))
								<div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
									{!! Form::label('user_id', 'Usuário:') !!}
									{!! Form::select('user_id', $userArray, null, ['class' => 'form-control', 'required' => 'required']) !!}
									<small class="text-danger">{{ $errors->first('user_id') }}</small>
								</div>
							@else
								<div class="well form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
									{!! Form::label('user_id', 'Usuário relacionado:') !!}
									<p>{{$user->name}}</p>
								</div>
							@endif

							<div class="row">
								<div class="btn-group pull-right">
									{!! Form::submit((isset($data) ? 'Editar' : 'Cadastrar'), ['class' => 'btn btn-primary']) !!}
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
