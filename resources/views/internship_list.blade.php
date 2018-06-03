@include("header")

<div class="container-fluid blue-grey">
	<div class="row pd30">
		<form action="{{ $href }}" method="GET">
			<div class="input-field col s12 m3 l3 white-text">
			    <select name="filter_category">
			      <option value="" selected>Choose your option</option>
			      @foreach($categories as $category)
			      <option value="{{ $category['category_id'] }}" @if($category["category_id"]==$filter_category) selected @endif>{{ $category["category_name"] }}</option>
			      @endforeach
			    </select>
			    <label>Category</label>
		  	</div>
		  	<div class="input-field col s12 m3 l3 white-text">
			    <select name="filter_city">
			      <option value="" selected>Choose your option</option>
			      @foreach($cities as $city)
			      <option value="{{ $city['city_id'] }}" @if($city["city_id"]==$filter_city) selected @endif>{{ $city["city_name"] }}</option>
			      @endforeach
			    </select>
			    <label>City</label>
		  	</div>
		  	<div class="input-field col s12 m3 l3 white-text">
	          <input id="filter_search" name="filter_search" type="text" value="{{ $filter_search }}">
	          <label for="filter_search">Search Key</label>
	        </div>
	        <div class="col s12 m3 l3 center-align">
	        	<input class="waves-effect waves-light btn white black-text" type="submit" name="filter" value="Filter">
	        </div>
	    </form>
	</div>
</div>
<div class="container">
	<div class="row">
		@if(count($internships))
			<p>Showing {{ $data_count }} result(s)</p>
			@foreach($internships as $internship)
			<div class="col s12 m12 l12 card">
				<div class="row">
					<div class="col s12 m6 l6">
						<h5 class="teal-text">{{ $internship["internship_name"] }}</h5>
						<h5>{{ $internship["company_name"] }}</h5>
						<p>Location(s): {{ $internship["city"]["city_name"] }}</p>
						<a class="waves-effect waves-light btn" href="{{ $internship['href_view'] }}">View Detail</a>
					</div>
					<div class="col s12 m6 l6">
						<p><span class="blue-grey-text text-darken-4">Start Date: </span>{{ $internship["start_date"] }}</p>
						<p><span class="blue-grey-text text-darken-4">Duration: </span>{{ $internship["duration"] }} Month(s)</p>
						<p><span class="blue-grey-text text-darken-4">Stipend: </span>{{ $internship["stipend"] }}</p>
						<p><span class="blue-grey-text text-darken-4">Posted On: </span>{{ $internship["created_at"] }}</p>
					</div>
				</div>
			</div>
			@endforeach
		@else
		<div class="center-align pdtb30">
			<h4>No Data Found</h4>
			<h1><i class="fa fa-frown-o"></i></h1>
		</div>
		@endif
	</div>
</div>

@include("footer")

<script>
$("document").ready(function(){
	$('select').material_select();
	$(".tab-internship").addClass("active");
})
</script>