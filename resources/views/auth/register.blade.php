@extends('layouts.Registration.master')

@section('content')
<div class="row">
	<div class="col-md-12" style="padding-top: 40px;">
	<h3 class="text-center">
		Registration for e-Yantra Resource Development Center
	</h3>
  <h4 class="text-center">ONLY for eLSI College Teachers</h4>
	<hr/>
		<div class="panel panel-default">
			<div class="panel-heading">eYRDC Registeration</div>
			<div class="panel-body">
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Whoops!</strong> There were some problems with your input.<br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

        {!! Form::open(array('route' => 'register_submit', 'method' => 'POST', 'files' => true, 'id' => 'registerForm', 'name' => 'registerForm')) !!}
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<div class="col-md-11">
						{!! Form::label('states', 'Select State', ['class' => 'required']) !!}
            {!! Form::select('state', $states, [], ['class' => 'form-control', 'id' => 'states', 'required' => 'required'])!!}</br>
            </div>
					</div>
					<div class="form-group">
						<div class="col-md-11">
						{!! Form::label('elsi_colleges', 'Select College', ['class' => 'required']) !!}
            {!! Form::select('elsi_college', [],  Input::old('elsi_college'), ['class' => 'form-control', 'id' => 'elsi_college', 'required' => 'required'])!!}</br>
            </div>
					</div>
					<!-- <div class="form-group">
						<div class="col-md-11">
						<h5 class="text-primary"> If the college name does not appear in the above list, write the college name here-</h5>
						<label for="inputCollege">Add College</label>
               {!! Form::text('college_name','',['class' => 'form-control', 'id' => 'college_name'])!!}<br/>
            </div>
					</div> -->
					<div class="form-group">
						<div class="col-md-6">
              {!! Form::label('fname', 'First Name',['required' => 'required']) !!}
              {!! Form::text('fname','',['class' => 'form-control', 'id' => 'fname','required' => 'required'])!!}
              @if ($errors->has('fname'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('fname') }}</strong>
              </span>
              @endif
            </div>

            <div class="col-md-6">
              {!! Form::label('lname', 'Last Name',['required' => 'required']) !!}
              {!! Form::text('lname','',['class' => 'form-control', 'id' => 'lname','required' => 'required'])!!}<br/>
              @if ($errors->has('lname'))
                <span class="invalid-feedback">
                <strong>{{ $errors->first('lname') }}</strong>
                </span>
              @endif
            </div>
					</div>

					<div class="form-group">
						<div class="col-md-6">
            {!! Form::label('Type', 'Gender',['required' => 'required']) !!}<br/>
                <input type="radio" name="gender" value="Male" required> Male<br/>
                <input type="radio" name="gender" value="Female"> Female<br/>
                @if ($errors->has('gender'))
                <span class="invalid-feedback">
                  <strong>{{ $errors->first('gender') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-6">
              {!! Form::label('email', 'Email ID',['required' => 'required']) !!}
              {!! Form::text('email','',['class' => 'form-control', 'id' => 'email','required' => 'required'])!!}<br/>
              @if ($errors->has('email'))
              <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
					</div>

					<div class="form-group">
						<div class="col-md-6">
              {!! Form::label('designation', 'Designation',['required' => 'required']) !!}
              {!! Form::select('designation', $designation, [], ['class' => 'form-control', 'id' => 'designation', 'required' => 'required'])!!}</br>
              
            </div>
            <div class="col-md-6">
              {!! Form::label('contact', 'Contact Number',['required' => 'required']) !!}
              {!! Form::text('contact','',['class' => 'form-control', 'id' => 'contact','required' => 'required'])!!}<br/>
              
            </div>
					</div>

					<div class="form-group">
						<div class="col-md-6">
              {!! Form::label('department', 'Despartment',['required' => 'required']) !!}
              {!! Form::select('department', $department, [], ['class' => 'form-control', 'id' => 'department', 'required' => 'required'])!!}
                
            </div>
            <div class="col-md-6">
              {!! Form::label('photograph', 'Scanned Copy of ID Card',['required' => 'required']) !!}
                {!! Form::file('photograph') !!}
                
                <br/>
            </div>
					</div>
					<div class="form-group" style="padding-top: 40px;">
						<div class="col-md-11 text-center">
							{!! Form::submit('Register', ['class' => 'btn btn-info', 'id' => 'registerbtnwin', 'name' => 'registerbtnwin']) !!}
						</div>
            {!! Form::close() !!}
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
$.ajaxSetup({
  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
});

  if($('#states').val() != 0 ){
    getCollegeList();
  }
  $("#states").change(function(){
  
    getCollegeList();
    });
  function getCollegeList(){
    
    $('#elsi_college').find('option').remove();
    $('#elsi_college').append($('<option>').text('Select College').attr('value', 0));
    $.ajax({
      type  : 'POST',
      url     : '{!! route("conCollegeRegister") !!}',
      data  : {"state_id" : $('#states').val()},
      dataType: 'json',
    }).done(function (data) {
      if(!data.error){
        for(var i = 0; i < data.length; i++){
          $('#elsi_college').append($('<option>').text(data[i].college_name).attr('value', data[i].id));
        }
      }
    }).fail(function () {
     alert('Sorry, This email Id is not registered with us!');
    });
  }
</script>
@stop