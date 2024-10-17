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
									<div class="row">
										<div class="col-md-12 col-lg-6">

											<!-- Change Password Form -->
											<form method="post" action="{{ route('client.change-password')}}">
                                                @csrf
												<div class="form-group">
													<label>Old Password</label>
													<input type="password" name="current_passowrd" class="form-control">
                                                    @error('current_passowrd')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
												</div>
												<div class="form-group">
													<label>New Password</label>
													<input type="password" name="password" class="form-control">
                                                    @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
												</div>
												<div class="form-group">
													<label>Confirm Password</label>
													<input type="password" name="password_confirmation" class="form-control">
                                                    @error('password_confirmation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
												</div>
											</form>
											<!-- /Change Password Form -->

										</div>
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
