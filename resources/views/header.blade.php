<!DOCTYPE html>
<html>
<head>
	<title>Internshala Lite | {{ $page_title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
  	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">   
  	<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">  
</head>
<body>

<nav class="blue-grey darken-4">
  <div class="nav-wrapper">
    <a href="{{ URL('home') }}" class="brand-logo">Internshala</a>
    <ul class="right hide-on-med-and-down">
      @if($is_login)
      <li>
        <div class="switch">
          <label>
            Student
            <input type="checkbox" @isset($switch) {{ $switch }} @endisset id="switch">
            <span class="lever"></span>
            Company
          </label>
        </div>
      </li>
      @endif
      <li class="tab-internship"><a href="{{ URL('internship') }}">Internship</a></li>
      @if($is_login)
      	@if($is_login == "1")
      		<li class="tab-dashboard-student"><a href="{{ URL('dashboard/student') }}">Dashboard</a></li>
      	@else
      		<li class="tab-dashboard-company"><a href="{{ URL('dashboard/company') }}">Dashboard</a></li>
          <li class="tab-hire"><a href="{{ URL('hire') }}">Hire Intern</a></li>
      	@endif
      	<li class="tab-account"><a class="dropdown-button" href="#" data-beloworigin="true" data-activates="dropdown-logout" data-constrainwidth="false">Hello {{ $username }}<i class="material-icons right">arrow_drop_down</i></a></li>
      @else
      	<li class="tab-login"><a href="{{ URL('login') }}">Login</a></li>
      	<li class="tab-register"><a class="dropdown-button" href="#" data-beloworigin="true" data-activates="dropdown-register" data-constrainwidth="false">Register<i class="material-icons right">arrow_drop_down</i></a></li>
      @endif
    </ul>
  </div>
</nav>
<ul id="dropdown-register" class="dropdown-content">
  <li><a href="{{ URL('register/student') }}">New Student - Register</a></li>
  <li><a href="{{ URL('register/company') }}">New Company - Hire Intern</a></li>
</ul>
<ul id="dropdown-logout" class="dropdown-content">
  <li><a href="{{ URL('account') }}">My Account</a></li>
  <li><a href="{{ URL('logout') }}">Logout</a></li>
</ul>