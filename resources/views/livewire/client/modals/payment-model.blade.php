<div class="modal fade md" id="paymentModal" data-bs-backdrop="static" wire:ignore data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" wire:ignore>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">
                </h5>
                <button type="button" id="closeCardModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-body">
                    <div>
                        <div id="form-container"></div>
                        <button id="sq-creditcard" class="btn btn-primary">Pay</button>
                        <div id="payment-status-container"></div>

                        <script type="text/javascript">
                            const applicationId = "{{ env('SQUARE_APPLICATION_ID') }}";
                            const locationId = "{{ env('SQUARE_LOCATION_ID') }}";

                            document.addEventListener('DOMContentLoaded', function () {
                                const payments = Square.payments(applicationId, locationId);

                                async function initializeCard(payments) {
                                    const card = await payments.card();
                                    await card.attach('#form-container');
                                    return card;
                                }

                                async function tokenize(paymentMethod) {
                                    const result = await paymentMethod.tokenize();
                                    if (result.status === 'OK') {
                                        Livewire.dispatch('processPayment', { token: result.token });
                                        // Livewire.dispatch('processPayment', result.token);
                                    } else {
                                        document.getElementById('payment-status-container').innerText = result.errors[0].detail;
                                    }
                                }

                                const card = initializeCard(payments);
                                document.getElementById('sq-creditcard').addEventListener('click', async function () {
                                    await tokenize(await card);
                                });
                            });
                        </script>
                        {{-- <button type="submit" wire:click="processPayment('{{"ddd"}}')" class="btn btn-success waves-effect waves-light">
                            <i  wire:loading wire:target="processPayment"
                                class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Book
                        </button> --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer"></div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    window.addEventListener('feedback',event => {
        document.getElementById("closeCardModal").click();
     });

</script>
