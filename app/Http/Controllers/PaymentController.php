<?php

namespace App\Http\Controllers;

use App\Models\PaymentAttempt;
use App\Services\SquarePaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function store(Request $request, SquarePaymentService $payments)
    {
        $data = $request->validate(['attempt_id' => 'required|uuid', 'token' => 'required|string|max:512']);
        $attempt = PaymentAttempt::with('appointment')->findOrFail($data['attempt_id']);
        abort_unless($attempt->appointment && $attempt->appointment->user_id === $request->user()->id, 403);
        $attempt = $payments->charge($attempt, $data['token']);

        return response()->json(['status' => $attempt->status]);
    }
}
