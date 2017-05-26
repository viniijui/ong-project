<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{url('http://lorempixel.com/50/50/people/1/')}}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>Vinicius dos Santos</p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MENU</li>
			<li>
				<a href="{{route('admin.teacher.list')}}">
					</span>
					<i class="fa fa-user-circle-o fa-fw"></i> <span>Professores</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.student.list')}}">
					</span>
					<i class="fa fa-user fa-fw"></i> <span>Alunos</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.employee.list')}}">
					</span>
					<i class="fa fa-user-circle fa-fw"></i> <span>Funcionários</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.patrimony.list')}}">
					</span>
					<i class="fa fa-archive fa-fw"></i> <span>Patrimonios</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.event.list')}}">
					</span>
					<i class="fa fa-calendar fa-fw"></i> <span>Eventos</span>
				</a>
			</li>
			<li>
				<a href="{{route('admin.test.list')}}">
					</span>
					<i class="fa fa-file-text fa-fw"></i> <span>Provas</span>
				</a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-graduation-cap fa-fw"></i> <span>Aulas</span> 
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li>
						<a href="{{route('admin.subject.list')}}">
							<i class="fa fa-file-text-o"></i> <span>Materias</span>
						</a>
					</li>
					<li class="">
						<a href="{{route('admin.subject.time.create')}}">
							<i class="fa fa-calendar-o"></i> <span>Turmas</span>
						</a>
					</li>
				</ul>
			</li>

		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
