<div class="modal fade xl" id="viewNewsletterModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewNewsletterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewNewsletterModalLabel">Newsletter Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selNewsletter)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="row">
                                <iframe class="eBookFrame" src="{{ asset('assets/images/newsletter/'.$selNewsletter->file) }}" width="100%" height="450px" frameborder="0" seamless></iframe>
                            </div>
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
