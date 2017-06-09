@extends('layouts.admin.main')
@section('content')
	@include('layouts.admin.partials.alerts')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<i class="fa fa-user"></i>
					<h3 class="box-title">{!! $title !!}</h3>
					<div class="btn-group pull-right">
						<a href="{{ route('admin.user.list') }}" class="btn btn-default btn-xs">
							<i class="fa fa-undo fa-fw"></i> Voltar
						</a>
					</div>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						{!! Form::open(['method' => (isset($data) ? 'PUT' : 'POST'), 'route' => (isset($data) ? ['admin.user.edit', 'id' => $data->id] : 'admin.user.store'), 'class' => 'form-horizontal']) !!}
							<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
								{!! Form::label('name', 'Nome Completo:') !!}
								{!! Form::text('name', (isset($data) ? $data->name : null), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('name') }}</small>
							</div>

							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								{!! Form::label('email', 'Email:') !!}
								{!! Form::email('email', (isset($data) ? $data->email : false), ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'eg: foo@bar.com']) !!}
								<small class="text-danger">{{ $errors->first('email') }}</small>
							</div>

							<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
								{!! Form::label('password', 'Senha:') !!}
								{!! Form::password('password', ['class' => 'form-control']) !!}
								<small class="text-danger">{{ $errors->first('password') }}</small>
							</div>

							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
								{!! Form::label('password_confirmation', 'Digite a senha novamente:') !!}
								{!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
							</div>

							@if (\Auth::user()->hasRole('root'))
								<div class="form-group">
								    <div class="checkbox{{ $errors->has('is_admin') ? ' has-error' : '' }}">
								        <label for="is_admin">
								            {!! Form::checkbox('is_admin', null, null, ['id' => 'is_admin']) !!} Este usuário é administrador?
								        </label>
								    </div>
								    <small class="text-danger">{{ $errors->first('is_admin') }}</small>
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
