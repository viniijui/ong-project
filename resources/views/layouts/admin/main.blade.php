@include('layouts.admin.head')
@include('layouts.admin.header')
@include('layouts.admin.sidebar')
<!-- Content Header (Page header) -->
<div class="content-wrapper">
	<section class="content-header">
	<!-- <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol> -->
	</section>

	<section class="content">
		@yield('content')
	</section>
</div>	
  <div class="control-sidebar-bg"></div>
@include('layouts.admin.footer')
@include('layouts.admin.foot')
