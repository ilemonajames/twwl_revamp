<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Service;
use App\Services\BookingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBookingForm()
    {
        return view('booking.book', ['programs' => Program::all(), 'services' => Service::all()]);
    }

    public function bookAsGuest(Request $request, BookingService $bookings)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255', 'email' => 'required|email|max:255',
            'phone' => 'required|string|max:40', 'message' => 'nullable|string|max:2000',
            'program' => 'required|uuid|exists:programs,id',
            'service' => 'nullable|uuid|exists:services,id',
            'date' => 'required|date_format:Y-m-d|after:today', 'time' => 'required|date_format:H:i',
        ]);
        $appointment = $bookings->reserve([
            'name' => $data['name'], 'email' => $data['email'], 'phone' => $data['phone'],
            'comment' => $data['message'] ?? null,
            'program_id' => $data['program'], 'service_id' => $data['service'] ?? null,
            'appointment_date' => $data['date'], 'appointment_time' => $data['time'],
        ], $request->user()?->id);

        return redirect()->route('booking.success')->with('booking_confirmation', [
            'amount' => $appointment->amount_minor / 100,
            'date' => $data['date'], 'time' => $data['time'],
        ]);
    }

    public function bookingSuccessPage()
    {
        return view('booking.success');
    }
}
