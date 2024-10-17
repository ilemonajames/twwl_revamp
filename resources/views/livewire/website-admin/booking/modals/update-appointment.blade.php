<div class="modal fade xl" id="updateAppointment" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="updateAppointment" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAppointment">Appointment Modification
                </h5>
                <button type="button" class="btn-close" id="closeUpdateModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selBooking)
                    <form name="edit-service" id="edit-service" wire:submit.prevent="updateAppointment">
                        {{-- <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Appointment date</label>
                                    <input class="form-control" wire:model="ap_date" type="date" placeholder="">
                                    @error('ap_date')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Appointment time</label>
                                    <input class="form-control" wire:model="ap_time" type="time" placeholder="">
                                    @error('ap_time')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                        <div class="mb-3">
                            <label class="form-label">Booking Status</label>
                            <select class="form-select" aria-label="Default select example" wire:model.live="status">
                                <option selected="">-- Select Status--</option>
                                <option value="Scheduled">Scheduled</option>
                                <option value="Completed">Completed</option>
                                <option value="Closed">Closed</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <br>

                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i wire:loading wire:target="updateAppointment"
                                class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Update Appointment
                        </button>
                    </form>
                    @else
                        <x-auth-loader/>
                    @endif
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.addEventListener('feedback',event => {
        document.getElementById("closeUpdateModal").click();
     });

</script>
