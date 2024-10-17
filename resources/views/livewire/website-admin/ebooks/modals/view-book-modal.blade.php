<div class="modal fade xl" id="viewBookModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewBookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBookModalLabel">Book Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selBook)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <img src="{{ asset('assets/images/ebooks/'.$selBook->cover) }}" class="rounded" alt="" height="300">

                                </div>
                                <div class="col-md-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">

                                            <tbody>
                                                <style>
                                                    th{
                                                        width: 100px !important;
                                                    }
                                                </style>
                                                <tr>
                                                    <th scope="row">Category</th>
                                                    <td>#{{ $selBook->category }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Author</th>
                                                    <td>{{ $selBook->author }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @error('service_icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h2 class="mt-0 font-size-16"><b>{{ $selBook->title }}</b></h2>
                            <p>{!! $selBook->description !!}</p>
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
