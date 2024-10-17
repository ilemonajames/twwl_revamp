<div class="modal fade xl" id="viewEvent" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewEventLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEventLabel">Event Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if ($selEvent)
                        <form name="edit-service" id="edit-service"
                            wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                            enctype="multipart/form-data">
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($selEvent->thumbnail != null)
                                            <img src="{{ asset('guest/images/uploads/'. $selEvent->thumbnail) }}" class="rounded"
                                                alt="" height="250">
                                        @else
                                            <img src="{{ asset('guest/images/uploads/'. $selEvent->image) }}" class="rounded"
                                                alt="" height="250">
                                        @endif

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="avatar-sm font-size-20 me-3">
                                                            <span
                                                                class="avatar-title bg-soft-success text-success rounded">
                                                                <i class="mdi mdi-calendar"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="font-size-16 mt-2">Date</div>

                                                        </div>
                                                    </div>
                                                    <h4 class="mt-4 text-success">
                                                        {{ $selEvent->event_date->format('d M, Y') }}</h4>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-start">
                                                        <div class="avatar-sm font-size-20 me-3">
                                                            <span
                                                                class="avatar-title bg-soft-success text-success rounded">
                                                                <i class="mdi mdi-timer"></i>
                                                            </span>
                                                        </div>
                                                        <div class="flex-1">
                                                            <div class="font-size-16 mt-2">Time</div>

                                                        </div>
                                                    </div>
                                                    <h4 class="mt-4 text-success">
                                                        {{ $selEvent->event_time }}</h4>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-start">
                                                            <div class="avatar-sm font-size-20 me-3">
                                                                <span
                                                                    class="avatar-title bg-soft-success text-success rounded">
                                                                    <i class="mdi mdi-google-maps"></i>
                                                                </span>
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="font-size-16 mt-2">Location</div>

                                                            </div>
                                                        </div>
                                                        <h6 class="mt-4 text-success">
                                                            {{ $selEvent->event_location }}</h6>
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                @error('service_icon')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3" wire:ignore>
                                <h2 class="mt-0 font-size-16"><b>{{ $selEvent->event_title }}</b></h2>
                                <p>{!! $selEvent->description !!}</p>
                            </div>

                        </form>
                    @else
                        <x-auth-loader />
                    @endif
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
