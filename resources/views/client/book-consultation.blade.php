<?php $page="patient-dashboard";?>
@extends('layout.mainlayout')
@section('content')
<!-- Breadcrumb -->
     <!-- content begin -->
     <div class="no-bottom no-top" id="content">
        <div id="top"></div>
        <!-- section begin -->
        <section class="mt80 mt-sm-60 pt20 pb20 bg-color text-light">
            <div class="container relative z-index-1000">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3 class="mb-0">Booking</h3>
                    </div>

                    <div class="col-lg-6 text-lg-end">
                        <ul class="crumb">
                            <li><a href="">Home</a></li>
                            <li class="active">Booking</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- section close -->

        <section>
            <div class="container">
                <div class="row g-4">
                            @include('client.includes.client-navbar')
                        
                    
                    <div class="col-lg-7">
                        <div id="gallery" class="row g-4">
                            <div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">

											<!-- Change Password Form -->
											<form method="post" action="{{ route('book-appointment')}}">
                                                @csrf
												<div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label-outlined" for="relationship">Program</label>

                                                            <div class="form-control-wrap">
                                                                <select name="program" class="form-control form-control-xl form-control-outlined"
                                                                     id="selProgram">
                                                                    <option value="" selected>-- Select Program --</option>
                                                                    @foreach(App\Models\Program::all() as $program)
                                                                    <option value="{{ $program->id }}" {{ old('program') == $program->id ? 'selected' : '' }}>{{ $program->program_title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @error('program')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                    </div>
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label-outlined" for="relationship">Type of Booking</label>

                                                            <div class="form-control-wrap" >
                                                                <select class="form-control form-control-xl form-control-outlined" name="service" value="{{ old('service')}}" id="selService">
                                                                    <option value="" selected>-- Type of Booking --</option>
                                                                    @if(old('program'))
                                                                        @foreach(App\Models\ProgramFee::where('program_id',old('program'))->get() as $fees)
                                                                        <option value="{{ $fees->service->id }}" {{ old('service') == $fees->service->id ? 'selected' : '' }}>{{ $fees->service->service_title }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @error('service')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="col-md-12 mt-4" id="pricing" >
                                                        @if(old('program')) @php $selApp = App\Models\ProgramFee::where('program_id',old('program'))->first() @endphp @endif
                                                        <div class="card">
                                                            <div class="card-body" style="background-color: rgba(128, 128, 128, 0.051); border-radius: 10px">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div>
                                                                            <p class="mb-2"><b>Program Fee</b></p>
                                                                            <h6 id="programFees">@if(old('program')) ${{ $selApp->program_fees }} @else @endif</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div>
                                                                            <p class="mb-2"><b>Session Fee</b></p>
                                                                            <h6 id="sessionFees">@if(old('program')) ${{ $selApp->session_fees }} @else @endif</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div>
                                                                            <p class="mb-2"><b>Consultation Fee</b></p>
                                                                            <h6 id="consultationFees">@if(old('program')) ${{ $selApp->consultation_fees }} @else @endif</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div>
                                                                            <p class="mb-2"><b>Duration</b></p>
                                                                            <h6 id="duration">@if(old('program')) {{ $selApp->duration }} @else @endif</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Date of Appointment</label>
                                                            <input type="date" value="{{ old('ap_date')}}" name="ap_date" class="form-control">
                                                            @error('ap_date')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Time of Appointment</label>
                                                            <input type="time" value="{{ old('ap_time')}}"  name="ap_time" class="form-control">
                                                            @error('ap_time')
                                                            <p class="text-danger">{{ $message }}</p>
                                                        @enderror
                                                        </div>
                                                    </div>
                                                </div>

												<div class="form-group">
													<label>Comment</label>
													<input type="text" name="comment" value="{{old('comment')}}" class="form-control">
                                                    @error('comment')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
												</div>
												<div class="submit-section">
													<button type="submit" class="btn btn-primary submit-btn">Book Appointment</button>
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

			<!-- /Breadcrumb -->

			<!-- Page Content -->
			<div class="content">
				

			</div>
			<!-- /Page Content -->
			</div>

@push('script')
    <script>

         var selService = document.getElementById("selService").value;

         if(selService==""){
            var x = document.getElementById("pricing");
            x.style.display = "none"
         }else{
            var x = document.getElementById("pricing");
            x.style.display = "block"
         }

        $(document).ready(function(){
            //get department units
            var productID;
            $('#selProgram').on('change',function(){
                productID = $(this).val();
                $('#selService').empty();
                $('#selService').append('<option value="0" disabled selected>Processing...</options>');
                    $.ajax({
                        url: '/client/get-services/' + productID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;
                            $('#selService').empty();
                            $('#selService').append('<option value="0" disabled selected>Select Type of Booking...</options>');
                            response.forEach(element => {
                                $('#selService').append(`<option value="${element['id']}">${element['service_title']}</options>`);
                            });
                        },
                        error: function( _response ){
                            console.log(_response);
                        }
                    });
            });


            //selected Servcie
            $('#selService').on('change',function(){
                let id = $(this).val();
                    $.ajax({
                        url: '/client/get-booking-price/' + id + "/" + productID,
                        type: 'GET',
                        dataType: 'json',
                        success: function(_response){
                            var response = _response;
                            if(response!=0){
                                var x = document.getElementById("pricing");
                                x.style.display = "block";
                                $('#sessionFees').text("$"+response['session_fees']);
                                $('#consultationFees').text("$"+response['consultation_fees']);
                                $('#duration').text(response['duration']);
                                $('#programFees').text("$"+response['program_fees']);
                            }else{
                                var x = document.getElementById("pricing");
                                x.style.display = "none"
                            }
                        },
                        error: function( _response ){
                            console.log(_response);
                        }
                    });
            });
        });

    </script>
    @endpush
	   @endsection
