<header class="main-header">
	<!-- Logo -->
	<a href="{{route('admin.main')}}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>ONG</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg">ONG</span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs">{!! \Auth::user()->name !!}</span>
						<i class="fa fa-angle-down fa-fw"></i>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{route('admin.user.edit', \Auth::user()->id)}}">
								<i class="fa fa-users fa-fw"></i> <span>Editar</span>
							</a>
						</li>
						<li>
							<a href="{{ url('/logout') }}"
								onclick="event.preventDefault();
										 document.getElementById('logout-form').submit();">
								<i class="fa fa-sign-out"></i>
								Sair
							</a>

							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>

					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
