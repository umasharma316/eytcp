<nav>
        <div class="nav-wrapper navbar-fixed">
        <a href="#" data-target="mobile-demo" class="sidenav-trigger">
        <i class="material-icons" style="color: red;">menu</i></a>
          <a href="{!! route('landing_page') !!}" class="brand-logo"><img alt="Brand" src="img/eYantra_logo.svg" width="190" height="70"></a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><a href="/#index" style="color: black;">Courses</a></li>
              
              @if(Auth::user())
              <li>
                <a class="dropdown-trigger" href="#!" data-target="dropdown1" style="color: black;"> {{ Auth::user()->username }}
                <i  class="material-icons right large">arrow_drop_down</i>
                </a>
                <ul id="dropdown1" class="dropdown-content">
                   <!--  <li ><a href="{{ route('profile') }}">Profile</a></li>
                    <li><a href="{{ route('logout') }}" id="logout" style="color: black;"> Logout</a></li> -->
                </ul>
              </li>
              @else
                <li><a href="{!! route('login') !!}" style="color: black;">Login</a></li>
              @endif
            
          </ul>
        </div>
</nav>
<ul class="sidenav" id="mobile-demo">
             <!--  <li><a href="{!! route('landing_page') !!}" style="color: black;">Courses</a></li> -->
            
               <!-- @if(Auth::user())
              
              <li ><a href="{{ route('profile') }}">Profile</a></li>
              <li><a href="{{ route('logout') }}" id="logout" style="color: black;"> Logout</a></li>
              @else
                <li><a href="{!! route('loginLand') !!}" style="color: black;">Login</a></li>
              @endif -->
      </ul>