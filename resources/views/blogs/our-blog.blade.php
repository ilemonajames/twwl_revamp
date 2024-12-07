@extends('layout.mainlayout')
@section('title') Our Services @endsection

@section('content')
  
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Blog</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="{{ route('home')}}">Home</a></li>
                        <li class="active">Blog</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row g-4 gy-5">
                @if(count($blogs)>0)
                @foreach ($blogs as $blog)
                <div class="col-lg-4 col-md-6 mb10">
                    <div class="rounded-20px">
                        <div class="post-image rounded-10px">
                            <div class="d-tagline">
                                <span>{{ $blog->blog_tag }}</span>
                            </div>
                            <img alt="{{ $blog->blog_title }}" src="{{ asset('/guest/images/uploads/' . $blog->image) }}" class="lazy">
                        </div>
                        <div class="pt-2 h-100">
                            <h4><a class="text-dark" href="{{ route('blogs.details', $blog->id) }}">{{ $blog->blog_title }}</a></h4>
                            <p class="mb-3">{!! Str::limit(strip_tags($blog->description), 150) !!}</p>
                            <div class="relative bg-grey p-1 px-3 rounded-10px">
                                <img src="{{ asset('/guest/images/uploads/' . $blog->image) }}" class="w-20px me-2 circle" alt="">
                                {{-- <div class="d-inline fs-14 fw-bold me-3">{{ $blog->user_id->surname}}</div> --}}
                                <div class="d-inline fs-14 fw-600"><i class="icofont-ui-calendar id-color me-2"></i>{{ $blog->created_at->format('d M Y')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="col-lg-9 offset-lg-2">
                    <div class="alert alert-danger">Ops! No blog post yet</div>

                </div>
                @endif
         

            </div>
        </div>
    </section>

    
               
           
@endsection
