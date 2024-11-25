@extends('layout.mainlayout')
@section('title') Our Programs @endsection

@section('content')
   
    <!-- /Breadcrumb -->
    
      <!-- content begin -->
      <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
            <div class="container relative z-index-1000">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-0">Our Packages</h3>
                    </div>

                    <div class="col-lg-6 text-lg-end">
                        <ul class="crumb">
                            <li><a href="/">Home</a></li>
                            <li class="active">Programs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <ul id="filters" class="s2">
                            {{-- @php
                            $sn =1;
                            @endphp --}}
                            <li><a href="#" data-filter="*" class="selected">All services</a></li>

                            @foreach ($programs as $program)
                            <li><a href="#" data-filter=".service-{{$program->id}}">{{ $program->program_title }}</a></li>  
                            @endforeach
                            {{-- <li><a href="#" data-filter="*" class="selected">All services</a></li>
                            <li><a href="#" data-filter=".service-1">Individual Therapy</a></li>
                            <li><a href="#" data-filter=".service-2">Couples Counseling</a></li>
                            <li><a href="#" data-filter=".service-3">Career Counseling</a></li>
                            <li><a href="#" data-filter=".service-4">Stress management</a></li>
                            <li><a href="#" data-filter=".service-5">Anxiety Treatment</a></li>
                            <li><a href="#" data-filter=".service-6">Depression Therapy</a></li> --}}
                        </ul>
                    </div>

                    <div class="col-lg-9">
                        <div id="gallery" class="row g-4">
                          
                            @if(count($programs)>0)
                @foreach ($programs as $program)
                            <div class="item service-{{ $program->id }} col-lg-4 text-center">
                                <a href="{{ route('programs.details', $program->id) }}" class="d-block hover">
                                    <div class="relative overflow-hidden rounded-20px">
                                        <div class="absolute start-0 w-100 abs-middle fs-36 text-white text-center">
                                            <span class="btn-main hover-scale-in-2">Read More</span>
                                        </div>
                                        <img src="{{ asset('/guest/images/uploads/' . $program->program_image) }}" class="img-fluid hover-scale-1-2" alt="">
                                    </div>
                                </a>
                                <h4 class="mt-3 mb-0">{{ $program->program_title }}</h4>
                                <p class="mb-2">{!! Str::limit(strip_tags($program->program_description), 40) !!}</p>
                            </div>
                            @endforeach
                            @endif
                          
                           
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
    <!-- content close -->
   
@endsection
