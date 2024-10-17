
@extends('layout.mainlayout')
@section('content')

			<div class="slider-container">
				<div class="slider">
					<div class="slide" style="background-image: url({{asset('assets/img/banner/01.png')}});">
						<div class="slide-content">
							<h2>Transform Your Relationships with Professional Counseling</h2>
							<a href="/booking" class="action-button">Schedule Appointment</a>
						</div>
					</div>
					<div class="slide" style="background-image: url({{asset('assets/img/banner/02.png')}});">
						<div class="slide-content">
							<h2>Love is the Way, Healing is the Journey</h2>
							<a href="/booking" class="action-button">Schedule Appointment</a>
						</div>
					</div>
					<div class="slide" style="background-image: url({{asset('assets/img/banner/03.png')}});">
						<div class="slide-content">
							<h2>Join Us and Let Love Guide Your Way</h2>
							<a href="/booking" class="action-button">Schedule Appointment</a>
						</div>
					</div>
				</div>
				<div class="slider-navigation">
					<div class="prev">&#10094;</div>
					<div class="next">&#10095;</div>
				</div>
			</div>

			<!-- Call to Action -->
			<section class="section section-call-to-action fade-in">
				<div class="container">
					<div class="call-width">
						<h2>“ At The Way we love, we offer personalized coaching and counseling services designed to meet the unique
                            needs of each client. Our areas of expertise include ”</h2>
					</div>
				</div>
			</section>
			<!-- /Call to Action -->




           

			<!-- We Always -->
			<section class="section section-we-always fade-in">
				<div class="row mb-2">
					<div class="col-sm-5 col-lg-6 p-0 sec-hide we-al-img"></div>
					<div class="col-sm-12 col-lg-6 we-always-info">
						<h2>The Way We Love Relationship Counseling</h2>
						<p>{{$aboutUsText}}</p>
						{{-- <p align="justify">Elizabeth Hall is a dedicated mental health professional with a Master of Arts in Clinical Mental
                            Health Counseling and a Bachelor's Degree in Psychology. She is a Certified Transpersonal
                            Hypnotherapist (CTH) and holds the National Certified Counselor (NCC) credential from the
                            National Board for Certified Counselors (NBCC).</p>

                        <p>Specializing in couples and family therapy, Elizabeth’s educational background equips her to
                            provide systemic and relational therapeutic services for individuals, couples, and families. She
                            integrates her training as a transpersonal hypnotherapist for clients dealing with stress-related
                            issues, utilizing tools like guided imagery to promote deep relaxation and mental well-being... <a href="#">learn more</a></p> --}}
                            {{-- <p>The Way We Love Relationship Counseling is born out of a desire to serve and mend relationships. We strive to help individuals, couples, and families attain mental health through a lifestyle of self-care, identifying value systems that make them happy in their relationships</p> --}}
						{{-- <div class="row">
							<div class="col-sm-6 col-md-3 col-lg-6 we-info">
								<h4>400+</h4>
								<hr>
								<h5>Solved Cases</h5>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-6 we-info">
								<h4>1400+</h4>
								<hr>
								<h5>Councellors</h5>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-6 we-info">
								<h4>5400+</h4>
								<hr>
								<h5>Register Users</h5>
							</div>
							<div class="col-sm-6 col-md-3 col-lg-6 we-info">
								<h4>100%</h4>
								<hr>
								<h5>Happy Clients</h5>
							</div>
						</div> --}}
					</div>
				</div>
			</section>


	
			<!-- Services -->
