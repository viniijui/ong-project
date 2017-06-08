<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<i class="fa fa-user-circle" style="font-size:40px;color:#ffffff"></i>
				{{-- <img src="{{url('http://lorempixel.com/50/50/people/1/')}}" class="img-circle" alt="User Image"> --}}
			</div>
			<div class="pull-left info">
				<p>{!! \Auth::user()->name !!}</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			@if (Auth::user()->hasRole('root') or Auth::user()->hasRole('admin'))
				<li>
					<a href="{{route('admin.employee.list')}}">
						<i class="fa fa-user-circle fa-fw"></i> <span>Funcionários</span>
					</a>
				</li>
			@endif
			@if (Auth::user()->hasRole('root') or Auth::user()->hasRole('employee') or Auth::user()->hasRole('admin'))
				<li>
					<a href="{{route('admin.teacher.list')}}">
						<i class="fa fa-user-circle-o fa-fw"></i> <span>Professores</span>
					</a>
				</li>
				<li>
					<a href="{{route('admin.student.list')}}">
						<i class="fa fa-user fa-fw"></i> <span>Alunos</span>
					</a>
				</li>
				<li>
					<a href="{{route('admin.subject.list')}}">
						<i class="fa fa-file-text-o fa-fw"></i> <span>Materias</span>
					</a>
				</li>
				<li>
					<a href="{{route('admin.subject.time.create')}}">
						<i class="fa fa-graduation-cap fa-fw"></i> <span>Turmas</span>
					</a>
				</li>

			@endif
			<li class="treeview">
				<a href="#">
				<i class="fa fa-archive"></i>
				<span>Patrimonios</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right"></i>
				</span>
				</a>
				<ul class="treeview-menu">
					@if (Auth::user()->hasRole('root') or Auth::user()->hasRole('admin'))
						<li>
							<a href="{{route('admin.patrimony.list')}}">
								<i class="fa fa-archive fa-fw"></i> <span>Cadastro de patrimonios</span>
							</a>
						</li>
					@endif
					@if (Auth::user()->hasRole('root') or Auth::user()->hasRole('teacher') or Auth::user()->hasRole('admin'))
						<li>
							<a href="{{route('admin.reserve.create')}}">
								<i class="fa fa-check-square-o fa-fw"></i> <span>Reserva de patrimonios</span>
							</a>
						</li>
					@endif
				</ul>
			</li>
			@role('teacher')
				<li>
					<a href="{{route('admin.subject.list')}}">
						<i class="fa fa-star fa-fw"></i> <span>Minhas Turmas</span>
					</a>
				</li>
			@endrole


			@if (Auth::user()->hasRole('root') or Auth::user()->hasRole('employee') or Auth::user()->hasRole('admin'))
				<li>
					<a href="{{route('admin.event.list')}}">
						<i class="fa fa-calendar fa-fw"></i> <span>Eventos</span>
					</a>
				</li>
			@endif

			@role('teacher')
				<li>
					<a href="{{route('admin.test.list')}}">
						<i class="fa fa-file-text fa-fw"></i> <span>Provas</span>
					</a>
				</li>
			@endrole
			@role('root')
				<li>
					<a href="{{route('admin.user.list')}}">
						<i class="fa fa-users fa-fw"></i> <span>Usuários</span>
					</a>
				</li>
			@endrole
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
