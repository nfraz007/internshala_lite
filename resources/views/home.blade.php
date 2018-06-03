@include("header")

<div class="carousel carousel-slider">
    <a class="carousel-item" href="#one!"><img src="{{ URL::asset('images/banner-1.png') }}"></a>
    <a class="carousel-item" href="#two!"><img src="{{ URL::asset('images/banner-2.jpg') }}"></a>
    <a class="carousel-item" href="#three!"><img src="{{ URL::asset('images/banner-3.jpg') }}"></a>
    <a class="carousel-item" href="#four!"><img src="{{ URL::asset('images/banner-4.jpg') }}"></a>
</div>

<div class="container center-align pd20 home-popular-city">
	<h4>Internship in popular cities</h4>
	<div class="row">
		@foreach($popular_cities as $popular_city)
		<div class="col s6 m2 l2">
			<a href="{{ URL('internship?filter_category=&filter_city='.$popular_city['city_id'].'&filter_search=&filter=Filter')}}">
				<div class="card-panel blue-grey darken-4">
		          <span class="white-text">{{ $popular_city["city_name"] }}</span>
		        </div>
		    </a>
		</div>
		@endforeach
	</div>
</div>

<div class="container center-align pd20 home-popular-city">
	<h4>Internship in popular catagories</h4>
	<div class="row">
		@foreach($popular_categories as $popular_category)
		<div class="col s6 m2 l2">
			<a href="{{ URL('internship?filter_category='.$popular_category['category_id'].'&filter_city=&filter_search=&filter=Filter')}}">
				<div class="card-panel blue-grey darken-4">
		          <span class="white-text">{{ $popular_category["category_name"] }}</span>
		        </div>
		    </a>
		</div>
		@endforeach
	</div>
</div>

@include("footer")

<script>
$('.carousel.carousel-slider').carousel({fullWidth: true, indicators: true});
setInterval(function() {
    $('.carousel.carousel-slider').carousel("next");
  }, 3500);
</script>