@extends('layout.mainlayout')
@section('title') Our Services @endsection

@section('content')
    <div class="breadcrumb-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-12 col-12">
                    <nav aria-label="breadcrumb" class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                    <h2 class="breadcrumb-title">Blog</h2>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcrumb -->
    <!-- Blog -->
    <section class="section section-blog">
        <div class="container">
            <div class="row">
                @if(count($blogs)>0)
                @foreach ($blogs as $blog)
                <div class="col-md-4 col-sm-12">

                    <!-- Blog Post -->
                    <div class="blog grid-blog">
                        <div class="blog-image">
                            <a href="blog-details"><img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $blog->image) }}" alt="Post Image"></a>
                        </div>
                        <div class="blog-content">
                            <ul class="entry-meta meta-item">

                                <li><i class="far fa-clock"></i> {{ $blog->created_at->format('d M Y')}}</li>
                            </ul>
                            <h3 class="blog-title"><a href="blog-details">{{ $blog->blog_title }}</a></h3>
                            <p class="mb-0">{!! Str::limit(strip_tags($blog->description), 100) !!}</p>
                            <br><a href="{{ route('blogs.details', $blog->id) }}">Learn more</a></p>
                        </div>
                    </div>
                    <!-- /Blog Post -->

                </div>
                @endforeach
                @else
                <div class="alert alert-danger" style="margin-left:45%">Ops! No blog post yet</div>
                @endif
            </div>
        </div>
    </section>
@endsection
