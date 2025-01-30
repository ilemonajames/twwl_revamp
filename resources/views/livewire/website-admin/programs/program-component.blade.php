<div>
    <x-slot name="title">{{ $mode === 'create' ? 'New Program' : 'Edit Program' }}</x-slot>

    <div class="page-content">

        <!-- Start Page Title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">{{ $mode === 'create' ? 'Program Creation' : 'Program Modification' }}</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">{{ $mode === 'create' ? 'Add Program' : 'Edit Program' }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <form name="program-form" id="program-form" wire:submit.prevent="saveProgram" enctype="multipart/form-data">
                            <!-- Program Name -->
                            <div class="mb-3">
                                <label class="form-label">Program Name</label>
                                <input class="form-control" wire:model="title" type="text" placeholder="">
                                @error('title') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <!-- Program Image -->
                            <div class="mb-3">
                                <label class="form-label">Program Image</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        @if ($mode === 'edit' && $program->program_image)
                                            <img src="{{ asset('guest/images/uploads/' . $program->program_image) }}" class="rounded" alt="" height="48">
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <input id="croped_image" name="croped_image" type="text" hidden wire:model="croped_image">
                                        <input class="form-control" id="post_image" wire:model="photo" type="file" placeholder="">
                                        @error('photo') <p class="text-danger">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Program Description -->
                            <div class="mb-3">
                                <label class="form-label" for="description">Program Description</label>
                                <div wire:ignore>
                                    <textarea id="message" wire:model="description" class="form-control tinymce-basic" name="description"></textarea>
                                </div>
                                @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                             <!-- Program Description -->
                             <div class="mb-3">
                                <label class="form-label" for="program_content">Program Content</label>
                                <div wire:ignore>
                                    <textarea id="message" wire:model="program_content" class="form-control tinymce-basic" name="program_content"></textarea>
                                </div>
                                @error('program_content') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i wire:loading wire:target="saveProgram" class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> 
                                {{ $mode === 'create' ? 'Submit' : 'Update Program' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.website-admin.crop-image-modal.image_croper')

</div>

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/nj0xmn8wlit9vmuxcmuqyyzmb5id877iibdnqixmgxsyino2/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        $(document).ready(function() {
            let cropper;
            var finalCropWidth = 1250;
            var finalCropHeight = 850;
            var finalAspectRatio = finalCropWidth / finalCropHeight;

            // Initialize Cropper.js instance when modal is shown
            $('#image_modal').on('shown.bs.modal', function() {
                cropper = new Cropper($('#ImageToCrop')[0], {
                    aspectRatio: finalAspectRatio,
                    viewMode: 1,
                    autoCropArea: 0.8,
                    dragMode: 'move',
                    zoomable: true,
                });
            });

            // Destroy Cropper.js instance when modal is hidden
            $('#image_modal').on('hidden.bs.modal', function() {
                cropper.destroy();
                cropper = null;
            });

            // Show image cropping modal when an image is selected
            $('#post_image').on('change', function(event) {
                const file = event.target.files[0];
                const fileReader = new FileReader();

                fileReader.onload = function(e) {
                    $('#ImageToCrop').attr('src', e.target.result);
                    $('#image_modal').modal('show');
                };

                fileReader.readAsDataURL(file);
            });

            // Handle the "Crop and Upload" button click
            $('#cropImage').on('click', function(ev) {
                if (cropper) {
                    var imgurl = cropper.getCroppedCanvas({
                        width: finalCropWidth,
                        height: finalCropHeight
                    }).toDataURL();
                    $('#image_modal').modal('hide');
                    @this.set('croped_image', imgurl); // Set cropped image data to Livewire property
                }
            });
        });
    </script>
@endpush

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
