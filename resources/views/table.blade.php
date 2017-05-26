@extends('layouts.admin.main')
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-solid box-primary">
				<div class="box-header with-border">
					<i class="fa {{$icon}}"></i>
					<h3 class="box-title">{{ $title }}</h3>
					<div class="btn-group pull-right">
						@if (isset($create_aux))
							<a href="{{ route($controller.'.create', $create_aux) }}" class="btn btn-default btn-xs"><i class="fa fa-plus fa-fw"></i> Novo</a>
						@else
							<a href="{{ route($controller.'.create') }}" class="btn btn-default btn-xs"><i class="fa fa-plus fa-fw"></i> Novo</a>
						@endif
						@if (isset($back))
							<a href="{{ route($back) }}" class="btn btn-default btn-xs">
								<i class="fa fa-undo fa-fw"></i> Voltar
							</a>
						@endif
					</div>
				</div>
				<div class="box-body">
					<div class="col-lg-12">
						<table class="table table-bordered table-hover" id="example1">
							<thead>
								<tr>
									@foreach ($table_content as $row => $value)
										<th>{{$row}}</th>
									@endforeach
									<th>Administrar</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $row2)
									<tr>
										@foreach ($table_content as $row => $value)
											@if ($value == 'situation')
												<td>
													<div class="btn-group">
														@if ($row2->situation == true)
															<a href="{{route($controller.'.situation', ['slug' => $row2->slug, 'action' => 0])}}" class="btn btn-default btn-xs"><i class="fa fa-eye-slash fa-fw"></i></a>
															<a href="" class="btn btn-success btn-xs disabled"><i class="fa fa-eye fa-fw"></i></a>
														@else
															<a href="" class="btn btn-danger btn-xs disabled"><i class="fa fa-eye-slash fa-fw"></i></a>
															<a href="{{route($controller.'.situation', ['slug' => $row2->slug, 'action' => 1])}}" class="btn btn-default btn-xs "><i class="fa fa-eye fa-fw"></i></a>
														@endif
													</div>
												</td>
											@elseif($value == 'teacher_class')
												<td>
													<p>{!!getTeacherNameByID($row2->teacher_id)!!}</p>
												</td>
											@elseif($value == 'classes')
												<td>
													<a href="{!!route('admin.subject.time.list', $row2->slug)!!}" class="btn btn-xs btn-default">
														<i class="fa fa-fw fa-graduation-cap"></i> 
														Turmas  <span class="badge">{!!countClassesBySubjectID($row2->id)!!}</span>
													</a>
												</td>
											@elseif($value == 'half_class')
												<td>
													<p>{!!($row2->half == '1-semestre') ? '1º Semestre' : '2º Semestre' !!}</p>
												</td>
											@elseif($value == 'day_br')
												<td>
													<p>{{date('d/m/Y', strtotime($row2->day))}}</p>
												</td>
											@elseif($value == 'subject_name')
												<td>
													<p>{!!getSubjectNameByID(getSubjectIDBySubjectTimeID($row2->subject_time_id))!!}</p>
												</td>
											@else
												<td>
													{!!$row2->$value!!}
												</td>
											@endif
										@endforeach
										<td>
											<div class="btn-group">
												@if (!isset($no_edit))
													<a href="{!! route($controller.'.edit', $row2->slug) !!}" class="btn btn-primary btn-xs">
														<i class="fa fa-pencil"></i>
													</a>
												@endif
												@if (isset($create_aux))
													<a href="{!! route($controller.'.delete', ['slug' => $row2->key, 'feicap' => $create_aux]) !!}" class="btn btn-danger btn-xs">
														<i class="fa fa-trash"></i>
													</a>
												@else 
													<a href="{!! route($controller.'.delete', $row2->slug) !!}" class="btn btn-danger btn-xs">
														<i class="fa fa-trash"></i>
													</a>
												@endif
											</div>
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
	</script>
@endsection