<div class="modal fade xl" id="viewBlogModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewBlogModalLabel">Blog post Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selBlog)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('assets/images/blogs/'.$selBlog->image) }}" class="rounded" alt="" height="300">

                                </div>
                            </div>
                            @error('service_icon')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <h2 class="mt-0 font-size-16"><b>{{ $selBlog->blog_title }}</b></h2>
                            <p>{!! $selBlog->description !!}</p>
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
