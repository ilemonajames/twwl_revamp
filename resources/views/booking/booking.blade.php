
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
									<li class="breadcrumb-item active" aria-current="page">Booking</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Booking</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6 text-center">
                <div class="schedule-header">
                    <h2>Book Appointment</h2>
                    <p>Welcome to a safe space where transformation begins. Our mission is to provide compassionate counselling services tailored to adults navigating life's challenges. Fill out the form and we will contact you with an appointment. </p>
                </div>
                <!-- Schedule Widget -->
                <div class="schedule-widget">
                    <!-- Schedule Header -->
                   
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6">
                <!-- Program Selection Form -->
                <div class="program-selection">
                    <h4 class="mb-3">Select a Package</h4>
                    <form id="programForm" action="/booking" method="POST">
                        
                        
                        
                        <div class="form-group">
                            <label for="programSelect">Choose a plan:</label>
                            <select id="programSelect" class="form-control" required>
                                <option value="">--Select a program--</option>
                               @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->program_title }}</option>    
                                   
                               @endforeach
                               <option value="3">Others</option> 
                            </select>
                        </div>

                        <div class="form-group" id="serviceGroupDiv" style="display:none;">
                            <label for="serviceGroupSelect">Do you belong to any of the service groups?</label>
                            <select id="serviceGroupSelect" class="form-control">
                                <option value="">--Select a service group--</option>
                                @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->service_title }}</option>      
                                    
                                @endforeach
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="preferredDateInput">Preferred Date:</label>
                            <input type="date" id="preferredDateInput" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="nameInput">Name:</label>
                            <input type="text" id="nameInput" class="form-control" placeholder="Enter your name" required>
                        </div>

                        <div class="form-group">
                            <label for="emailInput">Email:</label>
                            <input type="email" id="emailInput" class="form-control" placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="phoneInput">Phone Number:</label>
                            <input type="tel" id="phoneInput" class="form-control" placeholder="Enter your phone number" required>
                        </div>
                        <div class="form-group">
                            <label for="addressInput">Address:</label>
                            <input type="text" id="addressInput" class="form-control" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group">
                            <label for="cityInput">City:</label>
                            <input type="text" id="cityInput" class="form-control" placeholder="Enter your city" required>                        
                        </div>  
                        <div class="form-group">
                            <label for="stateInput">State:</label>
                            <input type="text" id="stateInput" class="form-control" placeholder="Enter your state" required>
                        </div>
                        <div class="form-group">
                            <label for="zipInput">Zip Code:</label>
                            <input type="text" id="zipInput" class="form-control" placeholder="Enter your zip code" required>
                        </div>
                       
                       
                 
                        {{-- <button type="submit" class="btn btn-primary">Submit</button> --}}
                        <div class="submit-section proceed-btn text-right">
                            <button class="btn btn-primary submit-btn" value="Proceed to Pay" type="submit">Proceed to Pay</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

					<script>
					    document.getElementById('programSelect').addEventListener('change', function() {
					        var serviceGroupDiv = document.getElementById('serviceGroupDiv');
					        if (this.value) {
					            serviceGroupDiv.style.display = 'block';
					        } else {
					            serviceGroupDiv.style.display = 'none';
					        }
					    });
					
					    document.getElementById('programForm').addEventListener('submit', function(event) {
					        event.preventDefault();
					        // Handle form submission, e.g., send data to server via AJAX
					        alert('Form submitted!');
					    });
					</script>



											
										</div>
									</div>
								</div>
								<!-- /Schedule Content -->
								
							</div>
							<!-- /Schedule Widget -->
							
							<!-- Submit Section -->
							
							<!-- /Submit Section -->
							
						</div>
					</div>
				</div>

			</div>		
			<!-- /Page Content -->
			</div>
            <script>
                document.getElementById('programSelect').addEventListener('change', function() {
                    var serviceGroupDiv = document.getElementById('serviceGroupDiv');
                    if (this.value) {
                        serviceGroupDiv.style.display = 'block';
                    } else {
                        serviceGroupDiv.style.display = 'none';
                    }
                });
            
                document.getElementById('programForm').addEventListener('submit', function(event) {
                    event.preventDefault();
                    // Handle form submission, e.g., send data to server via AJAX
                    alert('Form submitted!');
                });
            </script>
	   @endsection
	  