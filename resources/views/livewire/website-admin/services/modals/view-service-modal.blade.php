<div class="modal fade xl" id="viewServiceModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewServiceModalLabel">Service Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($service)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset('guest/images/uploads/'.$service->service_icon) }}" class="rounded-circle avatar-xl m-" alt="">
                                </div>
                                <div class="col-md-10">
                                    <img src="{{ asset('guest/images/uploads/'.$service->service_image) }}" class="rounded" alt="" height="150">

                                </div>
                            </div>
                            @error('service_icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3" wire:ignore>
                            <h4 class="mt-0 font-size-16">{{ $service->service_title }}</h4>
                            <p>{!! $service->service_description !!}</p>
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
