<div class="modal fade xl" id="viewprogramModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewprogramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewprogramModalLabel">Program Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($program)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="c(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-8 offset-md-2">
                                    <img src="{{ asset('guest/images/uploads/'.$program->program_image) }}" class="rounded" alt="" width="100%">

                                </div>
                            </div>
                        </div><br><br>
                        <div class="mb-3" wire:ignore>
                            <h4 class="mt-0 font-size-16"><b>{{ $program->program_title }}</b></h4>
                            <p>{!! $program->program_description !!}</p>
                        </div>

                        <div class="row">
                            @foreach($program->fees as $fee)
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body" style="background-color: rgba(128, 128, 128, 0.051); border-radius: 10px">
                                        <h4 class="card-title mb-1"><b>{{ $fee->service->service_title}}</b></h4><hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2">Program Fee</p>
                                                    <h6>${{$fee->program_fees  }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2">Session Fee</p>
                                                    <h6>${{$fee->session_fees  }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2">Consultation Fee</p>
                                                    <h6>${{$fee->consultation_fees  }}</h6>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div>
                                                    <p class="mb-2">Duration</p>
                                                    <h6>{{$fee->duration  }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </form>
                    @else
                        <br><br><x-auth-loader/><br><br>
                    @endif
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
