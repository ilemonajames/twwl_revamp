
@extends('layout.mainlayout')
@section('content')
			<!-- Call to Action -->
			<section class="section section-call-to-action">
				<div class="container">
					<div class="call-width">
						<h2>Frequently Asked Questions</h2>
					</div>
				</div>
			</section>
			<!-- /Call to Action -->

            <section class="bg-light py-3 py-md-5">
                <div class="container">
                  <div class="row gy-5 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                      <img class="img-fluid rounded" loading="lazy" src="{{ asset('assets/images/faq-img-1.png')}}" alt="How can we help you?">
                    </div>
                    <div class="col-12 col-lg-6">
                      <div class="row justify-content-xl-end">
                        <div class="col-12 col-xl-11">
                          {{-- <h2 class="h1 mb-3"><b>How can we help you?</b></h2>
                          <p class="lead fs-4 text-secondary mb-5">We hope you have found an answer to your question. If you need any help, please search your query on our Support Center or contact us via email.</p> --}}
                          <div class="accordion accordion-flush" id="accordionExample">
                            @foreach($faqs as $faq)
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="headingOne{{$faq->id}}">
                                <button class="btn-primary" style="font-size: 20px; padding: 10px; width:100%" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$faq->id}}" aria-expanded="true" aria-controls="collapseOne{{$faq->id}}">
                                  {{ $faq->question}}
                                </button>
                              </h2>
                              <div id="collapseOne{{$faq->id}}" class="accordion-collapse collapse show" aria-labelledby="headingOne{{$faq->id}}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                  <p>{!! $faq->answer !!}</p>
                                </div>
                              </div>
                            </div>
                            @endforeach
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

			</div>
            <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
	   @endsection
