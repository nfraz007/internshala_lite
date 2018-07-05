@include("header")

<div class="container">
	<div class="row">
		<h4>Account - {{ $user["user_type"] ? "Employer" : "Student" }}</h4>
	</div>
	<div class="row pdtb30">
		<form action="{{ $action }}" method="POST">
	        <div class="input-field col s12 m6 l6">
	            <input id="first_name" type="text" name="first_name" value="@isset($user['first_name']) {{ $user['first_name'] }} @endisset" class="@if($errors->has('first_name')) invalid @endif">
	            <label for="first_name">First Name</label>
	            <small class="red-text">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m6 l6">
	            <input id="last_name" type="text" name="last_name" value="@isset($user['last_name']) {{ $user['last_name'] }} @endisset" class="@if($errors->has('last_name')) invalid @endif">
	            <label for="last_name">Last Name</label>
	            <small class="red-text">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m6 l6">
	            <input id="email" type="text" name="email" value="@isset($user['email']) {{ $user['email'] }} @endisset" class="@if($errors->has('email')) invalid @endif">
	            <label for="email">Email</label>
	            <small class="red-text">@if($errors->has('email')) {{ $errors->first('email') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m6 l6">
	            <input id="website" type="text" name="website" value="@isset($user['website']) {{ $user['website'] }} @endisset" class="@if($errors->has('website')) invalid @endif">
	            <label for="website">Website</label>
	            <small class="red-text">@if($errors->has('website')) {{ $errors->first('website') }} @endif</small>
	        </div>
	        <div class="col s12 m12 l12 center-align">
	        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        	<input class="waves-effect waves-light btn blue-grey darken-4 white-text" type="submit" name="submit" value="Save">
	        </div>
	    </form>
	</div>
</div>

@include("footer")