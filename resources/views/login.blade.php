@include("header")

<div class="conatainer">
	<div class="row pdtb100">
		<div class="col s0 m1 l3"></div>
		<div class="col s12 m10 l6 card">
			<ul class="tabs">
		        <li class="tab col s12 m12 l12"><a href="#student" class="active">Login</a></li>
		    </ul>
		    <div id="student" class="col s12 m12 l8 offset-l2 pdtb30">
		    	<form action="{{ $action }}" method="POST">
			    	<div class="input-field">
			          <input type="text" name="email" value="test@gmail.com" class="@if($errors->has('email')) invalid @endif" required>
			          <label>Email</label>
			          <small class="red-text">@if($errors->has('email')) {{ $errors->first('email') }} @endif</small>
			        </div>
			        <div class="input-field">
			          <input type="password" name="password" value="123456" required>
			          <label>Password</label>
			          <small class="red-text">@if($errors->has('password')) {{ $errors->first('password') }} @endif</small>
			        </div>
			        <div>
				        <a href="{{ URL('forgot_password') }}" class="right">Forgot Password</a>
			        </div>
			        <input type="hidden" name="user_type" value="0">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <input class="waves-effect waves-light btn" name="submit" type="submit" value="Login">
			        <p class="@isset($status) {{ $status }} @endisset">@isset($message) {{ $message }} @endisset</p>
			    </form>
		        <div>
		        	<p>New to Internshala? Register (<a href="{{ URL('register/student') }}">Student</a> / <a href="{{ URL('register/company') }}">Company</a>)</p>
		        </div>
		    </div>
		</div>
		<div class="col s0 m1 l3"></div>
	</div>
</div>

@include("footer")