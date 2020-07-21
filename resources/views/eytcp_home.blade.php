@extends('layouts.layout')
<head>
    
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
   </head>
@section('content')
<div class="container">
	<h5>e-Yantra Teacher Training Program (eYTCP)</h5>	
	<br>
	<div>
		<label>Select Category</label>
	    <select id="category" name="category">
	        <option value="" disabled selected>Choose your option</option>
	    	<option value="1" name="TBT Challenge holders">TBT Challenge holders</option>
	    	<option value="2" name="eYIC Mentors">eYIC Mentors</option>
	    	<option value="3" name="Other dropdown item">Other dropdown item</option>
	    	<option value="4" name="Exceptions from eYantra">Exceptions from eYantra</option>
	    </select>    
  	</div>
<br>
	<div class="table-container pagination" id="faculty_mail_table">
		<table class="responsive-table" width="100%"> </table>
	</div>
<div>
	<span class="left" id="total_reg"></span>
       <ul class="pagination" id="myPager"></ul>
</div>


</div>
@endsection

@section('javascript')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems, options);
  });

  // Or with jQuery

  $(document).ready(function(){
    $('select').formSelect();



    $('#faculty_mail_table').pageMe({
    pagerSelector:'#myPager',
    activeColor: 'blue',
    prevText:'Anterior',
    nextText:'Siguiente',
    showPrevNext:true,
    hidePageNumbers:false,
    perPage:10
  });

  });



$('#category').change(get_categorywisedata);
  
  function get_categorywisedata(){
    $.ajax({
        type  : 'POST',
        url     : '/categorywisedata',
        data  : { 
              "cat"    :   $('#category').val(),
              '_token'    : '{!! csrf_token() !!}'
            },
        dataType: 'json',
        success: function(data){
          $('#faculty_mail_table').empty();
          $('#faculty_mail_table').append('<thead>\
            <tr><th>College Name</th><th>Teacher Name</th><th>Email</th><th>Induct into TCP</th></tr>\
            </thead>');
          console.log(data);
          var trHTML = '';
          for(var i = 0; i < data.length; i++){
              trHTML += '<tr>';
              trHTML += '<td>' + data[i].college_name + '</td>';
              trHTML += '<td>' + data[i].name + '</td>';
              trHTML += '<td>'+ data[i].emailid + '</td>';
            if(data[i].tcp_login_sent==1){
              trHTML += '<td>\
                         <i class="material-icons small">check</i>\
                        </td>';
              trHTML += '</tr>';
            }  
            else{
              trHTML += '<td id= "set_'+data[i].id+'"><button type="button" class="btn btn-primary" aria-label="Left Align" onclick="sendMailCred('+ data[i].id +')">\
                        <i class="fa fa-envelope" aria-hidden="true"></i>\
                        Send Mail</button></td>';
              trHTML += '</tr>';
            }
          }    
          $('#faculty_mail_table').append(trHTML);       
    },                   
    error: function(XMLHttpRequest, textStatus, errorThrown) { 
       $('#faculty').hide();    
        alert('Faculty Details Not Found');    
    }
  });
};

function sendMailCred(id){
  $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type  : 'POST',
                url     : '{!! route("sendmailcred") !!}',
                data  : { 
                      "id"    :   id,
                      '_token'    : '{!! csrf_token() !!}'
                    },
                dataType: 'json',
                success: function(){  
                //location.reload();
                
                $('#set_'+id).html('<i class="material-icons small">check</i>');
               // $('#set_'+id).innerHTML='<i class="fa fa-check" aria-hidden="true"></i>';
                  },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }       
              });
}


</script>
@stop
