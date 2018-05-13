@include("header")

<div class="container">
	<div class="row">
		<h4>Post Intership - Hire Interns</h4>
	</div>
	<div class="row pdtb30">
		<form action="{{ $action }}" method="POST">
			<div class="input-field col s12 m3 l3">
			    <select name="category_id" class="@if($errors->has('category_id')) invalid @endif">
			      <option value="" disabled selected>Choose your option</option>
			      @foreach($categories as $category)
			      <option value="{{ $category['category_id'] }}" @if($category["category_id"]==$category_id) selected @endif>{{ $category["category_name"] }}</option>
			      @endforeach
			    </select>
			    <label>Category</label>
			    <small class="red-text">@if($errors->has('category_id')) {{ $errors->first('category_id') }} @endif</small>
		  	</div>
		  	<div class="input-field col s12 m3 l3">
			    <select name="city_id" class="@if($errors->has('city_id')) invalid @endif">
			      <option value="" disabled selected>Choose your option</option>
			      @foreach($cities as $city)
			      <option value="{{ $city['city_id'] }}" @if($city["city_id"]==$city_id) selected @endif>{{ $city["city_name"] }}</option>
			      @endforeach
			    </select>
			    <label>City</label>
			    <small class="red-text">@if($errors->has('city_id')) {{ $errors->first('city_id') }} @endif</small>
		  	</div>
		  	<div class="input-field col s12 m3 l3">
			    <select name="duration" class="@if($errors->has('duration')) invalid @endif">
			      <option value="" disabled selected>Choose your option</option>
			      @for($i=1; $i<=15; $i++)
			      <option value="{{ $i }}" @if($duration == $i) selected @endif>{{ $i }} Month(s)</option>
			      @endfor
			    </select>
			    <label>Duration</label>
			    <small class="red-text">@if($errors->has('duration')) {{ $errors->first('duration') }} @endif</small>
		  	</div>
		  	<div class="input-field col s12 m3 l3">
		  		<input type="text" class="datepicker @if($errors->has('start_date')) invalid @endif" name="start_date" value="@isset($start_date) {{ $start_date }} @endisset" required>
		  		<label>Start Date</label>
		  		<small class="red-text">@if($errors->has('start_date')) {{ $errors->first('start_date') }} @endif</small>
		  	</div>
		  	<div class="input-field col s12 m12 l12">
	            <input id="skills" type="text" name="skills" value="@isset($skills) {{ $skills }} @endisset" class="@if($errors->has('skills')) invalid @endif">
	            <label for="skills">Skills</label>
	            <small class="red-text">@if($errors->has('skills')) {{ $errors->first('skills') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m12 l12">
	            <input id="intership_name" type="text" name="internship_name" value="@isset($internship_name) {{ $internship_name }} @endisset" class="@if($errors->has('internship_name')) invalid @endif">
	            <label for="intership_name">Intership Name</label>
	            <small class="red-text">@if($errors->has('internship_name')) {{ $errors->first('internship_name') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m12 l12">
	            <textarea id="intership_detail" class="materialize-textarea @if($errors->has('internship_detail')) invalid @endif" name="internship_detail">@isset($internship_detail) {{ $internship_detail }} @endisset</textarea>
	            <label for="intership_detail">Intership Detail</label>
	            <small class="red-text">@if($errors->has('internship_detail')) {{ $errors->first('internship_detail') }} @endif</small>
	        </div>
	        <div class="input-field col s12 m12 l12">
	            <input id="stipend" type="text" name="stipend" value="@isset($stipend) {{ $stipend }} @endisset" class="@if($errors->has('stipend')) invalid @endif">
	            <label for="stipend">Stipend</label>
	            <small class="red-text">@if($errors->has('stipend')) {{ $errors->first('stipend') }} @endif</small>
	        </div>
	        <div class="col s12 m12 l12 center-align">
	        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        	<input class="waves-effect waves-light btn blue-grey darken-4 white-text" type="submit" name="submit" value="Save">
	        </div>
	    </form>
	</div>
</div>

@include("footer")

<script>
$("document").ready(function(){
	$('select').material_select();
	$(".tab-hire").addClass("active");
	$('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year,
	    today: 'Today',
	    clear: 'Clear',
	    close: 'Ok',
	    closeOnSelect: false // Close upon selecting a date,
	  });
})
</script>