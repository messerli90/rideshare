<nav class="navbar navbar-inverse navbar-fixed-top">
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
        <li {{ Request::is('/') ? ' class="active"' : '' }}><a href="{{ url('/') }}">Home</a></li>
        <li {{ Request::is('/rides/') ? ' class="active"' : '' }}><a href="{{ url('/rides') }}">Rides</a></li>
        <li {{ Request::is('/rides/create') ? ' class="active"' : '' }}><a href="{{ url('/rides/create') }}">Create Ride</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(!Auth::check())
            <li><a href="{{ url('/register') }}">Register</a></li>
            <li><a href="{{ url('/login') }}">Login</a></li>
        @else
            <li><a href="{{ url('/dashboard') }}">{{ Auth::user()->name }}</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
        @endif
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>