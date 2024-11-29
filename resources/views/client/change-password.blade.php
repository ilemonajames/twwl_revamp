<?php $page="patient-dashboard";?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
<div class="no-bottom no-top" id="content">
	<div id="top"></div>
	<!-- section begin -->
	 <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
		<div class="container relative z-index-1000">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<h3 class="mb-0">dashboard</h3>
				</div>

				<div class="col-lg-6 text-lg-end">
					<ul class="crumb">
						<li><a href="/">Home</a></li>
						<li class="active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
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
