<?php

namespace App\Http\Controllers;

use Request;
use Auth;
use Log;
use Session;
use App\Model\tcpUsersLogin;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ElsiDesignations;
use App\Model\ElsiTeacherDtl;
use Validator;
use Input;
use Config;
use DateTime;
use Mail;
use App\Mail\ResetPwd;
use Illuminate\Support\Str;

class EytcpAuthController extends Controller
{
    public function login(){
    	log::info('login');
		if(auth()->check() && auth()->user()->is_admin == 1)
		{
			log::info('send');
			//
		}
		elseif(auth()->check() && auth()->user()->is_admin == 0 && Auth::user()->i_agree_registration==0)
		{
			return self::sendUserToHome();
		// 	$designation = ElsiDesignations::select('id', 'name')->orderBy('name')->get();			
		// 	$department = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
		// 	$college = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
		// 	log::info('ddddddddd');
		// 	log::info(auth()->user()->username);
		// 	$getteacher_dtl=ElsiTeacherDtl::select('ecd.*', 'elsi_teachers_dtls.*')
		// 	->where('emailid', auth()->user()->username)
		// 	->join('elsi_college_dtls as ecd', 'elsi_teachers_dtls.clg_id', '=', 'ecd.id')
		// 	->get();	
		// log::info($getteacher_dtl);
		// 	return redirect()->route('TCPRegistration', $department,$designation,$college);

			//return view('eytcp_registration', ['designation' => $designation,'department' => $department,'college' => $college,'teacherdtl' => $getteacher_dtl]);
		}
		else
		{
			return view('auth.login');
		}
		//return self::sendUserToHome();		
	}

	public static function sendUserToHome()
	{
		log::info('1111111111111');
		if( auth()->user()->is_admin == 1)
		{
		}
		
		if(auth()->user()->is_admin == 0 && Auth::user()->i_agree_registration==0)
		{
			log::info('22222');
			$designation = ElsiDesignations::select('id', 'name')->orderBy('name')->get();			
			$department = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
			$college = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
			log::info('ddddddddd');
			log::info(auth()->user()->username);
			$getteacher_dtl=ElsiTeacherDtl::select('ecd.*', 'elsi_teachers_dtls.*')
			->where('emailid', auth()->user()->username)
			->join('elsi_college_dtls as ecd', 'ecd.id', '=', 'elsi_teachers_dtls.clg_id')
			->first();	
		log::info($getteacher_dtl);
			//return redirect()->route('TCPRegistration', $department,$designation,$college);
			return view('eytcp_registration', ['designation' => $designation,'department' => $department,'college' => $college,'teacher' => $getteacher_dtl]);
		}
		else
		{
			return redirect()->route('login');			
		}	
	}

	
	public function loginProcess(Request $request)
	{
		$input = $request::only('email','password');

		$validator = Validator::make($request::all(), [
			'email' => 'required',
			'password' => 'required',
			]);
		if ($validator->fails()){
			return redirect()->back()->withErrors($validator->errors())->withInput($input);
		}
		else{
			if (Auth::attempt(['username' => $input['email'], 'password' => $input['password']])){

				if(Auth::user()->active == 0){
					Auth::logout();
					Session::flush();
					return redirect()->route('login')->withErrors('Your account have been deactivated since you tried to reset your password through Forgot Password');
				}

				Auth::user()->increment('login_count');
				Auth::user()->last_login = new DateTime;
				Auth::user()->save();

				return self::sendUserToHome();
			}
			else{
				return redirect()->route('login')->withErrors('Incorrect username or password');
			}
		}
	}
	


	public function logout(){
		if(!Auth::check()){
			return redirect()->route('login');
		}
		else{
			Auth::logout();
			Session::flush();
			return redirect()->route('login');
		}
	}

	public function changePwdLand(){

		return view('auth.changepwd');
	}

