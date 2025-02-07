<x-app-layout>
    <div class="page-content">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">Book Consulation</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Booking</a></li>
                            <li class="breadcrumb-item active">Book Consulation</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            @livewire('client.consulation-booking')
        </div>
    </div>
    @push('scripts')
        <script>
            window.addEventListener('payment', event => {
                $('#paymentModal').modal('show');
            });
        </script>
    @endpush
</x-app-layout>
