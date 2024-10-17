<div>
    <x-slot name="title">Staff List</x-slot>
    <div class="page-content" >

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Staff List</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Staff List</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12" >
                <div class="card">
                    <div class="card-body">
                        <div class="row">
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
                                                <div class="font-size-16 mt-2">Physical Attence</div>
                                            </div>
                                        </div>
                                        <h4 class="mt-4">{{ $regStats->where('type','Physical')->count() }}</h4>
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="mb-0"><span class="text-success me-2"> {{ $regStats->where('type','Physical')->count() }} Physically<i
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
                                                    <i class="mdi mdi-newspaper-variant-outline"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <div class="font-size-16 mt-2">Virtual Attendance</div>

                                            </div>
                                        </div>
                                        <h4 class="mt-4">{{ $regStats->where('type','Virtual')->count() }}</h4>
                                        <div class="row">
                                            <div class="col-7">
                                                <p class="mb-0"><span class="text-success me-2"> {{ $regStats->where('type','Virtual')->count() }} Attending Virtually <i
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
                        </div>
                        <x-search-bar wire:model.live="searchTerm" placeholder="Search" />
                        <x-spin-loader />
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">

                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Name</b></th>
                                        <th><b>Email</b></th>
                                        <th><b>Phone</b></th>
                                        <th><b>Attendance</b></th>
                                        {{-- <th><b>Action</b></th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventRegs as $reg)
                                        <tr>
                                            <th scope="row">{{ $sn = $sn + 1 }}</th>

                                            <td>{{ $reg->name}}</td>
                                            <td>{{ $reg->email }}</td>
                                            <td>{{ $reg->phoneno }}</td>
                                            <td>{{ $reg->type }}</td>


                                        </tr>
                                    @endforeach
                                    @if(count($eventRegs)<=0)
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                                alt="No results found" style="width: 150px; height: 100px;">
                                                <p class="mt-2 text-danger">No record found!</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                {{ $eventRegs->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
