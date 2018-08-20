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
            <!-- <li>
                <div class="switch">
                    <label>
                        Student
                        <input type="checkbox" @isset($switch) {{ $switch }} @endisset id="switch">
                        <span class="lever"></span>
                        Company
                    </label>
                </div>
            </li> -->
            @endif
            <li class="tab-internship"><a href="{{ URL('internship') }}">Internship</a></li>
            @if($is_login)
            	@if($is_login == "1")

            	@else
                    <li class="tab-hire"><a href="{{ URL('hire') }}">Hire Intern</a></li>
            	@endif
            	<li class="tab-account"><a class="dropdown-button" href="#" data-beloworigin="true" data-activates="dropdown-logout" data-constrainwidth="false">Hello {{ $username }}<i class="material-icons right">arrow_drop_down</i></a></li>
            @else
            	<li class="tab-login"><a href="{{ URL('login') }}">Login</a></li>
            	<li class="tab-register"><a class="dropdown-button" href="#" data-beloworigin="true" data-activates="dropdown-register" data-constrainwidth="false">Register<i class="material-icons right">arrow_drop_down</i></a></li>
            @endif
        </ul>
        <ul id="dropdown-register" class="dropdown-content">
            <li><a href="{{ URL('register/student') }}">New Student - Register</a></li>
            <li><a href="{{ URL('register/company') }}">New Company - Hire Intern</a></li>
        </ul>
        <ul id="dropdown-logout" class="dropdown-content">
            <li><a href="{{ URL('account') }}">My Account</a></li>
            <li><a href="{{ URL('logout') }}">Logout</a></li>
        </ul>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="{{ URL::asset('images/mobile-nav-bg.jpg') }}">
                    </div>
                    <a href="#!user"><img class="circle" src="{{ URL::asset('images/myphoto.jpg') }}"></a>
                    <a href="#!name"><span class="white-text name">John Doe</span></a>
                    <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
                </div>
            </li>
            <li><a href="{{ URL('internship') }}" class="waves-effect waves-light">Internship</a></li>
            @if($is_login)
                @if($is_login == "1")

                @else
                    <li><a href="{{ URL('hire') }}" class="waves-effect waves-light">Hire Intern</a></li>
                @endif
                <li><div class="divider"></div></li>
                <li><a href="{{ URL('account') }}" class="waves-effect waves-light">My Account</a></li>
                <li><a href="{{ URL('logout') }}" class="waves-effect waves-light">Logout</a></li>
            @else
                <li><div class="divider"></div></li>
                <li><a href="{{ URL('login') }}" class="waves-effect waves-light">Login</a></li>
                <li><a class="subheader">Register</a></li>
                <li><a href="{{ URL('register/student') }}" class="waves-effect waves-light">New Student - Register</a></li>
                <li><a href="{{ URL('register/company') }}" class="waves-effect waves-light">New Company - Hire Intern</a></li>
            @endif
        </ul>
    </div>
</nav>
<div class="fixed-action-btn hide-on-large-only">
    <a href="#" data-activates="slide-out" class="button-collapse btn-floating btn-large waves-effect waves-light"><i class="fa fa-bars"></i></a>
</div>