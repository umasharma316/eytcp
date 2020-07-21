<?php

namespace App\Http\Controllers;
use Log;
use Illuminate\Http\Request;
use App\Model\tbtStatusChallenge;
use App\Model\TbtTeacherDtls;
use App\Model\tcpUsersLogin;
use App\Model\ElsiTeacherDtl;
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
		return view('eytcp_registration');
	}	

	public function editProfile(Request $request)
	{
		log::info('umaa');
		$id = $request->input('id'); //Get Teachers ID
		$teacherdetails = ElsiTeacherDtl::where(['id' => $id])->get();
		return response()->json($teacherdetails);
	}//end of editprofile
  	
  	public function ProfileUpdate(Request $request)
  	{
		$input = $request->all();
		log::info($input);
		$input['autoOpenModal'] = true;

		$messages = ['inputcontact.required' => 'The Contact Number of Person is required.',
						'inputcontact.digits' => 'The Number of Contact Person should be of 10 digits.',
						
					];
			
		$validator = Validator::make($request->all(), 
			[	'inputcontact' => 'required|digits:10',
				
				'inputgender' => 'required'
			],$messages);

			try
			{
				if ($validator->fails())
				{
				return redirect()->back()->withErrors($validator->errors())->withInput($input);
				}
				else
				{
					log::info('----------profile update----------');
					log::info($request->all());
					
					$elsi_teacher = ElsiTeacherDtl::where('emailid', $teacher->emailid)->first();
					if($elsi_teacher!='')
					{
						$elsi_teacher->emailid=$input['inputemail'];
						$elsi_teacher->contact_num = $input['inputcontact'];
						$elsi_teacher->department = $input['inputdepartment'];
						$elsi_teacher->designation = $input['inputdesignation'];
						$elsi_teacher->gender = $input['inputgender'];
						$elsi_teacher->save();					
					}					
				}	
			}
			catch(Exception $e)	
			{
				log::info($e);
			}
	}
}
