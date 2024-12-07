@extends('layout.mainlayout')
@section('logo'){{ asset('/guest/images/uploads/' . $blog->image) }}@endsection
@section('descirption'){!! Str::limit(strip_tags($blog->description), 100) !!}@endsection
@section('title') {{ $blog->blog_title }}@endsection

@section('content')

    <!-- Breadcrumb -->
        <!-- header close -->
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <!-- section begin -->
            <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
                <div class="container relative z-index-1000">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <h3 class="mb-0">Blog</h3>
                        </div>

                        <div class="col-lg-6 text-lg-end">
                            <ul class="crumb">
                                <li><a href="/">Home</a></li>
                                <li class="active">Blog details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- section close -->

            <section>
                <div class="container">
                    <div class="row gx-5">
                        <div class="col-lg-8">
                            <div>
                                <div class="d-tagline">
                                    {{-- <span>tips &amp; tricks</span>  --}}
                                </div>

                                <h2>{{ $blog->blog_title }}</h2>

                                <div>
                                    <img src="{{ asset('/guest/images/uploads/' . $blog->image) }}" class="img-fluid mb-4 rounded-20px" alt="">
                                    {!! $blog->description !!}
                                </div>

                            </div>


                            <div id="blog-comment">
                                {{-- <h4>Comments (5)</h4> --}}

                                <div class="spacer-half"></div>
                            </div>

                        </div>

                        <div class="col-lg-4">
                            <div class="widget widget-post">
                                <h4>Recent Posts</h4>
                                <ul class="de-bloglist-type-1">
                                    @foreach($blogs as $blog)
                                    <li>
                                        <div class="d-image">
                                            <img src="{{ asset('/guest/images/uploads/' . $blog->image) }}" alt="">
                                        </div>
                                        <div class="d-content">
                                            <a href="{{ route('blogs.details',$blog->id)}}"><h4>{{ $blog->blog_title }}</h4></a>
                                            <div class="d-date">{{ $blog->created_at->format('d M Y') }}</div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                          
                        

                    </div>
                </div>
            </section>
                        

    <!-- /Breadcrumb -->

    <!-- Page Content -->
    <div class="content">
        <div class="container">

            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-view">
                        <div class="blog blog-single-post">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img alt=""
                                        src="{{ asset('/guest/images/uploads/' . $blog->image) }}"
                                        class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{ $blog->blog_title }}</h3>

                            <div class="blog-content">
                                <p>{!! $blog->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Blog Sidebar -->
                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                    <!-- Search -->
                    <div class="card search-widget">
                        <div class="card-body">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /Search -->

                    <!-- Latest Posts -->
                    <div class="card post-widget">
                        <div class="card-header">
                            <h4 class="card-title">Other Services</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach($blogs as $blog)
                                <li>
                                    <div class="post-thumb">
                                        <a href="blog-details">
                                            <img class="img-fluid" src="{{ asset('/guest/images/uploads/' . $blog->image) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="post-info">
                                        <h4>
                                            <a href="{{ route('blogs.details',$blog->id)}}">{{ $blog->blog_title}}</a>
                                        </h4>
                                        <p>{!! Str::limit(strip_tags($blog->description),70) !!}</p>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                    <!-- /Latest Posts -->


                </div>
                <!-- /Blog Sidebar -->

            </div>
        </div>

    </div>
    <!-- /Page Content -->
    </div>
@endsection
