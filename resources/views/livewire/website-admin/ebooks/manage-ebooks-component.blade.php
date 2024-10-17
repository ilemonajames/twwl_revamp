<div>
    <x-slot name="title">Book Records</x-slot>
    @include('livewire.website-admin.ebooks.modals.view-book-modal')
    <div class="page-content" >

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Book Collections</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">books</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12" >
                <div class="card">
                    <div class="card-body">
                        <x-search-bar wire:model.live="searchTerm" placeholder="Search by title or description" />
                        <x-spin-loader />
                        <div>
                            <table class="table table-striped mb-0">

                                <thead>
                                    <tr>
                                        <th class="desktopView"><b>#</b></th>
                                        <th ><b>Image</b></th>
                                        <th><b>Title</b></th>
                                        <th ><b>Category</b></th>
                                        <th  class="desktopView"><b>Author</b></th>
                                        <th><b></b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <style>
                                    td{
                                        vertical-align: middle;
                                    }
                                    </style>
                                    @foreach ($books as $book)
                                        <tr>
                                            <td class="desktopView">{{ $sn = $sn + 1 }}</td>
                                            <td >
                                                <img src="{{ asset('assets/images/ebooks/'.$book->cover) }}" class="rounded" alt="" height="48">

                                            </td>
                                            <td>{{ $book->title}}</td>
                                            <td>{{ $book->category}}</td>
                                            <td  class="desktopView">{!! Str::limit(strip_tags($book->author),120) !!}</td>
                                            <td>
                                                <div class="dropdown"> <button  class="btn btn-success" data-bs-toggle="dropdown"  aria-expanded="false"><i class="mdi mdi-dots-vertical m-0 text-white h5"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#viewBookModal" wire:click="setBook({{ $book }})" href="#">View</a>
                                                        {{-- <a class="dropdown-item" href="{{ route('grow.edit',$book->id)}}">Edit</a> --}}
                                                        <a class="dropdown-item confirm-delete" wire:click="setActionId('{{ $book->id }}')" href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($books)<=0)
                                    <tr>
                                        <td colspan="6" class="text-center">
                                            <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg?size=626&ext=jpg&uid=R51823309&ga=GA1.2.224938283.1666624918&semt=sph"
                                            alt="No results found" style="width: 150px; height: 100px;">
                                            <p class="mt-2 text-danger">No record found!</p>
                                        </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <ul class="pagination pagination-rounded justify-content-center mb-0">
                                {{ $books->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.website-admin.crop-image-modal.image_croper')
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
