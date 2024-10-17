<div>
    <x-slot name="title">Frequently Asked Questions</x-slot>
    @include('livewire.website-admin.faqs.modals.edit-question-modal')
    <div class="page-content" >
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">faqs</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                            <li class="breadcrumb-item active">Faqs</li>
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
                        <x-search-bar wire:model.live="searchTerm" placeholder="Search by question" />
                        <x-spin-loader />
                        <div>
                            <table class="table table-striped mb-0">

                                <thead>
                                    <tr>
                                        <th><b>#</b></th>
                                        <th><b>Question</b></th>
                                        <th><b>Answer</b></th>
                                        <th><b>Action</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $faq)
                                        <tr>
                                            <th scope="row">{{ $sn = $sn + 1 }}</th>
                                            <td>{{ $faq->question}}</td>
                                            <td>{{ $faq->answer }}</td>
                                            <td>

                                                <div class="dropdown"> <button  class="btn btn-success" data-bs-toggle="dropdown"  aria-expanded="false"><i class="mdi mdi-dots-vertical m-0 text-white h5"></i> </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" data-bs-toggle="modal" wire:click.prevent="setFaq({{ $faq }})" data-bs-target="#editQuestionModal" href="#">Edit</a>
                                                        <a class="dropdown-item confirm-delete" wire:click="setActionId('{{ $faq->id }}')" href="#">Delete</a>
                                                    </div>
                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(count($faqs)<=0)
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
                                {{ $faqs->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.addEventListener('feedback', event => {
        document.getElementById("closEditFaqModal").click();
    });
</script>
