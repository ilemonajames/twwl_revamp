<div>
    <x-slot name="title">New Blog</x-slot>

    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">New frequently asked question</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Faq</li>
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
                        <form name="new-blog" id="new-blog" wire:submit.prevent="newFaq" enctype="multipart/form-data">
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
                                    <i wire:loading wire:target="newFaq"
                                        class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Submit
                                </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</div>
