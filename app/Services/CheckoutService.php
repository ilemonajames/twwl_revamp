<?php

namespace App\Services;

use App\Models\Order;
use App\Models\PaymentAttempt;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    public function quote(): array
    {
        $items = [];
        $amount = 0;
        foreach (Cart::instance('cart')->content() as $row) {
            $product = Product::find($row->id);
            if (! $product || ! filter_var($row->qty, FILTER_VALIDATE_INT) || $row->qty < 1 || $row->qty > 99) {
                throw ValidationException::withMessages(['payment' => 'Your cart has an unavailable product or invalid quantity.']);
            }
            $price = MoneyAmount::minor($product->price);
            $tax = (int) round($price * (float) config('cart.tax', 0) / 100);
            $items[] = ['id' => $product->id, 'name' => $product->product_name, 'quantity' => (int) $row->qty, 'price_minor' => $price, 'tax_minor' => $tax];
            $amount += ($price + $tax) * $row->qty;
        }
        if (! $items || $amount <= 0) {
            throw ValidationException::withMessages(['payment' => 'Add a product before checking out.']);
        }

        return ['items' => $items, 'amount_minor' => $amount];
    }

    public function prepare(string $id, array $billing): PaymentAttempt
    {
        return DB::transaction(function () use ($id, $billing) {
            if ($attempt = PaymentAttempt::find($id)) {
                return $attempt;
            }
            $quote = $this->quote();
            Order::create(array_merge($billing, $quote, [
                'id' => $id, 'user_id' => auth()->id(), 'currency' => config('services.square.currency', 'USD'),
            ]));

            return PaymentAttempt::create([
                'id' => $id, 'order_id' => $id,
                'amount_minor' => $quote['amount_minor'], 'currency' => config('services.square.currency', 'USD'),
            ]);
        });
    }
}
