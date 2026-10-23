@extends('layout.mainlayout')
@section('title', 'About Elizabeth Hall | The Way We Love')

@section('content')

<!-- content begin -->
<div id="content" class="site-about no-top no-bottom">
    <div id="top"></div>
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-0 fs-3">About Us</h1>
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
    <section class="site-about-intro">
        <div class="container">
            <div class="row g-5 align-items-start">
                <!-- Image with Caption -->
                <div class="col-lg-5">
                    <figure class="site-about-portrait figure">
						<div class="site-about-portrait-frame position-relative overflow-hidden rounded">
                        <img src="{{ asset('assets/img/elizabeth-hall-enhanced.png') }}" class="img-fluid" width="1122" height="1402" alt="Elizabeth Hall smiling, with her chin resting on her hands">
						</div>
                        <figcaption class="figure-caption text-center">
                            <h3>Elizabeth Hall</h3>
                            <p class="mb-1">NCC, LPC/LMFT, CHT</p>
                            <p class="mb-0">She/Her</p>
                        </figcaption>
                    </figure>
                </div>
                <!-- About Text -->
				<div class="col-lg-7 site-about-biography">
                    <div class="subtitle mb-3">Meet Elizabeth</div>
					<h2 class="mb-4">Who is Elizabeth Hall?</h2>
                    
                    <p class="text-justify mb-4 text-lead text-justify">Elizabeth Hall is a dedicated mental health professional with a Master of Arts in Clinical Mental
                        Health Counseling and a Bachelor's Degree in Psychology. She is a Certified Transperson
                        Hypnotherapist (CTH) and holds the National Certified Counselor (NCC) credential from the National Board for Certified Counselors (NBCC).
                         </p>
					
					

                            <div class="about-section">
                                <p class="text-muted mb-3 text-justify">Specializing in couples and family therapy, Elizabeth’s educational background equips her to
                                    provide systemic and relational therapeutic services for individuals, couples, and families. She
                                    integrates her training as a transpersonal hypnotherapist for clients dealing with stress-related
                                    issues, utilizing tools like guided imagery to promote deep relaxation and mental well-being.
                                </p>
                                
                                
                                <details class="site-about-details">
                                <summary>More about Elizabeth’s approach</summary>
                                <div class="site-about-details-copy">
                                    <p class="text-muted mb-3">
                                        Elizabeth is also certified by the Virginia Board of Counseling as a Qualified Mental Health Professional for adults and children (QMHP-A/C) and is currently registered with the Board as a Resident in Counseling and Marriage & Family Therapy. At the core of Elizabeth’s work is a commitment to mental health and well-being, and she believes that a person-centered approach is essential in any therapeutic relationship...</p>
                                    
                                    <h2>Personal beliefs</h2>
                                    <em>Holistic Empowerment and Wellness</em>
                                    <p>I believe in empowering the individuals and organizations I serve to achieve mental, emotional,
                                    and spiritual well-being. My work is centered on fostering mental health through a holistic lifestyle
                                    of self-care that connects mind, body, and spirit.</p>
                                    <p>
                                    For individuals, couples, and families, I emphasize the importance of self-care as a proactive and
                                    preventive practice, rather than just a reactive one. This means helping clients create
                                    personalized plans that incorporate mental, emotional, physical, and spiritual activities that
                                    nourish and sustain them.</p>
                                    <p>When working with organizations, I focus on developing customized curricula tailored to their
                                    unique needs, supporting the mental and emotional wellness of their teams.
                                    I draw from the <b>Self-Care Wheel framework</b>, which includes perspectives such as:</p>
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
                                </details>
                            </div>
                            
					{{-- <a href="{{ url('/about') }}" >Learn More</a> --}}
				</div>
                
            </div>
        </div>
    </section>
    <!-- /About Section -->

    @php
    $teams = App\Models\LivingwordTeam::all();

    @endphp

    @if(count($teams)>0)
    <!-- Team Section -->
    <section class="site-about-team">
        <div class="container text-center">
            <h2 class="mb-5">Our Specialists</h2> 
            <div class="row g-4 justify-content-center">
                <!-- Specialist 1 -->
                @foreach($teams as $team)
                    <div class="col-md-6 col-lg-3 site-about-team-card">
						 <div class="team-member">
							<img src="{{ asset('assets/images/team/'.$team->image)}}" class="img-fluid rounded-10x"  alt="{{ $team->full_name }}">
							<h4 class="font-weight-bold">{{ $team->full_name }}</h4>
							<p>{{ $team->role }}</p>
						</div>
                        <div class="social-icons">
                            <a href="{{ $team->facebook }}"><i class="bg-white id-color bg-hover-2 text-hover-white fa-brands fa-facebook-f"></i></a>
                            <a href="{{ $team->twitter }}"><i class="bg-white id-color bg-hover-2 text-hover-white fa-brands fa-twitter"></i></a>
                            <a href="{{ $team->instagram }}"><i class="bg-white id-color bg-hover-2 text-hover-white fa-brands fa-instagram"></i></a>
                        </div>
					</div>
            @endforeach
            </div>
        </div>
    </section>
    @endif
	
	<section class="site-about-purpose">
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
    <section class="site-about-contact">
        <div class="container">
            <div class="row text-center">
                <!-- Working Hours -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Working Hours:</h5>
                    {{-- <p>Mon - Sat: 8AM - 9PM<br>Sunday: 10AM - 8PM</p> --}}
                    <p><a href="https://calendly.com/thewaywelove24" target="_blank" rel="noopener noreferrer" class="btn-main">View availability</a></p>
                </div>
                <!-- Location -->
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold">Location:</h5>
                    <p>206 N 2nd Avenue, 
                        <br>, Hopewell Va 23860</p>
                </div>
                <!-- Contact -->
                <div class="col-md-4">
                    <h5 class="fw-bold">Contact:</h5>
                    <p><a href="tel:+18047210983">(804) 721-0983</a><br><a href="mailto:contact@thewaywelove.com">contact@thewaywelove.com</a></p>
                </div>
            </div>
        </div>
    </section>
    <!-- /Team Section -->

</div>
@endsection
