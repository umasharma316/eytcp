<!doctype html>
<html lang="en">
<body style="padding-top: 1px; font-weight: 500; font-family: sans-serif">
	<header class="row">
		@include('includes.header')
	</header>
	<div>
		<!-- <div class="col-m2">
			@include('includes.sidebar')
		</div> -->
			@if (Session::has('success'))
			<div>
				<h5>
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Success:</span>
					{!!Session::get('success')!!}<br>
				</h5>
			</div>
			@endif

			@if($errors->any())
			<div class="col-m10">
				@foreach($errors->all() as $error)
				<h5>
					<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
					<span class="sr-only">Error:</span>

					{!!$error!!}
				</h5>
				@endforeach
			</div>
			<hr/>
			@endif
			@yield('content')
			<style></style>
	</div>

	<footer>
		@include('includes.footer')
		<br><br>
	</footer>
</body>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>
<!-- Compiled and minified CSS -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
@yield('javascript')
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-65584389-1', 'auto');
	ga('send', 'pageview');

</script>
</html>