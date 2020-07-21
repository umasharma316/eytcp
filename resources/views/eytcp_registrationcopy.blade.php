@extends('layouts.layout')
<html>
  <head>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
    <link href='css/style.css' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">    
    <title>Profile</title>        
    <style>
        .tabs .indicator{
            background-color: #0d47a1;
        }
        body{
            align-items: center;
            
        }
      </style>
  </head>  
@section('content')      
   	<div class="row container padtop80">
            <div class="col m12">
                <div class="row">
                     <div class="col s12"> <p class="blue-text text-darken-4">Register</p></div>
                </div>
            </div>
    		<div id="test2" class="col m12 padtop40">
            	<div class="col m12 z-depth-1 padtop10">
                <div class="input-field col m12 ">
                  <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                  <label for="first_name">Email ID* </label>
                </div>
                <div class="input-field col s12 ">
                  <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                  <label for="first_name"> Name* </label>
                </div>          
                <div class="input-field col s12 ">
                  <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                  <label for="first_name">Mobile* </label>
                </div>      
                <div class="input-field col s12 ">
                  <input placeholder="Placeholder" id="password1" type="password" class="validate">
                  <label for="password1">Password*</label>
                </div>
                <div class="input-field col s12 ">
                  <input placeholder="Placeholder" id="password1" type="password" class="validate">
                  <label for="password1">Confirm Password*</label>
                </div>
                <p>
                  <input type="checkbox" id="test6" />
                    <label for="test6">I agree to the <a href-="#" class="blue-text text-darken-4">'EULA'</a> and <a href-="#" class="blue-text text-darken-4">'Privacy Policy'</a>.</label>
                </p>
                <p>
                    <a href="#" class="blue darken-4 btn">Register</a>                    
                </p>
            </div>               
            </div>    
  	</div>      

        
       
@endsection

@section('javascript')
    
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
@stop
