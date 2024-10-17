<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-body fw-medium font-size-16">{{ Auth::user()->surname." ".Auth::user()->othernames}}</a>
                <p class="text-muted mt-1 mb-0 font-size-13">{{ Auth::user()->user_type }}</p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-users"></i>
                        <span>Team</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('teams.create')}}">Add Team Member</a></li>
                        <li><a href="{{ route('teams.index')}}">Manage Team</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-folder"></i>
                        <span>Programs</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('programs.create')}}">Add Program</a></li>
                        <li><a href="{{ route('programs.index')}}">Manage Program</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-repeat"></i>
                        <span>Programs Fees</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('fees.create')}}">Setup Program Fees</a></li>
                        <li><a href="{{ route('fees.index')}}">Manage Program Fees</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-settings"></i>
                        <span>What we do</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('services.create')}}">Add What we do</a></li>
                        <li><a href="{{ route('services.index')}}">Manage What we do</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-newspaper-variant-outline"></i>
                        <span>Blog Post</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('blogs.create') }}">Add Blog Post</a></li>
                        <li><a href="{{ route('blogs.index') }}">Manage Blog Posts</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-calendar"></i>
                        <span>Events</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('events.create')}}" >Add Events</a></li>
                        <li><a href="{{ route('events.index')}}">Manage Events</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-update"></i>
                        <span>Newsletter</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('newsletter.send')}}" >Send Newsletter</a></li>
                        <li><a href="{{ route('newsletter.sent')}}">Sent Newsletter</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.bookings') }}" class="waves-effect">
                        <i class="mdi mdi-calendar"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-frequently-asked-questions"></i>
                        <span>FAQ</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('faqs.create')}}">Add Question</a></li>
                        <li><a href="{{ route('faqs.index')}}">Manage Questions</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
