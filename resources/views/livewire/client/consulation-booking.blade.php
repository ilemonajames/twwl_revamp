<div>

    <div class="col-lg-12" >
        <div class="card">
            <div class="card-body">
                <div class="col-md-12 col-lg-12">
                    @include('livewire.client.modals.payment-model')

                    <!-- Change Password Form -->
                    <form method="post" id="placeOrderForm" wire:submit.prevent="bookConsulation">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label-outlined" for="relationship">Program</label>

                                    <div class="form-control-wrap">
                                        <select name="program" wire:model.live="program" class="form-control form-control-xl form-control-outlined"
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

                            <div class="col-md-12 mt-4" id="pricing" >
                                @if ($selApp)
                                <div class="card">
                                    <div class="card-body" style="background-color: rgba(128, 128, 128, 0.051); border-radius: 10px">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2"><b>Program Fee</b></p>
                                                    <h6 id="programFees">${{ $selApp->program_fees }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2"><b>Session Fee</b></p>
                                                    <h6 id="sessionFees">${{ $selApp->session_fees }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2"><b>Consultation Fee</b></p>
                                                    <h6 id="consultationFees">${{ $selApp->consultation_fees }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2"><b>Duration</b></p>
                                                    <h6 id="duration">{{ $selApp->duration }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date of Appointment</label>
                                    <input type="date"  wire:model="ap_date" value="" name="ap_date" class="form-control">
                                    @error('ap_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Time of Appointment</label>
                                    <input type="time" wire:model="ap_time" value=""  name="ap_time" class="form-control">
                                    @error('ap_time')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <label>Comment</label>
                            <input type="text" wire:model="comment" name="comment" value="" class="form-control">
                            @error('comment')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                        </div><br>

                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i wire:loading wire:target="bookConsulation"
                                class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Book
                        </button>

                    </form>
                </div>
            </div>
        </div>

    </div>

</div>


