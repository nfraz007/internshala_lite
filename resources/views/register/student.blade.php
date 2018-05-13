@include("header")

<div class="conatainer">
	<div class="row pdtb100">
		<div class="col s0 m1 l3"></div>
		<div class="col s12 m10 l6 card">
			<div id="student" class="col s12 m12 l8 offset-l2">
				<h5>Register - Student</h5>
		    	<form action="{{ $action }}" method="POST">
			    	<div class="input-field">
			          <input type="text" name="email" value="@isset($email) {{ $email }} @endisset" class="@if($errors->has('email')) invalid @endif" required>
			          <label>Email</label>
			          <small class="red-text">@if($errors->has('email')) {{ $errors->first('email') }} @endif</small>
			        </div>
			        <div class="input-field">
			          <input type="password" name="password" required>
			          <label>Password</label>
			          <small class="red-text">@if($errors->has('password')) {{ $errors->first('password') }} @endif</small>
			        </div>
			        <div class="input-field col s12 m6 l6">
			          <input type="text" name="first_name" value="@isset($first_name) {{ $first_name }} @endisset" class="@if($errors->has('first_name')) invalid @endif" required>
			          <label>First Name</label>
			          <small class="red-text">@if($errors->has('first_name')) {{ $errors->first('first_name') }} @endif</small>
			        </div>
			        <div class="input-field col s12 m6 l6">
			          <input type="text" name="last_name" value="@isset($last_name) {{ $last_name }} @endisset" class="@if($errors->has('last_name')) invalid @endif" required>
			          <label>Last Name</label>
			          <small class="red-text">@if($errors->has('last_name')) {{ $errors->first('last_name') }} @endif</small>
			        </div>
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <input class="waves-effect waves-light btn" name="submit" type="submit" value="Register">
			        <p class="@isset($status) {{ $status }} @endisset">@isset($message) {{ $message }} @endisset</p>
			    </form>
		        <div>
		        	<p>By registering, you agree to our Terms and Conditions.</p>
		        </div>
		    </div>
		</div>
		<div class="col s0 m1 l3"></div>
	</div>
</div>

@include("footer")