<?php

namespace App\Http\Controllers;

use App\Services\SquarePaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SquareWebhookController extends Controller
{
    public function __invoke(Request $request, SquarePaymentService $payments)
    {
        $key = config('services.square.webhook_signature_key');
        $url = config('services.square.webhook_notification_url');
        abort_unless($key && $url, 503);
        $expected = base64_encode(hash_hmac('sha256', $url.$request->getContent(), $key, true));
        abort_unless(hash_equals($expected, (string) $request->header('x-square-hmacsha256-signature')), 403);
        $data = $request->validate(['event_id' => 'required|string|max:255', 'type' => 'required|string']);
        DB::transaction(function () use ($request, $data, $payments) {
            if (! DB::table('payment_webhook_events')->insertOrIgnore(['id' => $data['event_id'], 'created_at' => now()])) {
                return;
            }
            if (in_array($data['type'], ['payment.created', 'payment.updated'], true)) {
                $payment = $request->input('data.object.payment');
                abort_unless(is_array($payment), 422);
                $payments->reconcile($payment);
            }
        });

        return response()->noContent();
    }
}
