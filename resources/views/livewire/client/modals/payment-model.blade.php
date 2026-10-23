<div class="modal fade" id="paymentModal" wire:ignore.self tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title fs-5" id="paymentModalLabel">Appointment payment</h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <p>Amount due: {{ config('services.square.currency', 'USD') }} {{ number_format($total_amount ?? 0, 2) }}</p>
            <x-square-card />
            @error('payment')<p class="text-danger" role="alert">{{ $message }}</p>@enderror
        </div>
    </div></div>
    @script
    <script>
        $wire.on('payment', () => bootstrap.Modal.getOrCreateInstance(document.getElementById('paymentModal')).show());
    </script>
    @endscript
</div>
