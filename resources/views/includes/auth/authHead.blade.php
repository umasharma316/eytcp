	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="e-Yantra">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<title>
		@section('title')
		e-Yantra MOOC
		@show
	</title>

	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<!-- Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
	
	<!-- IE8 support for HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>    <![endif]-->

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<style>
		body {
			/*background-color: #6699FF;*/
			background-image: url(img/b1.png);
			font-family: Lato, Helvetica, Arial, sans-serif;
			color: #434a54;
		}

		p {
			font-size: 18px;
			line-height: 24px;
			margin: 0 0 23px 0;
		}

		.suggestive {
			font-weight: bold;
			font-size: 28px !important;
			color: #000000;
			text-shadow: 2px 8px 6px rgba(0, 0, 0, 0.1), 0px -5px 35px rgba(255, 255, 255, 0.3);
			margin: 30px 10px 20px 10px;
			text-align: center;

		}

		form {
			margin: 50px auto;
		}

		img {
			display: block;
			width: 82px;
			margin-left: auto !important;
			margin-right: auto !important;
			
		}

		.input-group,
		.form-group {
			margin: 20px 10px 20px 10px;
		}

		.btn-block {
			width: 50%;
			margin-left: auto;
			margin-right: auto;
		}

		hr {
			border: 0;
			height: 1px;
			background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
			background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
			background-image: -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
			background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
		}

		a.input-group:hover {
			text-decoration: underline;
		}

		@media(min-width:768px) {
			.portal-form {
				margin-top: 30px;
			}
		}

		@media(min-width:992px) {
			.portal-form {
				margin-top: 60px;
			}
		}

		@media(min-width:1200px) {
			.portal-form {
				margin-top: 120px;
			}
		}

		.logo_image{
			opacity: 1.0;
			filter: alpha(opacity=100);
		}
		blockquote {
			border: 0px;
			color: rgba(0, 0, 0, 0.7);
			text-shadow: 2px 8px 6px rgba(0, 0, 0, 0.2), 0px -5px 35px rgba(255, 255, 255, 0.3);
			font-style: normal;
			margin-left: 32px;
			font-family: "Segoe Print", "Times New Roman", Verdana, cursive;
			padding-left: 68px;
			background: url("{{ asset('img/blockquote.png') }}");
			background-repeat: no-repeat;
			min-height: 30px;
		}
	</style>
	{{-- Script to send X-CSRF-TOKEN --}}