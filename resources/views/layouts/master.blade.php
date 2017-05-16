<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

    <title class="title">
	     @yield('title', "Institute of Coaching Paper and Poster Submissions")
    </title>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link href="/css/ioc.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  </head>


<body id="app-layout">

  <div class="container">
    <header class="logo">
    <img src="/ioc_logo.jpg" alt="IOC logo" >
  </header>

    <nav class="navbar navbar-default">

          <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav">
                    <!-- Authentication Links -->

                    @if (Auth::guest())
                    <div id="navHighlight">
                        <li><a id="home" class="active" href="{{ url('/') }}">Home</a></li>
                        <li><a id="guide" href='/guidelines'>Guidelines</a></li>
                        <li><a id="login" href="{{ url('/login') }}">Login</a></li>
                        <li><a id="reg" href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li><a id="r_home" href="{{ url('/') }}">Home</a></li>
                        <li><a id="r_guide" href='/guidelines'>Guidelines</a></li>
                        <li><a id="r_add" href='/research/add'>Submit Entry</a></li>
                        <li><a id="r_show" href='/research/show'>Show/Edit Entry</a></li>
                        <li><a id="r_delete" href='/research/delete'>Delete Entry</a></li>
                        <li><a id="logout" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->first }} <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                          </li>
                       </div>
                    @endif
                </ul>
            </div>
    </nav>
<div class='flash_message'> </div>
<section>
        @yield('content')
</section>

<br>


<footer class="footer">
	<p>© 2017 Copyright Institute of Coaching at McLean Hospital | 115 Mill Street, Belmont, MA 02478 | Phone: (800) 381-4955 Fax: (617) 580-3965</p>
</footer>
<br>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="/js/app.js"></script>
<script src="/js/ioc.js"></script>

	@yield('body')

</body>
</html>
