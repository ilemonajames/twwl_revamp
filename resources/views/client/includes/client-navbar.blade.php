<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="#" class="booking-counc-img">
                    <img src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}">
                </a>
                <div class="profile-det-info">
                    <h3>{{ Auth::user()->surname." ".Auth::user()->othernames}}</h3>
                    <div class="patient-details">
                        <h5 class="mb-0">({{ Auth::user()->user_type}})</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="{{ Request::is('/client/booking') ? 'active' : '' }}">
                        <a href="{{ route('client-dashboard')}}">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('/client/booking') ? 'active' : '' }}">
                        <a href="{{ route('client.book')}}">
                            <i class="fas fa-calendar-check"></i>
                            <span>Book Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.bookings')}}">
                            <i class="fas fa-calendar-check"></i>
                            <span>My Appointments</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('client.change-password')}}">
                            <i class="fas fa-lock"></i>
                            <span>Change Password</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf</form>
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </div>
</div>
