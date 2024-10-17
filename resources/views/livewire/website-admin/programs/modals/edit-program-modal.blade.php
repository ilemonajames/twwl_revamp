<div class="modal fade xl" id="viewService" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceModalLabel">Service Modification
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
                            <label class="form-label">Service Title</label>
                            <input class="form-control" wire:model="title" type="text" placeholder="">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ getImage().$service->service_icon }}" class="rounded-circle avatar-xs m-1" alt="">
                                </div>
                                <div class="col-md-10">
                                    <img src="{{ getImage().$service->service_image }}" class="rounded" alt="" height="48">

                                </div>
                            </div>
                        </div>
                        <div class="mb-3" wire:ignore>
                            <label class="form-label" for="description">Service Description</label>
                            <div wire:ignore>
                                <textarea id="message" wire:model="description" class="form-control tinymce-basic" name="description"></textarea>
                            </div>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
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
    window.addEventListener('setRickText', event => {
        tinyMCE.activeEditor.setContent(event.detail.setRickText);
    });
</script>
