<nav>
        <div class="nav-wrapper navbar-fixed">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
        <i class="material-icons" style="color: red;">menu</i></a>
          <a href="{!! route('landingpage') !!}" class="brand-logo"><img alt="Brand" src="img/eYantra_logo.svg" width="190" height="70" align="left"></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="#" style="color: white;">About Program</a></li>  
              @if(Auth::user())
              <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown1" style="color: white;"> {{ Auth::user()->username }}
                <i  class="material-icons right large">arrow_drop_down</i>
                </a>
                <ul id="dropdown1" class="dropdown-content" style="width: 100px">   
                <li><a href="{!! route('tcp_Registration') !!}" style="color: white; background-color:#ee6e73">Profile</a></li>               
                    <li><a href="{{ route('logout') }}" id="logout" style="color: white; background-color:#ee6e73"> Logout</a></li>
                </ul>
              </li>
              @else               
                <li><a href="{!! route('login') !!}" style="color: white;">Login</a></li>
              @endif
            
          </ul>
        </div>
</nav>
<ul class="sidenav" id="mobile-demo">
      </ul>