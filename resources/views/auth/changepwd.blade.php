@extends('layouts.auth.auth_layout')

@section('content')

<form method="POST" action="{{ route('changePwdProcess') }}">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<p class="suggestive">Change Password</p>
	<div class="input-group input-group-lg">
		<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="password" name="oldPassword" value="{{ old('oldPassword') }}" class="form-control" required="" placeholder="Current Password" aria-describedby="sizing-addon1">
	</div>
	<div class="input-group input-group-lg">
		<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="password" name="newPassword" value="" class="form-control" required="" placeholder="New Password" aria-describedby="sizing-addon1">
	</div>
	<div class="input-group input-group-lg">
		<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
		<input type="password" name="repeatPassword" value="" class="form-control" required="" placeholder="Confirm Password" aria-describedby="sizing-addon1">
	</div>
	<p class="suggestive">* Your password should be at least 8 characters long</p>
	<br/>
	<div class="row">
		<div class="col-md-6 text-left" style="padding-left:25px;">
			<a href="{{ route('sendUserToHome') }}" class="btn btn-lg btn-primary">Go Back</a>
		</div>
		<div class="col-md-6 text-right" style="padding-right:30px;">
			<button class="btn btn-lg btn-primary" type="submit" name="submit">Change Password</button>
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