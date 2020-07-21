@extends('layouts.auth.auth_layout')

@section('content')

<form method="POST" action="{{ route('authSetPwdProcess') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<p class="suggestive">Reset Password</p>
	<div class="input-group input-group-lg">
		<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
		<input type="password" name="newPassword" value="{{ old('newPassword') }}" class="form-control" required="" placeholder="New Password" aria-describedby="sizing-addon1">
	</div>
	<div class="input-group input-group-lg">
		<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
		<input type="password" name="repeatPassword" value="{{ old('repeatPassword') }}" class="form-control" required="" placeholder="Confirm Password" aria-describedby="sizing-addon1">
	</div>
	<p class="suggestive">* Your password should be at least 8 characters long</p>
	<br/>
	<div class="row">
		<div class="col-md-6 text-left" style="padding-left:25px;">
			<a href="{{ route('loginLand') }}" class="btn btn-lg btn-primary">Login Page</a>
		</div>
		<div class="col-md-6 text-right" style="padding-right:30px;">
			<button class="btn btn-lg btn-primary" type="submit" name="submit">Save Password</button>
		</div>
	</div>
</form>
@endsection

@section('scripts')
<script>
	$(document).ready(function () {
		$('body').backstretch([
			"{!! asset('img/backgrounds/hgj_3224.jpg') !!}", 
			"{!! asset('img/backgrounds/img_0019.jpg') !!}",
			"{!! asset('img/backgrounds/img_1086.jpg') !!}"
			], {
				duration: 3000,
				fade: 750
		});
	});
</script>
@endsection