<section class="section section-blog fade-in">
    <div class="container">
        <div class="section-header text-center">
            <h3>What we do</h3>
            {{-- <h2>Services</h2> --}}
        </div>

        <div class="row">
            @foreach($services as $service)
            <div class="col-md-4"><div class="card">
				<div class="card-body">
					<h2 class="card-title blog-heading"><a href="{{ route('services.details', $service->id) }}"> {{ $service->service_title }}</a></h2>
					<p class="blog-para">{!! Str::limit(strip_tags($service->service_description), 100) !!}</p><br>
					{{-- Optional buttons if needed --}}
					<a href="{{ route('login')}}" class="btn btn-success">Book Appointment</a>
                        <a href="{{ route('services.details', $service->id) }}" class="btn btn-primary" style="float: right">Learn more</a>
				</div>
			</div>
			

                
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Services -->
			
            <!-- /Breadcrumb -->
 {{-- <section class="section section-blog">
				<div class="breadcrumb-bar mt-5">
					<div class="container-fluid">
						<div class="row align-items-center">
							<div class="col-md-12 col-12">
								<h2 class="breadcrumb-title text-center">Our Programs</h2>
							</div>
						</div>
					</div>
				</div>
                <div class="container">
                    <div class="row">
                        @if(count($programs)>0)
                        @foreach ($programs as $program)
                        <div class="col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 20px;">

                            <!-- Blog Post -->
                            <div class="blog grid-blog">
                                <div class="blog-image">
                                    <a href="blog-details"><img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" alt="Post Image"></a>
                                </div>
                                <div class="blog-content">
                                    <ul class="entry-meta meta-item">

                                        <li><i class="far fa-clock"></i> {{ $program->created_at->format('d M Y')}}</li>
                                    </ul>
                                    <h3 class="blog-title"><a href="blog-details">{{ $program->program_title }}</a></h3>
                                    <p class="mb-0">{!! Str::limit(strip_tags($program->program_description), 100) !!}</p>
                                    <div class="row mt-3 ml-2">
                                        <a class="btn btn-primary btn-sm"
                                        href="{{ route('client.book')}}">Book Now</a> || <a class="btn btn-success btn-sm"
                                            href="{{ route('programs.details', $program->id) }}">Learn more</a>
                                    </div>
                                    {{-- <br><a href="{{ route('blogs.details', $blog->id) }}">Learn more</a></p> --
                                </div>
                            </div>
                            <!-- /Blog Post -->

                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </section> --}}


{{-- 
<section class="why-choose-us-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Why You Should Choose Us</h2>
        <p class="text-center mb-5">At The Way We Love, we are dedicated to helping you:</p>
        
        <div class="row">
            <div class="col-md-4">
                <div class="choose-us-item">
                    <h5>Foster Secure Connections</h5>
                    <p>Our counseling and coaching approach helps you build deeper emotional bonds and strengthen relationships.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="choose-us-item">
                    <h5>Maintain Balance</h5>
                    <p>We support you in creating and sustaining balance in your mental, emotional, and relational life.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="choose-us-item">
                    <h5>Tailored Care</h5>
                    <p>Every service we offer is customized to meet the unique needs of individuals, couples, families, and organizations.</p>
                </div>
            </div>
        </div>
    </div>
</section> --}}

{{-- <!-- Hero/Banner Section -->
<!-- Services Section -->
<section class="services-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Our Services</h2>
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->name }}</h5>
                            <p class="card-text">{{ Str::limit($service->description, 100) }}</p>
                            <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}

<!-- Blog Section -->
{{-- <section class="blog-section py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5">Latest Blogs</h2>
        <div class="row">
            @foreach($blogs as $blog)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                            <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-info">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section> --}}

<!-- Testimonials Section --
<section class="testimonials-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">What Our Clients Say</h2>
        <div class="row">
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p class="mb-0">"The counseling sessions have truly helped us restore balance in our relationship."</p>
                    <footer class="blockquote-footer">John & Jane Doe</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p class="mb-0">"An amazing service that changed my perspective on relationships!"</p>
                    <footer class="blockquote-footer">Sarah Lee</footer>
                </blockquote>
            </div>
            <div class="col-md-4">
                <blockquote class="blockquote">
                    <p class="mb-0">"I feel much more connected with my partner, thanks to the expert guidance."</p>
                    <footer class="blockquote-footer">Mike & Emma Smith</footer>
                </blockquote>
            </div>
        </div>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="cta-section py-5 bg-secondary text-white text-center mb-5">
    <div class="container">
        <h2>Ready to Begin Your Journey?</h2>
        <p>Sign up today and let us help you create stronger, healthier relationships.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg">Join Now</a>
    </div>
</section>

@endsection

			
