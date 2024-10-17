<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-end">
                <div class="dropdown d-none d-lg-inline-block ms-1">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-bell-outline"></i>
                        <span class="badge rounded-pill bg-danger ">0</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0"> Notifications </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="small"> View All</a>
                                </div>
                            </div>
                        </div>
                        <div data-simplebar style="max-height: 230px;">
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex align-items-start">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="bx bx-cart"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mt-0 mb-1">Your order is placed</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">If several languages coalesce the grammar</p>
                                            <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min
                                                ago</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="p-2 border-top d-grid">
                            <a class="btn btn-sm btn-link font-size-14 " href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View All..
                            </a>
                        </div>
                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect"
                        id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}" alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ms-1">{{ Auth::user()->surname }}</span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                            class="bx bx-user font-size-16 align-middle me-1"></i>
                        Profile</a>
                    <a class="dropdown-item d-block" href="{{ route('change-password') }}"><span
                            class="badge bg-success float-end"></span><i
                            class="bx bx-wrench font-size-16 align-middle me-1"></i> Settings</a>

                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger confirm-logout" href="#" onclick="event.preventDefault(); "
                        ><i
                                class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">  @csrf</form>
                            Logout</a>
                    </div>
                </div>
            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="#" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/img/logo.jpg')}}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/img/logo.jpg')}}" alt="" height="17">
                        </span>
                    </a>

                    <a href="#" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/img/logo.jpg')}}" alt="" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/img/logo.jpg')}}" alt="" height="30">
                        </span>
                    </a>
                </div>

                <button type="button"
                    class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                    id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
            </div>

        </div>
    </div>
</header>
