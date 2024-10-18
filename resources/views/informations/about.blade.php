@extends('layout.mainlayout')

@section('content')

    <!-- Call to Action -->
    <section class="py-5 mb-5"> <!-- Added mb-5 for margin-bottom -->
        <div class="container">
            <h1 class="display-4 font-weight-bold text-left mt-5">About Us</h1>
        </div>
    </section>
    
    <!-- /Call to Action -->

    <!-- About Section -->
    <section class="py-5 mb-5"> <!-- Added mb-5 for margin-bottom -->
        <div class="container">
            <div class="row">
                <!-- Image with Caption -->
                <div class="col-lg-5 mb-4">
                    <figure class="figure">
						<div class="position-relative overflow-hidden rounded shadow-lg">
                        <img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid rounded" alt="Elizabeth Hall">
						</div>
                        <figcaption class="figure-caption text-center">
                            <h3>Elizabeth Hall</h3>
                            <p>CEO/Founder</p>
                        </figcaption>
                    </figure>
                </div>
                <!-- About Text -->
				<div class="col-lg-6">
					<h2 class="mb-4">Who is Elizabeth Hall?</h2>
					<p class="text-muted mb-3">Specializing in couples and family therapy, Elizabeth’s educational background equips her to provide systemic and relational therapeutic services for individuals, couples, and families. She integrates her training as a transpersonal hypnotherapist for clients dealing with stress-related issues, utilizing tools like guided imagery to promote deep relaxation and mental well-being.
					</p>
					<p class="text-justify">
                        Elizabeth is also certified by the Virginia Board of Counseling as a Qualified Mental Health Professional for adults and children (QMHP-A/C) and is currently registered with the Board as a Resident in Counseling and Marriage & Family Therapy. At the core of Elizabeth’s work is a commitment to mental health and well-being, and she believes that a person-centered approach is essential in any therapeutic relationship.
                    </p>
					<a href="{{ url('/about') }}" class="btn btn-primary px-4 py-2">Learn More</a>
				</div>
                
            </div>
        </div>
    </section>
    <!-- /About Section -->

    <!-- Stats Section -->
    <section class=""style="background-color: #C2A03D; padding: 50px 0; text-white text-center py-3" >
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h3 class=" font-weight-bold text-white">6250+</h3>
                    <p class="text-white">Happy Customers</p>
                </div>
                <div class="col-md-3">
                    <h3 class=" font-weight-bold text-white">3200+</h3>
                    <p>Successful Services</p>
                </div>
                <div class="col-md-3">
                    <h3 class=" font-weight-bold text-white">20+</h3>
                    <p>Years of Experience</p>
                </div>
                <div class="col-md-3">
                    <h3 class=" font-weight-bold text-white">15+</h3>
                    <p>Specialists</p>
                </div>
            </div>
        </div>
    </section>
    <!-- /Stats Section -->

    <!-- Team Section -->
    <section class="py-5 mb-5" style="background-color: #FBF5E2">
        <div class="container text-center">
            <h2 class="mb-5">Our Specialists</h2>
            <div class="row">
                <!-- Specialist 1 -->
                <div class="row mb-4">
					<div class="col-md-6 col-lg-3">
						<div class="team-member">
							<img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid rounded" alt="Jeffery Mussman">
							<h4 class="font-weight-bold">Jeffery Mussman</h4>
							<p>Psychologist</p>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="team-member">
							<img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid rounded" alt="Jeffery Mussman">
							<h4 class="font-weight-bold">Jeffery Mussman</h4>
							<p>Psychologist</p>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="team-member">
							<img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid rounded" alt="Jeffery Mussman">
							<h4 class="font-weight-bold">Jeffery Mussman</h4>
							<p>Psychologist</p>
						</div>
					</div>
					<div class="col-md-6 col-lg-3">
						<div class="team-member">
							<img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid rounded" alt="Jeffery Mussman">
							<h4 class="font-weight-bold">Jeffery Mussman</h4>
							<p>Psychologist</p>
						</div>
					</div>
				</div>
                <!-- Repeat for other specialists -->
            </div>
        </div>
    </section>
	
	<section class="vision-mission-section py-6 mb-6"> <!-- Increased padding and margin -->
        <div class="container">
            <h2 class="fw-bold mb-4 text-center">Vision & Mission</h2>
            <div class="row align-items-start">
                <!-- Vision -->
                <div class="col-md-6">
                    <div class="vision text-center"> <!-- Added text-center class -->
                        <h3 class="fw-bold">Our Vision</h3>
                        <p class="mb-0">We envision a world where clients attain mental well-being through self-care practices,
                            value-driven relationships, and nurturing bonds. By fostering secure connections and
                            balance, we guide our clients toward relationships that are not only fulfilling but also
                            deeply satisfying..</p>
                    </div>
                </div>
                
                 {{-- Mission  --}}
                <div class="col-md-6">
                    <div class="mission text-center"> <!-- Added text-center class -->
                        <h3 class="fw-bold">Our Mission</h3>
                        <p class="mb-0">At "The Way we Love Relationship Counseling," our mission is to foster mental health,
                            strengthen relationships, and empower individuals, couples, and families to achieve
                            deeper connection and lasting relationship satisfaction.</p>
                    </div>
                </div>
                {{-- Core values --}}
                <div class="feature-content mb-3">
                    <div class="text-center">
                        <h3 class="fw-bold">Core Values</h3>
                    </div>
                    <p class="mb-0 text-center">
                        Empathy.
                        Growth.
                        Balance.
                    </div>
            </div>
        </div>
    </section>
    
    
    

    <!-- Information Section  -->
    <section class="py-4 mb-5 text-white "style="background-color: #C2A03D;"> <!-- Added mb-5 for margin-bottom -->
        <div class="container">
            <div class="row text-center">
                <!-- Working Hours -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Working Hours:</h5>
                    <p>Mon - Sat: 8AM - 9PM<br>Sunday: 10AM - 8PM</p>
                </div>
                <!-- Location -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Location:</h5>
                    <p>789 Elm Avenue<br>Brooklyn, NY 11201</p>
                </div>
                <!-- Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Contact:</h5>
                    <p>+929 333 9296<br><a href="mailto:contact@mindthera.com" class="text-white">contact@mindthera.com</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /Team Section -->

@endsection
