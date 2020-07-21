
<html>

<head>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
  <style>
    body {
      display: flex;
      min-height: 100vh;
      flex-direction: column;
    }

    main {
      flex: 1 0 auto;
    }

   body {
  font-family: 'Lato', sans-serif;
  background: linear-gradient(to top, #ef150b5e, #0a0a0a) fixed;
}

    .input-field input[type=date]:focus + label,
    .input-field input[type=text]:focus + label,
    .input-field input[type=email]:focus + label,
    .input-field input[type=password]:focus + label {
      color: #e91e63;
    }

    .input-field input[type=date]:focus,
    .input-field input[type=text]:focus,
    .input-field input[type=email]:focus,
    .input-field input[type=password]:focus {
      border-bottom: 2px solid #e91e63;
      box-shadow: none;
    }
  </style>
</head>

<body>
  <div class="container-center"></div>
  <main>
    <center>
      <div class="section">
        
      </div>

      <h5 class="indigo-text">Please, login into your account</h5>
      <div class="section">
        @if(Session::has('success'))
        <br/><div class="alert alert-success" style="margin-bottom:0px; font-color:white;"><strong>{{ Session::get('success') }}</strong></div>
        @elseif (!empty($success))
        <br/><div class="alert alert-success" style="margin-bottom:0px;">{{ $success }}</div>
        @endif

        @if ($errors->any())
        <br/><div class="alert alert-danger text-center" style="margin-bottom:0px;">  
          @foreach ($errors->all() as $error)
          {{ $error }}<br/>
          @endforeach
        </div>
        @endif
      </div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form class="col s12" method="post" action="loginProcess">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' placeholder="Enter Email Id" />
               <!--  <label for='email'>Enter your email</label> -->
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' placeholder="Enter Password" />
                <!-- <label for='password'>Enter your password</label> -->
              </div>
              <label style='float: right;'>
                  <a href="{{ route('authForgotLand') }}" class='pink-text'><b>Forgot Password?</b></a>
              </label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect' style="background-color: #f44336">Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>
<script type="text/javascript">
  
</script>