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

									<!-- Tab Menu -->
									<nav class="user-tabs mb-4">
										<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
											<li class="nav-item">
												<a class="nav-link active" href="#pat_appointments" data-toggle="tab">Appointments</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#pat_prescriptions" data-toggle="tab">Payments</a>
											</li>

										</ul>
									</nav>
									<!-- /Tab Menu -->

									<!-- Tab Content -->
									<div class="tab-content pt-0">

										<!-- Appointment Tab -->
										<div id="pat_appointments" class="tab-pane fade show active">
											<div class="card card-table mb-0">
												<div class="card-body">
                                                    @if(count($bookings)>0)
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
                                                    @else
                                                        <div class="alert alert-danger">You are yet to make any booking yet <a href="{{ route('client.book')}}">Book Appointment</a></div>
                                                    @endif
												</div>
											</div>
										</div>
										<!-- /Appointment Tab -->

										<!-- Prescription Tab -->
										<div class="tab-pane fade" id="pat_prescriptions">
											<div class="card card-table mb-0">
												<div class="card-body">
                                                    @if(count($payments)>0)
                                                    <div class="table-responsive">
														<table class="table table-hover table-center mb-0">
															<thead>
																<tr>
																	<th>Program</th>
																	<th>Service</th>
																	<th>Amount</th>
																	<th>Transaction Date</th>
																	<th>Status</th>
																	<th></th>
																</tr>
															</thead>
															<tbody>
                                                            @foreach($payments as $payment)
																<tr>
																	<td>{{ $payment->program->program_title  }}</td>
																	<td>{{ $payment->service->service_title  }}</td>
																	<td>${{ number_format($payment->amount)  }}</td>
																	<td>{{ $payment->created_at  }}</td>
																	<td><span class="badge badge-pill @if($payment->payment_status=="pending") bg-danger-light @else bg-success-light @endif">{{ $payment->payment_status }}</span></td>
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
                                                @else
                                                    <div class="alert alert-danger">You are yet to make any payment yet <a href="{{ route('client.book')}}">Book Appointment</a></div>
                                                @endif
												</div>
											</div>
										</div>
										<!-- /Prescription Tab -->

									</div>
									<!-- Tab Content -->

								</div>
							</div>
						</div>
					</div>

				</div>

			</div>
			<!-- /Page Content -->
			</div>
	   @endsection
