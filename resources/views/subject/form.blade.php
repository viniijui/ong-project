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
						<a href="{{ route('admin.subject.list') }}" class="btn btn-default btn-xs">
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
