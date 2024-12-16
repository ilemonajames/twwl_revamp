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

                <li>
                    <a href="{{ route('client.book')}}" class="waves-effect">
                        <i class="fas fa-calendar-check"></i>
                        <span>Book Appointment</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('client.bookings')}}" class="waves-effect">
                        <i class="fas fa-calendar"></i>
                        <span>My Appointment</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
