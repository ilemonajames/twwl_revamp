<div>
    <x-slot name="title">Program Fees Modification</x-slot>

    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">New Porgram Fees</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Program Fees Modification</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <form name="new-event" id="new-event" wire:submit.prevent="updateFees" enctype="multipart/form-data">
                            <div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label-outlined" for="relationship">Program</label>

                                        <div class="form-control-wrap" wire:ignore.self>
                                            <select wire:model="program"
                                            class="form-control form-control-xl form-control-outlined"
                                                 id="program">
                                                <option value="program" selected>-- Select Program --</option>
                                                @foreach(App\Models\Program::all() as $program)
                                                <option value="{{ $program->id }}">{{ $program->program_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('program')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label class="form-label-outlined" for="relationship">Service</label>

                                        <div class="form-control-wrap" wire:ignore.self>
                                            <select wire:model="service"
                                            class="form-control form-control-xl form-control-outlined"
                                                 id="service">
                                                <option value="service" selected>-- Select Service --</option>
                                                @foreach(App\Models\Service::all() as $service)
                                                <option value="{{ $service->id }}">{{ $service->service_title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    @error('service')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Consultation Fees($)</label>
                                            <input class="form-control" oninput="numericInputs(event)" wire:model="consultation_fees" type="text" placeholder="">
                                            @error('consultation_fees')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Session Fees($)</label>
                                            <input class="form-control" oninput="numericInputs(event)" wire:model="session_fees" type="text" placeholder="">
                                            @error('session_fees')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Program Fees($)</label>
                                            <input class="form-control" oninput="numericInputs(event)" wire:model="program_fees" type="text" placeholder="">
                                            @error('program_fees')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Duration</label>
                                            <input class="form-control"  wire:model="duration" type="text" placeholder="">
                                            @error('duration')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    <i wire:loading wire:target="updateFees"
                                        class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Update Fees
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div>@include('livewire.website-admin.crop-image-modal.image_croper')</div>
<div>@include('livewire.website-admin.events.crop-image-modal.thumbnail_croper')</div>
</div>
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/cvjfkxqlo8ylwqn3xgo15h2bd4xl6n7m6k5d0avjcq93c1i7/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#message',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('description', editor.getContent());
                });
            }
        });


        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        window.addEventListener('feedback', event => {
            document.getElementById('croped_image').value = "";
            document.getElementById('previewImage').innerHTML = '<img src=""/>';
        });
    </script>
    <script>
        $(document).ready(function() {
            //start cover photo
            let cropper;
            var finalCropWidth = 850;
            var finalCropHeight = 850;
            var finalAspectRatio = finalCropWidth / finalCropHeight;

            // Initialize the Cropper.js instance when the modal is shown
            $('#image_modal').on('shown.bs.modal', function() {
                cropper = new Cropper($('#ImageToCrop')[0], {
                    aspectRatio: finalAspectRatio,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    dragMode: 'move',
                    zoomable: true,
                });
            });

            // Destroy the Cropper.js instance when the modal is hidden
            $('#image_modal').on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            // Show the image cropping modal when an image is selected
            $('#post_image').on('change', function(event) {
                const file = event.target.files[0];
                const fileReader = new FileReader();

                fileReader.onload = function(e) {
                    $('#ImageToCrop').attr('src', e.target.result);
                    window.addEventListener('image_file', event => {
                        $('#image_modal').modal('show');
                    });
                };

                fileReader.readAsDataURL(file);
            });

            // Handle the "Crop and Upload" button click
            $('#cropImage').on('click', function(ev) {
                var imgurl = cropper.getCroppedCanvas({
                    width: 850,
                    height: 850
                }).toDataURL();
                $('#image_modal').modal('hide');
                document.getElementById('croped_image').value = imgurl;
            });
            //end event image image

            let Thumbnailcropper;
            var ThumbnailfinalCropWidth = 850;
            var ThumbnailfinalCropHeight = 850;
            var ThumbnailfinalAspectRatio = ThumbnailfinalCropWidth / ThumbnailfinalCropHeight;

            // Initialize the Cropper.js instance when the modal is shown
            $('#thumnailModal').on('shown.bs.modal', function() {
                Thumbnailcropper = new Cropper($('#ThumbnailToCrop')[0], {
                    aspectRatio: ThumbnailfinalAspectRatio,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    dragMode: 'move',
                    zoomable: true,
                });
            });

            // Destroy the Cropper.js instance when the modal is hidden
            $('#thumnailModal').on('hidden.bs.modal', function() {
                Thumbnailcropper.destroy();
                Thumbnailcropper = null;
            });

            // Show the image cropping modal when an image is selected
            $('#thumbnail_image').on('change', function(event) {
                const file = event.target.files[0];
                const fileReader = new FileReader();

                fileReader.onload = function(e) {
                    $('#ThumbnailToCrop').attr('src', e.target.result);
                    $('#thumnailModal').modal('show');
                };

                fileReader.readAsDataURL(file);
            });

            // Handle the "Crop and Upload" button click
            $('#cropThumbnail').on('click', function(ev) {
                var imgurl = Thumbnailcropper.getCroppedCanvas({
                    width: 850,
                    height: 850
                }).toDataURL();
                $('#thumnailModal').modal('hide');
                document.getElementById('croped_thumbnail').value = imgurl;
                // document.getElementById('Thumbnail').innerHTML = '<img src="'+imgurl+'"/>';
            });
            //end product image one
        });
    </script>
    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
        <style>
            .img-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: auto;
                height: 400px;
                background-color: #f7f7f7;
                overflow: hidden;
            }
        </style>
    @endpush
@endpush
