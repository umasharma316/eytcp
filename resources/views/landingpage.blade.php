@extends('layouts.tcp_layout')
@section('title', 'e-Yantra Teacher Training Program')
<html>
    <head>
        <style>
            .eY-home{
                background-image: url("{{ asset('onlineimg.jpg') }}");
                background-repeat: no-repeat;
                background-attachment: scroll;
                background-position: center; 
                background-size: cover;
                position:relative;
                top:0;
                left:0;
                width:100vw;
                height:75vh;
            }
        </style>
    </head>
    <body>
        @section('content')	
            <div class="content eY-home"></div>
        @stop        
    </body>
</html>

