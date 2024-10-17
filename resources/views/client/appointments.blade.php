<?php $page="patient-dashboard";?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
			<div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Dashboard</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->

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
