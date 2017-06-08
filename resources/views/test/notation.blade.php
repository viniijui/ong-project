@extends('layouts.admin.main')
@section('content')
	@include('layouts.admin.partials.alerts')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{ $title }}</h3>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						<table class="table table-bordered table-hover" id="example1">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Notas</th>
								</tr>
							</thead>
							<tbody>

								@foreach ($data as $row)
									<tr>
										<td>{!! $row->name !!}</td>
										<td>
											@if (checkAndGetNotationByTestAndStudent($test, $row->id) !== false)
												<p class="{!!'p-notation'.$row->id!!}">
													{!! checkAndGetNotationByTestAndStudent($test, $row->id) !!}
													<a href="javascript:void(0)" class="btn btn-xs btn-default a-notation" style="margin-left:10px" form="{!!'update'.$row->id!!}" pclass="{!!'p-notation'.$row->id!!}">Editar</a>
												</p>
												{!! Form::open(['method' => 'POST', 'route' => ['admin.test.notation.update', 'student' => $row->id, 'test' => $test, 'subject' => $subject], 'class' => 'form-inline hidden update'.$row->id.'']) !!}

												<div class="form-group{{ $errors->has('nota') ? ' has-error' : '' }}">
													{!! Form::label('nota', 'Nota:') !!}
													{!! Form::number('nota', checkAndGetNotationByTestAndStudent($test, $row->id), ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'max' => getTestByID($test)->weight]) !!}
													<small class="text-danger">{{ $errors->first('nota') }}</small>
												</div>

												{!! Form::submit("Editar", ['class' => 'btn btn-default']) !!}
												{!! Form::close() !!}
											@else
												{!! Form::open(['method' => 'POST', 'route' => ['admin.test.notation.store', 'student' => $row->id, 'test' => $test, 'subject' => $subject], 'class' => 'form-inline']) !!}

												<div class="form-group{{ $errors->has('nota') ? ' has-error' : '' }}">
													{!! Form::label('nota', 'Nota:') !!}
													{!! Form::number('nota', null, ['class' => 'form-control', 'required' => 'required', 'min' => 0, 'max' => getTestByID($test)->weight]) !!}
													<small class="text-danger">{{ $errors->first('nota') }}</small>
												</div>

												{!! Form::submit("Cadastrar", ['class' => 'btn btn-default']) !!}
												{!! Form::close() !!}
											@endif
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

		$('.a-notation').click(function(event) {
			var pclass = '.'+$(this).attr('pclass');
			var aux = '.'+$(this).attr('form');
			$(pclass).addClass('hidden');
			$(aux).removeClass('hidden');
		});
	</script>
@endsection
