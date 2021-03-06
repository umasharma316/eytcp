@extends('layouts.tcp_layout')
<!-- <head>
      <meta name = "viewport" content = "width = device-width, initial-scale = 1">      
      <link rel = "stylesheet"
         href = "https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel = "stylesheet"
         href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
      <script type = "text/javascript"
         src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>           
      <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
      </script> 
      <link rel = "stylesheet"
         href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel = "stylesheet"
         href = "http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
   </head> -->
@section('content')
  <center>
    <div class="row " style="margin-top: 40px;">
      <div class="card horizontal z-depth-2">
        <div class="col m12">
          @if(Session::has('success'))
            <h5 class='alert alert-success' align="center">{{Session::get('success')}}</h5>
        @endif
          <div class="card-content">
          <h4>Your Profile Information</h4>
            <br>
         
            @if($errors->any())
            <div class="alert alert-danger" role='alert'>
            @foreach($errors->all() as $error)
            <p class="text-danger">{!!$error!!}</p>
            @endforeach
            </div>
            <hr/>
            @endif


          <table width="500px" style="border: 1px; border-collapse: collapse;
            border-radius: 10px !important;">
              
              <tr>
                <td>Name:</td>
                <td>
                  <label id="name">{!! $teacher->name !!}</label>
                </td>
              </tr>
              <tr>
                <td>Email Id:</td>
                <td>
                  <label id="emailid">{!! $teacher->emailid!!}</label>
                </td>
              </tr>
              <tr>
                <td>Contact Number:</td>
                <td>
                  <label id="contact_num">{!! $teacher->contact_num!!}</label>
                </td>
              </tr>
              <tr>
                <td>College Name:</td>
                <td>
                  <label id="colg_id">{!! $teacher->college_name !!}, {!! $teacher->district !!}, {!! $teacher->state !!}</label>
                </td>
              </tr>
              <tr>
                <td>Department:</td>
                <td>
                  <label id="department">{!! $teacher->department!!}</label>
                </td>
              </tr>
              <tr>
                <td>Designation:</td>
                <td>
                  <label id="designation">{!! $teacher->designation!!}</label>
                </td>
              </tr>
              <!-- <tr>
                <td>Gender:</td>
                <td>
                  <label id="gender">{!! $teacher->gender!!}</label>
                </td>
              </tr> -->  
          </table>
        <br>
          <div class='col s12 col offset 4'>
            <a class="waves-effect waves-light btn pink darken-1 modal-trigger" href="#modal" onclick="editDetails({!! $teacher->id !!})">Edit Profile</a>

            
          </div>
  
          </div>
        </div>
      </div>
  </div>
</center>
@stop
<!-- Modal-->
<div id="modal" class="modal modal-fixed-footer">
  <div class="modal-content">
    <h4>Please update your details</h4>
     <form class="form-horizontal" role="form" method="POST" action="{!! route('ProfileUpdate') !!}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" id="member_id" name="member_id" value="{!! Request::old('member_id') !!}">
        <div class="col m4" align="left">
          <label for="inputname">Name</label>
          <div class="col m4">
            <input type="text" id="inputname" name="inputname" value="{!! Request::old('inputname') !!}" readonly>
          </div>
        </div>
        <div class="col m4" align="left">
          <label for="inputemail">email</label>
          <div>
            <input type="email" id="inputemail" name="inputemail" value="{!! Request::old('inputemail') !!}" readonly>
          </div>
        </div>
        <div class="col m4" align="left">
          <label for="inputcontact">Contact</label>
          <div>
              <div>
                <input type="text" id="inputcontact" name="inputcontact" value="{!! Request::old('inputcontact') !!}">
            </div>
          </div>
        </div>
        <div class="col m4" align="left">
          <label>College</label>
          <select class="form-control" id="inputcollege" name="inputcollege" value="{{Request::old('inputcollege')}}">
              <option hidden></option>
               @foreach ($college as $college)
            @if (old('inputcollege')==$college->id)
                <option value={{$college->id}} selected>{{ $college->college_name }}</option>
            @else
                <option value={{$college->id}} >{{ $college->college_name }}</option>
            @endif
          @endforeach
          </select> 


          
          </div>
        <div class="col m4" align="left">
          <label>Select Department</label>
          <select class="form-control" id="inputdepartment" name="inputdepartment" value="{{Request::old('inputdepartment')}}">
              <option hidden></option>
                @foreach($department as $department)
                  <option value="{{$department->id}}" {{Request::old('inputdepartment') == $department->id ? 'selected' : ''  }}>{{$department->name}}</option>
                @endforeach
          </select> 
          </div>
        <div class="col m4" align="left">
          <label>Select Designation</label>
          <select class="form-control" id="inputdesignation" name="inputdesignation" 
           value="{{Request::old('inputdesignation')}}">
              <option hidden></option>
                @foreach($designation as $designation)
                  <option value="{{$designation->id}}" {{Request::old('inputdesignation') == $designation->id ? 'selected' : ''  }}>{{$designation->name}}</option>
                @endforeach
          </select> 
        </div>
        <!-- <div class="col m4" align="left">
          <label for="inputgender" class="col-sm-2 control-label">Gender</label>
          <div>

          <label>
            <input class="with-gap" name="inputgender" id="male_radio" type="radio"  value="{!! Request::old('inputgender') !!}" checked="true"/>
            <span>Male</span>
          </label>
           <label>
            <input class="with-gap" name="inputgender" id="female_radio" type="radio"  value="{!! Request::old('inputgender') !!}" checked="true"/>
            <span>Female</span>
          </label>
          </div>
        </div>  -->       
    
  </div>
  <div class="modal-footer">
    <button type="submit" class="modal-action modal-close btn teal lighten-1">Update</button>
    <a href="" class="modal-action modal-close btn deep-orange darken-2">Cancel</a>
  </div>
</div>
</form>

@section('script')
<script type="text/javascript">
 $(document).ready(function(){
   $('.modal').modal();

    $('select').formSelect();
  });

 // //AJAX function to EditDetails
  function editDetails(id){
    $.ajax({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         type: "GET",
         dataType: "json",
         url: 'EditProfile',
         data: { id: id},               
               success: function(detail) {               
                    for(i in detail){
                      $("#member_id").val(detail[i].id);
                      $("#inputname").val(detail[i].name);
                      $("#inputemail").val(detail[i].emailid);
                      $("#inputcollege").val(detail[i].clg_id);
                      $("#inputcontact").val(detail[i].contact_num);
                      $("#inputdesignation").val(detail[i].designation);
                      $("#inputdepartment").val(detail[i].department);

                      // if((detail[i].gender) == 'Male'){
                      //   $("#male_radio").attr('checked', true);
                      // }
                      // if((detail[i].gender) == 'Female'){
                      //   $("#female_radio").attr('checked', true);;
                      // }
                    }

                      $('#modal').modal('open');
               },
               error: function(){              
               }
     });
  }//end of editDetails

</script>

@stop
<style type="text/css">
  body {
  background: #e2e1e0;
  text-align: center;
}

.card {
  background: #fff;
  border-radius: 2px;
  display: inline-block;
  height: 600px;
  margin: 1rem;
  position: relative;
  width: 1000px;
}

.card-1 {
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
  transition: all 0.3s cubic-bezier(.25,.8,.25,1);
}

.card-1:hover {
  box-shadow: 0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
}

</style>














