<?php $page="patient-dashboard";?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<
			<!-- /Breadcrumb -->
 <!-- content begin -->
 <!--<div class="no-bottom no-top" id="content">
    <div id="top"></div>   --> 
    <!-- section begin -->
    <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
        <div class="container relative z-index-1000">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>

                <div class="col-lg-6 text-lg-end">
                    <ul class="crumb">
                        <li><a href="">Home</a></li>
                        <li class="active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- section close -->

    <section>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    
                     {{--<ul id="filters" class="s2">
                        <li><a href="#" data-filter="*" class="selected">All services</a></li>
                        <li><a href="#" data-filter=".service-1">Individual Therapy</a></li>
                        <li><a href="#" data-filter=".service-2">Couples Counseling</a></li>
                        <li><a href="#" data-filter=".service-3">Career Counseling</a></li>
                        <li><a href="#" data-filter=".service-4">Stress management</a></li>
                        <li><a href="#" data-filter=".service-5">Anxiety Treatment</a></li>
                        <li><a href="#" data-filter=".service-6">Depression Therapy</a></li> 
                        @include('client.includes.client-navbar')
                    </ul>--}}
                </div>
			<!-- Page Content -->
			<div class="content">
				<div class="container">

					<div class="row">

						<!-- Profile Sidebar -->
                        @include('client.includes.client-navbar')
						<!-- / Profile Sidebar -->

						<div class="col-md-7 col-lg-8 col-xl-9">
							<div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Booking Date</th>
                                                    <th>Appointment Date</th>
                                                    <th>Program</th>
                                                    <th>Service</th>
                                                    <th>Status</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($bookings as $booking)
                                                <tr>
                                                    <td>{{ $booking->created_at->format('d M, Y') }} <span class="d-block text-info">{{ $booking->created_at->format('h:m:s') }}</span></td>
                                                    <td>{{ $booking->appointment_date->format('d M, Y') }} <span class="d-block text-info">{{ $booking->appointment_time }}</span></td>
                                                    <td>{{ $booking->program->program_title  }}</td>
                                                    <td>{{ $booking->service->service_title  }}</td>
                                                    <td><span class="badge badge-pill @if($booking->status=="pending") bg-danger-light @else bg-success-light @endif">{{ $booking->status }}</span></td>
                                                    <td class="text-right">
                                                        <div class="table-action">
                                                            <a href="javascript:void(0);" class="btn btn-sm bg-info-light">
                                                                <i class="far fa-eye"></i> View
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<!-- /Page Content -->
			</div>
	   @endsection
