@extends('layouts.admin.main')

@section('content')
	@include('layouts.admin.partials.alerts')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{$title}}</h3>
					@if (isset($back) and $back != false)
						<div class="btn-group pull-right">
							<a href="{{ route('admin.subject.time.list', $back) }}" class="btn btn-default btn-xs">
								<i class="fa fa-undo fa-fw"></i> Voltar
							</a>
						</div>
					@endif
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						{!! Form::open(['method' => (isset($data) ? 'PUT' : 'POST'), 'route' => $route_form , 'class' => 'form-horizontal']) !!}


							<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
							    {!! Form::label('subject', 'Materia:') !!}
							    {!! Form::select('subject', $array_subject,  (isset($data) ? $data->subject_id : null), ['id' => 'subject', 'class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('subject') }}</small>
							</div>
							<div class="form-group{{ $errors->has('year') ? ' has-error' : '' }}">
								{!! Form::label('year', 'Ano:') !!}
								{!! Form::number('year', (isset($data) ? $data->year : false), ['class' => 'form-control', 'required' => 'reqired', 'min' => 0]) !!}
								<small class="text-danger">{{ $errors->first('year') }}</small>
							</div>

							<div class="form-group{{ $errors->has('half') ? ' has-error' : '' }}">
								{!! Form::label('half', 'Periodo:') !!}
								{!! Form::select('half', ['1-semestre' => '1º Semestre', '2-semestre' => '2º Semestre'], (isset($data) ? $data->half : 1), ['id' => 'half', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('half') }}</small>
							</div>

							<div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }}">
								{!! Form::label('teacher', 'Prefessor:') !!}
								{!! Form::select('teacher', $array_teacher, (isset($first_teacher) ? $first_teacher : null), ['id' => 'teacher', 'class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('teacher') }}</small>
							</div>

							<div class="form-group{{ $errors->has('teacher2') ? ' has-error' : '' }}">
								<?php $array_teacher[0] = 'Escolha um professor' ?>
								{!! Form::label('teacher2', 'Prefessor 2:') !!}
								{!! Form::select('teacher2', $array_teacher, (isset($second_teacher) ? $second_teacher : 0), ['id' => 'teacher2', 'class' => 'form-control']) !!}
								<small class="text-danger">{{ $errors->first('teacher2') }}</small>
							</div>

							<div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
							    {!! Form::label('place', 'Local:') !!}
							    {!! Form::text('place', (isset($data) ? $data->place : null), ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('place') }}</small>
							</div>

							<div class="form-group{{ $errors->has('week_day') ? ' has-error' : '' }}">
							    {!! Form::label('week_day', 'Dia da Semana:') !!}
							    {!! Form::select('week_day', [1 => 'Segunda Feira', 2 => 'Terça Feira', 3 => 'Quarta Feira', 4 => 'Quinta Feira', 5 => 'Sexta Feira', 6 => 'Sabado'], (isset($data) ? $data->week_day : null), ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('week_day') }}</small>
							</div>

							<div class="form-group{{ $errors->has('situation') ? ' has-error' : '' }}">
								{!! Form::label('situation', 'Situação:') !!}
								{!! Form::select('situation', ['Inativo', 'Ativo'], (isset($data) ? $data->situation : null), ['id' => 'situation', 'class' => 'form-control', 'required' => 'required']) !!}
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
