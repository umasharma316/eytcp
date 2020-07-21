<html>
<head>
	@include('includes.auth.authHead')
	@section('style')
	@show
	<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
	{{--@include('includes.auth.authNavbar')--}}
	<!-- Container -->
	<section class="portal-form container-fluid">
		<div class="row">
			<div class="col-md-4 col-sm-3">
			</div>
			<div class="col-md-4 col-sm-6">
				<img src="{!! asset('img/EyantraLogoMini.png') !!}" alt="" class="logo_image">
				@if(Session::has('success'))
				<br/><div class="alert alert-success" style="margin-bottom:0px;"><strong>{{ Session::get('success') }}</strong></div>
				@elseif (!empty($success))
				<br/><div class="alert alert-success" style="margin-bottom:0px;">{{ $success }}</div>
				@endif

				@if ($errors->any())
				<br/><div class="alert alert-danger text-center" style="margin-bottom:0px;">	
					@foreach ($errors->all() as $error)
					{{ $error }}<br/>
					@endforeach
				</div>
				@endif
				@yield('content')
			</div>
			<div class="col-md-4 col-sm-3">
			</div>
		</div>
		<!-- <div class="row">
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<blockquote>Unified platform for all activities under eLSI</blockquote>
			</div>
			<div class="col-md-4">
			</div>
		</div> -->
	</section>
	{{-- <div class="container-fluid" style="padding-top: 80px;">
		<!-- Content -->
		@if(Session::has('success'))
		<div class="alert alert-success"><strong>{{ Session::get('success') }}</strong></div>
		@elseif (!empty($success))
		<div class="alert alert-success">{{ $success }}</div>
		@endif
		
		@if ($errors->any())
		<div class="alert alert-danger text-center">	
			@foreach ($errors->all() as $error)
			{{ $error }}<br/>
			@endforeach
		</div>
		@endif
		
		@yield('content')
	</div> --}}
	
	@include('includes.auth.authFooter')
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-65584389-1', 'auto');
		ga('send', 'pageview');

	</script>
</body>
</html>