<div>
    <x-slot name="title">New Program</x-slot>

    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Program Creation</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Program</li>
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
                        <form name="new-service" id="new-service" wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))" enctype="multipart/form-data">
                            <div>
                                <div class="mb-3 mt-3">
                                    <label class="form-label">Program Name</label>
                                    <input class="form-control" wire:model="title" type="text" placeholder="">
                                    @error('title')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">Icon of what we do</label>
                                    <input class="form-control" wire:model="service_icon" type="file" placeholder="">
                                    @error('service_icon')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-2">
                                        <img src="{{ asset('guest/images/uploads/'.$program->program_image) }}" class="rounded" alt="" height="48">
                                    </div>
                                    <div class="col-md-10">
                                        <input id="croped_image" name="croped_image" type="text" hidden>
                                        <input class="form-control" id="post_image" wire:model="photo" type="file"  placeholder="">
                                    </div>
                                </div>
                                <div class="mb-3 mt-2">
                                    <label class="form-label" for="description">Program Description</label>
                                    <div wire:ignore>
                                        <textarea id="message" wire:model="description" class="form-control tinymce-basic" name="description" rows="5"></textarea>
                                    </div>
                                    @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-2">
                                    <label class="form-label" for="program_content">Program Content</label>
                                    <div wire:ignore>
                                        <textarea id="program_content" wire:model="program_content" class="form-control tinymce-basic" name="program_content"></textarea>
                                    </div>
                                    @error('program_content')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-success waves-effect waves-light">
                                    <i wire:loading wire:target="updateService"
                                        class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Submit
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('livewire.website-admin.crop-image-modal.image_croper')

</div>
@push('scripts')
    <script src="https://cdn.tiny.cloud/1/nj0xmn8wlit9vmuxcmuqyyzmb5id877iibdnqixmgxsyino2/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#program_content',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('program_content', editor.getContent());
                });
                
            }
        });
        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script>

{{-- <script>
        tinymce.init({
            selector: '#program_content',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });

        editor.on('init change', function()){
                    @this.set('program_content', editor.getContent());
                }

            }
        });
        window.addEventListener('feedback', event => {
            tinyMCE.activeEditor.setContent("");
        });
    </script> --}}
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
            var finalCropWidth = 1250;
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
                    // window.addEventListener('image_file', event => {
                        $('#image_modal').modal('show');
                    // });
                };

                fileReader.readAsDataURL(file);
            });

            // Handle the "Crop and Upload" button click
            $('#cropImage').on('click', function(ev) {
                var imgurl = cropper.getCroppedCanvas({
                    width: 1250,
                    height: 850
                }).toDataURL();
                $('#image_modal').modal('hide');
                document.getElementById('croped_image').value = imgurl;
            });
            //end product image
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
