@extends('layout.mainlayout')

@section('content')

<!-- content begin -->
<div id="content" class="no-top no-bottom">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">About Us</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">About Us</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    
    <!-- /Call to Action -->

    <!-- About Section -->
    <section class="py-5 mb-5"> <!-- Added mb-5 for margin-bottom -->
        <div class="container">
            <div class="row">
                <!-- Image with Caption -->
                <div class="col-lg-5 mb-4">
                    <figure class="figure">
						<div class="position-relative overflow-hidden rounded shadow-lg">
                        <img src="{{ asset('assets/img/we-always.png') }}" class="img-fluid" alt="Elizabeth Hall">
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
                    <p class="text-justify mb-4 text-lead">Elizabeth Hall is a dedicated mental health professional with a Master of Arts in Clinical Mental Health Counseling and a Bachelor's Degree in Psychology. She is a Certified Clinical Hypnotherapist (CCH) and holds the National Certified Counselor (NCC) credential from the National Board for Certified Counselors (NBCC). At the core of her work is a commitment to mental health and well-being, She believes that a person-centered approach is essential in any therapeutic relationship. By respecting the autonomy of her clients and working collaboratively with them, I tailor treatment to meet their unique needs. My approach is holistic and considers the mind, body, and spirit connection, ensuring that my clients receive compassionate, individualized care. </p>
					
					

                            <div class="about-section">
                                <p class="text-muted mb-3">Specializing in couples and family therapy, Elizabeth’s educational background equips her to provide systemic and relational therapeutic services for individuals, couples, and families. She integrates her training as a transpersonal hypnotherapist for clients dealing with stress-related issues, utilizing tools like guided imagery to promote deep relaxation and mental well-being.
                                </p>
                                
                                
                                <button class="collapsible btn btn-primary px-4 py-2 mb-3">Read More</button>
                                <div class="content">
                                    <p class="text-muted mb-3">
                                        Elizabeth is also certified by the Virginia Board of Counseling as a Qualified Mental Health Professional for adults and children (QMHP-A/C) and is currently registered with the Board as a Resident in Counseling and Marriage & Family Therapy. At the core of Elizabeth’s work is a commitment to mental health and well-being, and she believes that a person-centered approach is essential in any therapeutic relationship...</p>
                                    
                                    <h2>Personal beliefs</h2>
                                <p>I believe in empowering the individuals and organizations I serve to achieve mental, emotional, and spiritual well-being...</p>
                                    <p>My work is centered on fostering mental health through a holistic lifestyle of self-care that connects mind, body, and spirit.</p>
                                    <p>For individuals, couples, and families, I emphasize the importance of self-care...</p>
                                    <p>When working with organizations, I focus on developing customized curricula tailored to their unique needs...</p>
                                    <ul>
                                        <li><strong>Physical:</strong> Engaging in activities that promote physical health.</li>
                                        <li><strong>Psychological:</strong> Maintaining mental clarity and emotional balance.</li>
                                        <li><strong>Emotional:</strong> Understanding and regulating one’s emotional life.</li>
                                        <li><strong>Spiritual:</strong> Exploring deeper meaning and purpose.</li>
                                        <li><strong>Personal:</strong> Fostering individual growth and self-awareness.</li>
                                        <li><strong>Professional:</strong> Balancing career demands with personal well-being.</li>
                                    </ul>
                                    <p>By addressing self-care in these diverse areas, I believe individuals can achieve balance, maintain healthy relationships, and lead fulfilling lives.</p>
                                </div>
                            </div>
                            
                    </p>
					{{-- <a href="{{ url('/about') }}" >Learn More</a> --}}
				</div>
                
            </div>
        </div>
    </section>
    <!-- /About Section -->

    <!-- Stats Section -->
    <section class="bg-color-2 section-dark text-light text-center pt60 pb50 jarallax" style="background-color: #C2A03D; padding: 50px 0; text-white text-center py-3 " >
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
							<h4 class="font-weight-bold">Elizabeth Hall</h4>
							<p>CEO/Founder</p>
						</div>
					</div>
					{{-- <div class="col-md-6 col-lg-3">
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
					</div> --}}
				</div>
                <!-- Repeat for other specialists -->
            </div>
        </div>
    </section>
	
	<section class="jarallax overflow-hidden"> <!-- Increased padding and margin -->
        <div class="container">
            <div class="row g-4 gx-5">
                <div class="col-lg-12 text-center">
                    <div class="subtitle text-dark wow fadeInUp mb-3">Vision &amp; Mission</div>
                    <h2>Vision &amp; Mission</h2>
                </div>

                <div class="col-lg-6">
                    <h4 class="mb-4 wow fadeInRight">Our Vision</h4>
                    <p class="fs-24 fw-600 lh-1-4 wow fadeInUp">We envision a world where clients attain mental well-being through self-care practices, value-driven relationships, and nurturing bonds. By fostering secure connections and balance, we guide our clients toward relationships that are not only fulfilling but also deeply satisfying</p>
                    <h4 class="mb-4 wow fadeInRight">Our Mission</h4>
                    <p class="fs-24 fw-600 lh-1-4 wow fadeInUp"> At "The Way we Love Relationship Counseling," our mission is to foster mental health, strengthen relationships, and empower individuals, couples, and families to achieve deeper connection and lasting relationship satisfaction.</p>
                </div>

                <div class="col-lg-6">
                    <h4 class="mb-4 wow fadeInRight">Our Values</h4>
                    <ol class="ol-style-1">
                        <li class="wow fadeInUp" data-wow-delay=".2s"><span class="fw-bold id-color">Empathy:</span>   We believe in providing a safe, non-judgmental space where clients can explore
                            their emotions and challenges.</li>
                        <li class="wow fadeInUp" data-wow-delay=".4s"><span class="fw-bold id-color">   Growth :</span> We are dedicated to fostering personal and relational growth through
                            evidence-based methods and individualized support.</li>
                        <li class="wow fadeInUp" data-wow-delay=".6s"><span class="fw-bold id-color">Balance :</span> We help clients find balance in their lives and relationships, focusing on
                            self-care, communication, and connection. </li>
                    </ol>
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
                    <p>205 ½ E Broadway
                        <br>, Suite F & G Hopewell VA. 23860</p>
                </div>
                <!-- Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Contact:</h5>
                    <p>(804) 721-0983<br><a href="mailto:contact@thewaywelove.com" class="text-white">contact@thewaywelove.com</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /Team Section -->

@endsection
