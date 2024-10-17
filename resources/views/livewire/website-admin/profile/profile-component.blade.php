<div>
    @include('livewire.website-admin.profile.modals.edit-profile-photo-modal')
    <div class="main-content">

        <div class="page-content">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start row -->
            <div class="row">
                <div class="col-md-12 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="profile-widgets py-3">

                                <div class="text-center">
                                    <div class="">
                                        <a data-bs-toggle="modal" data-bs-target="#editProfilePhotoModal" wire:click="setPhoto('{{ Auth::user()->id }}')">
                                            <img src="{{ asset('assets/images/users/'.Auth::user()->profile_photo_path) }}" alt=""
                                            class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                            <div class="online-circle">
                                                {{-- <i class="fas fa-circle text-success"></i> --}}
                                                <i class="fas fa-edit text-danger"></i>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="mt-3 ">
                                        <a href="#" class="text-reset fw-medium font-size-16">{{Auth::user()->surname.' '.Auth::user()->othernames}}</a>
                                        <p class="text-body mt-1 mb-1">{{Auth::user()->user_type}}</p>
                                        <span class="@if(Auth::user()->status=='Active') badge bg-success @else badge bg-success @endif ">{{ Auth::user()->status}}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-xl-9">

                    <div class="card">
                        <div class="card-body">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#biodata" role="tab">
                                        <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                        <span class="d-none d-sm-block">Bio Data</span>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#revenue" role="tab">
                                        <span class="d-none d-sm-block">Profile Photo</span>
                                    </a>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="{{ route('change-password') }}" role="tab">
                                        <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                        <span class="d-none d-sm-block">Password</span>
                                    </a>
                                </li> --}}
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content p-3 text-muted">
                                <div class="tab-pane active" id="biodata" role="tabpanel">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="firstname">Surname</label>
                                                <input type="text" value="{{ Auth::user()->surname }}" readonly class="form-control" id="firstname" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-1">
                                                <label class="form-label" for="lastname">Othernames</label>
                                                <input type="text" value="{{ Auth::user()->othernames }}" readonly class="form-control" id="lastname" >
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="firstname">Email</label>
                                                <input type="text" value="{{ Auth::user()->email }}" readonly class="form-control" id="firstname" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="lastname">Phone Number</label>
                                                <input type="text" value="{{ Auth::user()->phoneno }}" readonly class="form-control" id="lastname" >
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="userbio">Address</label>
                                                <textarea class="form-control" readonly id="userbio" rows="4">{{ Auth::user()->address }}</textarea>
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div>

                                {{-- <div class="tab-pane" id="experience" role="tabpanel">

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="userbio">Old Password</label>
                                                <input type="text" class="form-control" id="lastname" >
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="userbio">New Password</label>
                                                <input type="text" class="form-control" id="lastname" >
                                            </div>
                                        </div> <!-- end col -->
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label class="form-label" for="userbio">Confirm Password</label>
                                                <input type="text" class="form-control" id="lastname" >
                                            </div>
                                        </div> <!-- end col -->
                                    </div>
                                </div> --}}

                                {{-- <div class="tab-pane" id="revenue" role="tabpanel">
                                    <div id="revenue-chart" class="apex-charts mt-4"></div>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- End Page-content -->
    </div>
</div>
