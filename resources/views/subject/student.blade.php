@extends('layouts.admin.main')
@section('content')
	@include('layouts.admin.partials.alerts')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{ $title }}</h3>
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-xs btn-default" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-fw fa-plus"></i>
							Adicionar Aluno
						</button>
					</div>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						<table class="table table-bordered table-hover" id="example1">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Adminitrar</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $row)
									<tr>
										<td>{!!$row->name!!}</td>
										<td>
											<a href="{!! route('admin.subject.time.student.delete', ['user' => $row->id, 'subject' => $id]) !!}" class="btn btn-xs btn-default">
												<i class="fa fa-ban fa-fw"></i>
												Desvincular aluno
											</a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">
						<i class="fa fa-users fa-fw"></i>
						Cadastrar usuários
					</h4>
				</div>
				{!! Form::open(['method' => 'POST', 'route' => ['admin.subject.time.student.store', $id], 'class' => 'form-horizontal']) !!}
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12" >
								<div style="margin:15px 15px;" class="form-group{{ $errors->has('student') ? ' has-error' : '' }}">
									{!! Form::label('student', 'Alunos:') !!}
									{!! Form::select('student', $options, null, ['class' => 'form-control', 'required' => 'required']) !!}
									<small class="text-danger">{{ $errors->first('student') }}</small>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<div class="btn-group pull-right">
							{!! Form::submit("Adiconar a materia", ['class' => 'btn btn-primary']) !!}
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
						</div>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
@endsection
@section('css')
	<link rel="stylesheet" href="{{ url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection

@section('js')
	<!-- DataTables -->
	<script src="{{ url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ url('assets/AdminLTE/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
	<script>
		$("#example1").DataTable({
			 "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.12/i18n/Portuguese-Brasil.json"
            }
		});
	</script>
@endsection
