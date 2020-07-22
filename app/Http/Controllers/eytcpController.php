<?php

namespace App\Http\Controllers;
use Log;
use Illuminate\Http\Request;
use App\Model\tbtStatusChallenge;
use App\Model\TbtTeacherDtls;
use App\Model\tcpUsersLogin;
use App\Model\ElsiTeacherDtl;
use App\Model\CollegeDetails;
use App\Model\ElsiDepartments;
use App\Model\ElsiDesignations;

use Illuminate\Support\Str;
use Hash;
use Mail;
use Input;
use App\Mail\CredentialMail;
use Validator;

class eytcpController extends Controller
{
    public function eytcp_home()
    {
        return view('eytcp_home');
    }
    public function landingpage()
    {
        return view('landing');
    }


    public function categorywisedata(Request $request)
	{				
		$category=$request->get('cat');
		switch($category) 
		{
			case "1": //tbt challenge is complete with merit and clg has set up elsi lab
			

			$faculty = tbtStatusChallenge::select('e.id','t.id','e.college_name','t.name','t.emailid','t.tcp_login_sent')
					->where('challenge_result','Merit')
					->where('e.lab_inaugurated','=',1)					
					->join('tbt_teachers_dtls as t', 't.team_id','=', 'tbt_status_challenge.team_id')
					->join('tbt_college_dtls as c','c.id', '=', 't.tbt_clg_id')
					->join('elsi_master.elsi_college_dtls as e','e.id', '=', 'c.elsi_clg_id')
					->get(); 

			// case "2"://eyrdc Active teachers
			// case "3"://eyic Active mentors			
			//log::info($faculty);
		}
		return json_encode($faculty); 
	}

	public function sendmailcred(Request $request){	
	log::info('****************************');	
		$faculty=TbtTeacherDtls::where('id','=',$request->get('id'))->where('tcp_login_sent','=',0)->first();
		//$elsi_clg_id=TbtCollegeDtls::where('id','=',$faculty->get('id'))->first();
		log::info($faculty);
		try{
			$user=new tcpUsersLogin;
			$user->clg_id=$faculty->tbt_clg_id;  //tbt clg id
			//$user->teacher_id=$faculty->id;      // tbt tch id added into tcp db
			$user->username=$faculty->emailid;
			$password=str::random(10);
			$user->password=Hash::make($password);
			$array=['username'=>$faculty->emailid,'password'=>$password];
			Mail::to($faculty->emailid)			
	       ->send(new CredentialMail($array));
	  	    $faculty->tcp_login_sent=1;
		  	    if(!$faculty->save()){
		  	    	throw new Exception('Cannot Able to Save Faculty, DB Error');
		  	    }
		  	    //$user->admin=3;
		  	    $user->active=1;
		  	    if(!$user->save()){
		  	    	throw new Exception('DB Error, Check Duplicate Entry in User Login');
		  	    }
	  	}
		catch(Exception $e){
			Log::info('Not Able to Save to DB');
			Log::info($e);
			return back()->withError(['messages'=>'Mail Not Send Check Duplicate Entry in User Login']);
		}
	return json_encode(['Success','The mail has been sent Successfully']); 
  	}

	public function TCPRegistration(Request $request)
	{
		$designation = ElsiDesignations::select('id', 'name')->orderBy('name')->get();			
		$department = ElsiDepartments::select('id', 'name')->orderBy('name')->get();
		$college = CollegeDetails::select('clg_code','college_name')->orderBy('college_name')->get();
		log::info(auth()->user()->username);
		$getteacher_dtl=ElsiTeacherDtl::select('ecd.*', 'elsi_teachers_dtls.*')
			->where('emailid', auth()->user()->username)
			->join('elsi_college_dtls as ecd', 'ecd.id', '=', 'elsi_teachers_dtls.clg_id')
			->first();	
			return view('eytcp_registration', ['designation' => $designation,'department' => $department,'college' => $college,'teacher' => $getteacher_dtl]);
	}	

	public function editProfile(Request $request)
	{
		log::info('umaa');
		$id = $request->input('id'); //Get Teachers ID
		$teacherdetails = ElsiTeacherDtl::where(['id' => $id])->get();
		log::info($teacherdetails);
		return response()->json($teacherdetails);
	}//end of editprofile
  	
  	public function ProfileUpdate(Request $request)
  	{
		$input = $request->all();
		log::info($input);
		$input['autoOpenModal'] = true;

		$rules = [
					'inputcontact' => 'required|numeric|digits_between:10,12',
					'inputcontact.digits' => 'Phone number should be of 10 to 12 digits.',
					'inputemail' => 'required',
					'inputcollege' => 'required',
					'inputdepartment' => 'required',
					'inputdesignation' => 'required',
					//'inputgender' => 'required'
					];
		$messages = [  	
						'email.required' => 'Email is required',
						'inputcontact.digits' => 'Phone number should be of 10 to 12 digits',
						'inputcontact.required' => 'Phone number is required',
						'inputcollege.required' => 'College is required',
						'inputdepartment.required' => 'Department is required',
						'inputdesignation.required' => 'Designation is required',
						//'inputgender.required' => 'Gender is required',
					];

		$validate=Validator::make($request->all(),$rules,$messages);

		if($validate->fails())
		{
			return redirect()->route('tcp_Registration')->withErrors($validate)->withInput($input);
		}
		else
		{		
			
			log::info('----------profile update----------');
			log::info($request->all());
			
			$elsi_teacher = ElsiTeacherDtl::where('emailid', $request->inputemail)->first();
			if($elsi_teacher!='')
			{
				$elsi_teacher->emailid=$request->get('inputemail');
				$elsi_teacher->contact_num = $request->get('inputcontact');
				$elsi_teacher->department = $request->get('inputdepartment');
				$elsi_teacher->designation = $request->get('inputdesignation');
				//$elsi_teacher->gender = $request->get('inputgender');
				$elsi_teacher->save();
				return redirect()->route('tcp_Registration')->with('success','Details has been updated successfully!');					
			}
		}
	}
}
