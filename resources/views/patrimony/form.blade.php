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
						<a href="{{ route('admin.patrimony.list') }}" class="btn btn-default btn-xs">
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

							<div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
								{!! Form::label('key', 'Ńº do Patrimonio:') !!}
								{!! Form::text('key', (isset($data) ? $data->key : null), ['class' => 'form-control', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('key') }}</small>
							</div>

							<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
								{!! Form::label('price', 'Preço:') !!}
								{!! Form::text('price', (isset($data) ? $data->price : null), ['class' => 'form-control money', 'required' => 'required']) !!}
								<small class="text-danger">{{ $errors->first('price') }}</small>
							</div>

							<input name="qtd" type="hidden" value="1">

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
	<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
	<script>
		$('.money').mask('000.000.000.000.000,00', {reverse: true});
	</script>
@endsection