	public function changePwdProcess(){

		$username = Auth::user()->username;

		/* Validation of data */
		$rules = [
		'oldPassword'		=>	'required',
		'newPassword'		=>	'required',
		'repeatPassword'	=>	'required'];

		$messages = [
		'oldPassword.required'		=>	'Current Password is compulsory.',
		'newPassword.required'		=>	'New Password is compulsory.',
		'repeatPassword.required'	=>	'Confirm Password is compulsory.'];

		$validator = Validator::make(Input::all(), $rules, $messages);
		if ($validator->fails()){
			return redirect()->route('changePwdLand')->withErrors($validator)->withInput(Input::all());
		}

		/* Check newPassword and repeatPassword are Equal. */
		$newpassword = Input::get('newPassword');
		$repeatpassword = Input::get('repeatPassword');
		if ($newpassword != $repeatpassword){
			$messages = ['New Password, Confirm Password doesn\'t match.'];
			return redirect()->route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		if(strlen($newpassword) < 8){
			$messages = ['New Password should be at least 8 characters long.'];
			return redirect()->route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		/* Check user exist in DB */
		$user = Login::where('username', $username)->first();
		if(!$user) {
			$messages = ['Unable to change password. Please contact us at support@e-yantra.org'];
			return redirect()->route('changePwdLand')->withErrors($messages);
		}

		/* Check currentpassword and storedpassword match. Use Hash */
		$oldpassword = Input::get('oldPassword');
		if(!(Hash::check($oldpassword, $user->password))) {
			$messages = ['Incorrect Current Password.'];
			return redirect()->route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}

		//$user->password = $newpassword;
		$user->password = Hash::make($newpassword);
		$user->change_count = $user->change_count + 1;

		if(!$user->save()){
			$messages = ['Unable to save the information. Please contact us at support@e-yantra.org via email about the issue'];
			return redirect()->route('changePwdLand')->withErrors($messages)->withInput(Input::all());
		}
		//Display Success
		$messages = ['success' => 'Password changed successfully.'];
		return self::sendUserToHome($messages);
	}

	public function forgetPasswordLand(){

		//Display the view
		return view('auth.forgetpwd');
	}
	

	/*
	|-------------------------------------------------------------------------
	| Function:		forgetPassword
	| Input:		Null
	| Output:		Forget Password
	| Logic:		Forget Password
	|
	*/
	public static function forgetPwdProcess(Request $request){

		//$thisMethod = self::$thisClass . ' -> forgetPwdProcess -> ';

		/* Validation of data */
		$rules = [
		'username'		=>	'required|email'
		];

		$messages = [
		'username.required'		=>	'Username is compulsory.',
		'username.email'		=>	'Email is not in proper format.',
		];

		$validator = Validator::make($request::all(), $rules, $messages);
		if ($validator->fails()) {
			return redirect()->route('authForgotLand')->withErrors($validator)->withInput(Request::all());
		}

		/* Validation of username/emailid */
		$username = Request::get('username');
		$user = tcpUsersLogin::where('username', $username)->first();
		if(!$user) {
			$messages = ['This email is not registered with us.'];
			return redirect()->route('authForgotLand')->withErrors($messages)->withInput(Request::all());
		}

		// Generate token and store in DB *::all/
		$token = '';
		if($user->token != '' && !empty($user->token) && $user->active == 0){
			$token = $user->token;
		}
		else{
			$token = str::random(10);
			$user->token = $token;
			$user->active = 0;

			if(!$user->save()){
				$messages = ['Unable to save the information. Please contact us at resources@e-yantra.org via email about the issue'];
				return redirect()->route('authForgotLand')->withErrors($messages)->withInput(Input::all());
			}
		}

	
		Mail::to($username)
						->cc('admin@e-yantra.org','e-Yantra IITB')
						->queue(new ResetPwd($username, $token));
		Log::info($token);
		//Display Success
		$mesgstr = "A mail containing further instructions has been sent to ".$username.". Please check it to reset your password.";
		$messages = $mesgstr;
		return redirect()->route('login')->with(['success' => $messages]);

	}

	/*
	|-------------------------------------------------------------------------
	| Function:		Validate username, token before allowing to set new password.
	| Input:		Null
	| Output:		Validate username, token before allowing to set new password.
	| Logic:		Validate username, token before allowing to set new password.
	|
	*/
	public static function validateToken($username, $token) {

		//$thisMethod = self::$thisClass . ' -> validateToken -> ';

		/* Validate username and token */

		$userrecord = tcpUsersLogin::where('username', $username)->first();
		if(!$userrecord || ($userrecord->token != $token)) {
			// Redirect to login page with error message.
			$messages = ['Unable to set new password. Please contact us at support@e-yantra.org via email about the issue'];
			return redirect()->route('loginLand')->withErrors($messages);
		}

		/* Emailid, Token verified. redirect user to set password page. */
		Session::put('forgotpwd_username', $username);
		return redirect()->route('authSetPwdLand');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		setPasswordLand
	| Input:		Null
	| Output:		Generate View to set new password incase of Forget Password
	| Logic:		Generate View to set new password incase of Forget Password
	|
	*/
	public static function setPasswordLand() {
		if(!Session::has('forgotpwd_username')){
			$messages = ['Unable to set new password. Please contact us at support@e-yantra.org via email about the issue'];
			return redirect()->route('loginLand')->withErrors($messages);
		}
		return view('auth.setpwd');
	}

	/*
	|-------------------------------------------------------------------------
	| Function:		setPassword
	| Input:		Null
	| Output:		set new password incase of Forget Password
	| Logic:		set new password incase of Forget Password
	|
	*/
	public static function setPassword(){

		if(!Session::has('forgotpwd_username')){
			$messages = ['Unable to set new password. Please contact us at support@e-yantra.org via email about the issue'];
			return redirect()->route('login')->withErrors($messages);
		}

		$username = Session::get('forgotpwd_username');

		/* Validation of input data */
		$rules = [
		'newPassword'		=>	'required',
		'repeatPassword'	=>	'required'];

		$messages = [
		'newPassword.required'		=>	'New Password is compulsory.',
		'repeatPassword.required'	=>	'Confirm Password is compulsory.'];

		$validator = Validator::make(Request::all(), $rules, $messages);
		if ($validator->fails()){
			return redirect()->route('authSetPwdLand')->withErrors($validator)->withInput(Request::all());
		}

		/* Check newPassword and repeatPassword are Equal. */
		$newpassword = Request::get('newPassword');
		$repeatpassword = Request::get('repeatPassword');
		if ($newpassword != $repeatpassword){
			$messages = ['Password, Confirm Password doesn\'t match.'];
			return redirect()->route('authSetPwdLand')->withErrors($messages)->withInput(Request::all());
		}

		if(strlen($newpassword) < 8){
			$messages = ['Password cannot be less than 8 characters.'];
			return redirect()->route('authSetPwdLand')->withErrors($messages)->withInput(Request::all());
		}
		/* Save new password in database */
		$userrecord = tcpUsersLogin::where('username', $username)->first();
		$userrecord->password = Hash::make($newpassword);
		$userrecord->token = Null;
		$userrecord->active = 1;
		$userrecord->forgot_count = $userrecord->forgot_count + 1;

		if(!$userrecord->save()){
			$messages = ['Unable to save the information. Please contact us at support@e-yantra.org via email about the issue'];
			return redirect()->route('login')->withErrors($messages)->withInput(Request::all());
		}

		//Display Success
		$messages = 'Password reset successfull. Please Login below.';
		return redirect()->route('login')->with(['success' => $messages]);
	}
}
