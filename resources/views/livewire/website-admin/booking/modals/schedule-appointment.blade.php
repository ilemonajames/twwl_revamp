<div class="modal fade xl" id="scheduleAppointment" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="scheduleAppointment" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scheduleAppointment">Schedule Appointment
                </h5>
                <button type="button" class="btn-close" id="closeModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selBooking)
                    <form name="edit-service" id="edit-service" wire:submit.prevent="scheduleAppointment">
                        <div class="mb-3">
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
                            <br>

                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i wire:loading wire:target="scheduleAppointment"
                                    class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Schedule Appointment
                            </button>
                        </div>

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
        document.getElementById("closeModal").click();
     });

</script>
