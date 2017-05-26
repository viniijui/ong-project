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

						    <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
						        {!! Form::label('weight', 'Peso:') !!}
						        {!! Form::text('weight', (isset($data) ? $data->weight : null), ['class' => 'form-control', 'required' => 'required']) !!}
						        <small class="text-danger">{{ $errors->first('weight') }}</small>
						    </div>
							
							<div class="form-group{{ $errors->has('teacher') ? ' has-error' : '' }}">
							    {!! Form::label('teacher', 'Profesor:') !!}
							    {!! Form::select('teacher', $array_teacher, (isset($teacher_input) ? $teacher_input : null), ['id' => 'teacher', 'class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('teacher') }}</small>
							</div>

							<div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
							    {!! Form::label('subject', 'Materia:') !!}
							    {!! Form::select('subject', $array_subject, (isset($data) ? $data->subject_id : null), ['id' => 'subject', 'class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('subject') }}</small>
							</div>
					
							<div class="form-group{{ $errors->has('day') ? ' has-error' : '' }}">
							    {!! Form::label('day', 'Dia da prova:') !!}
							    {!! Form::date('day', (isset($data) ? $data->day : null), ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('day') }}</small>
							</div>

						    <div class="form-group{{ $errors->has('situation') ? ' has-error' : '' }}">
						        {!! Form::label('situation', 'Situação:') !!}
						        {!! Form::select('situation', ['Inativo', 'Ativo'], (isset($data) ? $data->situation : 1), ['id' => 'situation', 'class' => 'form-control', 'required' => 'required']) !!}
						        <small class="text-danger">{{ $errors->first('situation') }}</small>
						    </div>

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