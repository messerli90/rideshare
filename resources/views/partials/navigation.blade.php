<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
              data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('/') }}">Ride Share</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li {{ Request::is('/') ? ' class="active"' : '' }}><a href="{{ url('/rides') }}">Rides</a></li>
        <li {{ Request::is('/rides/create') ? ' class="active"' : '' }}><a href="{{ url('/rides/create') }}">Create Ride</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(!Auth::check())
            <li>
                <a href="{{ url('/auth/facebook') }}"><i class="fa fa-fw fa-facebook-official"></i> Sign in with Facebook</a>
            </li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a></li>
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-fw fa-sign-out"></i> Log out</a></li>
                </ul>
            </li>
        @endif
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>