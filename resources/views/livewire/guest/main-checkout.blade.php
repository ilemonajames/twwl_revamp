<main id="content" class="container mt80 py-5">
    <h1>Checkout</h1>
    <div class="row">
        <div class="col-lg-6">
            <h2>Billing details</h2>
            <label for="billing-name">Name</label>
            <input id="billing-name" wire:model="name" class="form-control" autocomplete="name">
            @error('name')<p class="text-danger">{{ $message }}</p>@enderror
            <label for="billing-email">Email</label>
            <input id="billing-email" type="email" wire:model="email" class="form-control" autocomplete="email">
            @error('email')<p class="text-danger">{{ $message }}</p>@enderror
            <label for="billing-address">Address</label>
            <textarea id="billing-address" wire:model="address" class="form-control" autocomplete="street-address"></textarea>
            @error('address')<p class="text-danger">{{ $message }}</p>@enderror
            @if($attempt && in_array($attempt->status, ['processing', 'review', 'completed', 'failed']))
                <p role="status">Payment status: {{ $attempt->status }}. Reference: {{ $attempt->id }}.</p>
                <p>Contact us with this reference if you need help. Please check the status before starting another payment.</p>
                <button type="button" wire:click="$refresh" class="btn btn-secondary">Check payment status</button>
                @if($attempt->status === 'completed')
                    <button type="button" wire:click="finishOrder" class="btn btn-primary">Finish order</button>
                @endif
            @else
                <x-square-card />
            @endif
            @error('payment')<p role="alert" class="text-danger">{{ $message }}</p>@enderror
        </div>
        <div class="col-lg-6">
            <h2>Your order</h2>
            @php($items = $attempt?->order?->items ?? ($quote['items'] ?? []))
            <ul>
                @foreach($items as $item)
                    <li>{{ $item['name'] }} &times; {{ $item['quantity'] }} — {{ number_format(($item['price_minor'] + $item['tax_minor']) * $item['quantity'] / 100, 2) }}</li>
                @endforeach
            </ul>
            <p>Total (including tax): {{ config('services.square.currency', 'USD') }} {{ number_format(($attempt?->amount_minor ?? ($quote['amount_minor'] ?? 0)) / 100, 2) }}</p>
        </div>
    </div>
</main>
