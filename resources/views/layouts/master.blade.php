<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('font/css/font-awesome.min.css')}}">
	<script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/ch-ui.admin.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/layer/layer.js')}}"></script>
</head>
<body>
	@yield('content')
</body>
</html>