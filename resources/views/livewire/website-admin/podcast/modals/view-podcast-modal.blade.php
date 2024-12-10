<div class="modal fade xl" id="viewPodcast" data-bs-backdrop="static" wire:ignore.self data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="viewPodcastLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" wire:ignore.self>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPodcastLabel">Podcast Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    @if($selPodcast)
                    <form name="edit-service" id="edit-service"
                        wire:submit.prevent="updateService(Object.fromEntries(new FormData($event.target)))"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-5">

                                    <tbody>
                                        <style>
                                            th{
                                                width: 200px !important;
                                            }
                                        </style>
                                        <tr>
                                            <th scope="row">Host</th>
                                            <td>#{{ $selPodcast->host }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Duration</th>
                                            <td>{{ $selPodcast->duration." Minutes" }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Release Date</th>
                                            <td>{{ $selPodcast->release_date }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Audio URL</th>
                                            <td>{{ $selPodcast->audio_url }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h2 class="mt-0 font-size-16"><b>{{ $selPodcast->title }}</b></h2>
                            <p>{!! $selPodcast->description !!}</p>


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
