<x-app-layout>
    <div>
        <div class="page-content">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="page-title mb-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Welcome Back!</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @if(count(App\Models\Appointment::where('user_id',Auth::user()->id)->where('status','Paid')->get())>0)
            <div class="col-lg-12">
                <div class="alert alert-danger alert-icon alert-dismissible">
                    <div class="row">
                            <div class="col-lg-9" style="padding-top:9px;">
                                <em class="icon ni ni-cross-circle"></em> <strong>Hello {{ Auth::user()->surname. ' '.Auth::user()->othernames}} </strong>! you have no active booking
                            </div>
                            <div class="col-lg-3">
                                <a href="{{ route('client.book') }}"><button class="btn btn-success align-right">Book Appointment</button></a>
                            </div>
                    </div>
                </div>
            </div><br>
            @endif
            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="avatar-sm font-size-20 me-3">
                                    <span class="avatar-title bg-soft-success text-success rounded">
                                        <i class="mdi mdi-newspaper-variant-outline"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <div class="font-size-16 mt-2">Pending Appointment</div>

                                </div>
                            </div>
                            <h4 class="mt-4">{{ App\Models\Appointment::where('status','Pending')->where('user_id',Auth::user()->id)->count() }}</h4>
                            <div class="row">
                                <div class="col-7">
                                    <p class="mb-0"><span class="text-success me-2"> 0 <i
                                                class="mdi mdi-arrow-up"></i> </span></p>
                                </div>
                                <div class="col-5 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="avatar-sm font-size-20 me-3">
                                    <span class="avatar-title bg-soft-success text-success rounded">
                                        <i class="mdi mdi-calendar"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <div class="font-size-16 mt-2">My Appointments</div>
                                </div>
                            </div>
                            <h4 class="mt-4">{{ App\Models\Appointment::where('user_id',Auth::user()->id)->count() }}</h4>
                            <div class="row">
                                <div class="col-7">
                                    <p class="mb-0"><span class="text-success me-2"> 0 Upcoming<i
                                                class="mdi mdi-arrow-up"></i> </span></p>
                                </div>
                                <div class="col-5 align-self-center">
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 62%"
                                            aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- end row -->
            </div>
        </div>
    </div>

</x-app-layout>
