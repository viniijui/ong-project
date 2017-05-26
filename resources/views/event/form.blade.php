@extends('layouts.admin.main')

@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{$title}}</h3>
					<div class="btn-group pull-right">
						<a href="{{ route('admin.event.list') }}" class="btn btn-default btn-xs">
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
						   	
						   	<div class="form-group{{ $errors->has('organizer') ? ' has-error' : '' }}">
						   	    {!! Form::label('organizer', 'Responsável:') !!}
						   	    {!! Form::text('organizer', (isset($data) ? $data->organizer : null), ['class' => 'form-control', 'required' => 'required']) !!}
						   	    <small class="text-danger">{{ $errors->first('organizer') }}</small>
						   	</div>

						   	<div class="form-group{{ $errors->has('place') ? ' has-error' : '' }}">
						   	    {!! Form::label('place', 'Local:') !!}
						   	    {!! Form::text('place', (isset($data) ? $data->place : null), ['class' => 'form-control', 'required' => 'required']) !!}
						   	    <small class="text-danger">{{ $errors->first('place') }}</small>
						   	</div>

						   	<div class="form-group{{ $errors->has('begin_date') ? ' has-error' : '' }}">
							    {!! Form::label('begin_date', 'Data de inicio:') !!}
							    {!! Form::date('begin_date', (isset($data) ? $data->begin_date : null), ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('begin_date') }}</small>
							</div>

							<div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
							    {!! Form::label('end_date', 'Data de fim:') !!}
							    {!! Form::date('end_date', (isset($data) ? $data->end_date : null), ['class' => 'form-control', 'required' => 'required']) !!}
							    <small class="text-danger">{{ $errors->first('end_date') }}</small>
							</div>

							 <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
						        {!! Form::label('description', 'Descrição:') !!}
						        {!! Form::textarea('description', (isset($data) ? $data->description : false), ['class' => 'form-control', 'required' => 'required', 'id' => 'ckeditor']) !!}
						        <small class="text-danger">{{ $errors->first('description') }}</small>
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