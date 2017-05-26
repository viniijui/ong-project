<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{isset($title) ? $title : false}} | ONG</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="{{elixir('assets/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{elixir('assets/AdminLTE/dist/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{elixir('assets/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
	<link rel="stylesheet" href="{{elixir('assets/AdminLTE/plugins/font-awesome/css/font-awesome.min.css') }}">
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,300italic' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	@yield('css')
</head>
<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">