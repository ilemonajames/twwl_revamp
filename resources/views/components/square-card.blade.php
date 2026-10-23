<div>
    @once
        @push('scripts')
            <script src="{{ config('services.square.environment') === 'production' ? 'https://web.squarecdn.com/v1/square.js' : 'https://sandbox.web.squarecdn.com/v1/square.js' }}"></script>
        @endpush
    @endonce
    <div wire:ignore id="square-card-container"></div>
    <button type="button" id="square-pay-button" class="btn btn-primary mt-3" disabled>Pay securely</button>
    <p id="square-payment-status" role="status" aria-live="polite"></p>
    @script
    <script>
        const button = document.getElementById('square-pay-button');
        const status = document.getElementById('square-payment-status');
        let card;
        let pendingToken;
        async function initialize() {
            if (!window.Square) {
                await new Promise((resolve, reject) => {
                    const script = document.querySelector('script[src$="/v1/square.js"]');
                    if (!script) return reject(new Error('Payment system unavailable.'));
                    script.addEventListener('load', resolve, {once: true});
                    script.addEventListener('error', reject, {once: true});
                });
            }
            const payments = window.Square.payments(@js(config('services.square.application_id')), @js(config('services.square.location_id')));
            card = await payments.card();
            await card.attach('#square-card-container');
            button.disabled = false;
        }
        const start = () => initialize().catch(() => { status.textContent = 'Payments are currently unavailable. Please contact us.'; });
        const modal = button.closest('.modal');
        if (modal) {
            modal.addEventListener('shown.bs.modal', start, {once: true});
        } else {
            start();
        }
        button.addEventListener('click', async () => {
            button.disabled = true;
            try {
                if (!pendingToken) {
                    const result = await card.tokenize();
                    if (result.status !== 'OK') throw new Error('Please check your card details.');
                    pendingToken = result.token;
                }
                await $wire.processPayment(pendingToken);
            } catch (error) {
                status.textContent = 'Payment could not be confirmed. Check the messages above before trying again.';
            } finally {
                button.disabled = false;
            }
        });
    </script>
    @endscript
</div>
