<x-app-layout>
    <div class="page-content" >

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">My Bookings</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Booking</a></li>
                            <li class="breadcrumb-item active">My Bookings</li>
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
                        <x-search-bar wire:model.live="searchTerm" placeholder="Search by service title or description" />
                        <x-spin-loader />
                        <div>
                            <table class="table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Booking Date</th>
                                        <th>Appointment Date</th>
                                        <th>Program</th>
                                        {{-- <th>Service</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($bookings as $booking)

                                @php $programFee = App\Models\ProgramFee::where('program_id', $booking->program->id)->get(); 
                                var_dump($programFee[0]["payment_link"]);
                                @endphp

                                    <tr>
                                        <td>{{ $booking->created_at->format('d M, Y') }} <span class="d-block text-info">{{ $booking->created_at->format('h:m:s') }}</span></td>
                                        <td>{{ $booking->appointment_date->format('d M, Y') }} <span class="d-block text-info">{{ $booking->appointment_time }}</span></td>
                                        <td>{{ $booking->program->program_title  }}</td>
                                        {{-- <td>{{ $booking->service->service_title  }}</td> --}}
                                        <td><span class="badge badge-pill @if($booking->status=="pending") bg-danger @else bg-success @endif">{{ $booking->status }}</span></td>
                                        @if($booking->status != "Paid" && $booking->status!="Scheduled" && $booking->status!="Completed")
                                        <td class="text-right">
                                            <div class="table-action">
                                                <a href="$programFee[0]['payment_link]" class="btn btn-sm bg-danger-light">
                                                    <i class="far fa-money"></i> Pay to confirm appointment
                                                </a>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                                @if(count($bookings)<=0)
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                            alt="No results found" style="width: 150px; height: 100px;">
                                            <p class="mt-2 text-danger">No record found!</p>
                                        </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
