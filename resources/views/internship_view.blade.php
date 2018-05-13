@include("header")

<div class="container pdtb20">
	<h5>{{ $internship_title }}</h5>
	<div class="divider"></div>
</div>
<div class="container">
	<h4 class="teal-text">{{ $internship["internship_name"] }}</h4>
	<h4 class="grey-text">{{ $internship["company_name"] }}</h4>
	<p><span class="grey-text">Location(s): </span>{{ $internship["city"]["city_name"] }}</p>
	<div class="row center-align">
		<div class="col s6 m3 l3 card blue-grey darken-4 white-text">
			<p class="text-grey">Start Date</p>
			<p>{{ $internship["start_date"] }}</p>
		</div>
		<div class="col s6 m3 l3 card blue-grey darken-4 white-text">
			<p class="text-grey">Duration</p>
			<p>{{ $internship["duration"] }} Month(s)</p>
		</div>
		<div class="col s6 m3 l3 card blue-grey darken-4 white-text">
			<p class="text-grey">Stipend</p>
			<p>{{ $internship["stipend"] }}</p>
		</div>
		<div class="col s6 m3 l3 card blue-grey darken-4 white-text">
			<p class="text-grey">Posted On</p>
			<p>{{ $internship["created_at"] }}</p>
		</div>
	</div>
	<div class="row">
		<b>About {{ $internship["company_name"] }} @if($internship["website"]) (<a href="{{ $internship['website'] }}" target="_blank">{{ $internship["website"] }}</a>) @endif :</b>
		<p>{{ $internship["company_detail"]}}</p>
	</div>
	<div class="row">
		<b>About the Internship : </b>
		<p>{{ $internship["internship_detail"]}}</p>
	</div>
	<div class="row">
		<b>Skills required : </b>
		@foreach($internship["skills"] as $skill)
		<div class="chip blue-grey darken-4 white-text">{{ $skill }}</div>
		@endforeach
	</div>
</div>
@include("footer")