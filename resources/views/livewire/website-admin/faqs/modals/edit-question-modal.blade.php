<div class="modal fade xl" id="editQuestionModal" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editQuestionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuestionModalLabel">Question Modification
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" id="closEditFaqModal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selFaq)
                    <form name="new-blog" id="new-blog" wire:submit.prevent="updateFaq" enctype="multipart/form-data">
                        <div>
                            <div class="mb-3">
                                <label class="form-label">Question</label>
                                <input class="form-control" wire:model="question" type="text" placeholder="">
                                @error('question')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="answer">Answer</label>
                                <div wire:ignore>
                                    <textarea id="message" wire:model="answer" class="form-control" name="answer"></textarea>
                                </div>
                                @error('answer')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success waves-effect waves-light">
                                <i wire:loading wire:target="updateFaq"
                                    class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Update
                            </button>
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
