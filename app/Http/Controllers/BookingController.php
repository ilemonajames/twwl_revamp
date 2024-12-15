<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Service;

class BookingController extends Controller
{
    // Show booking form
    public function showBookingForm()
    {
        $programs = Program::all();
        $services = Service::all();
        //dd($programs); // Get all available programs
        return view('booking.book', ['programs' => $programs], ['services' => $services]); // Return the view for the booking form'); // Return the view for the booking form
    }

    // Handle booking as a guest
    // public function bookAsGuest(Request $request)
    // {

    //     //dd($request->all());
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'date' => 'required|date',
    //         'time' => 'required',
    //         'service'=> 'required',
    //         'program' => 'required',
    //         'phone' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'message'=> 'required|string|max:255',
    //     ]);

    //     // Perform necessary actions to save the booking
        

    //     // For example, saving it to a database or sending a confirmation email
        
    //     // Redirect to success page
    //  return redirect()->route('booking.success'); 
      
    // }


public function bookAsGuest(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'date' => 'required|date',
        'time' => 'required',
        // 'service'=> 'required',
        'program' => 'required',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'message'=> 'required|string|max:255',
        'amount' => 'required|numeric', // Amount that is due
    ]);

    // Begin a transaction to ensure atomicity 
    DB::beginTransaction();
    try {
        // Save booking details - mark the status as 'on hold'
        $booking = Booking::create([
            'name' => $request->name,
            'email' => $request->email,
            'date' => $request->date,
            'time' => $request->time,
            // 'service' => $request->service,
            'program' => $request->program,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'message' => $request->message,
            'status' => 'on hold', // Mark the booking status as on hold
            'amount_due' => $request->amount, // Store the amount due in the booking record
        ]);

        // Commit the transaction
        DB::commit();

        // Redirect to a confirmation page showing amount due
        return redirect()->route('booking.onHold', ['booking' => $booking->id]);

    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        // Log the error message
        \Log::error('Booking error: ' . $e->getMessage());
        return redirect()->back()->withErrors(['booking' => 'An error occurred while processing your booking.']);
    }
}

// In your routes/web.php file, define the route for the booking.onHold view

// Define the showOnHold method in your BookingController
public function showOnHold($bookingId)
{
    $booking = Booking::findOrFail($bookingId);

    // Pass the booking details to the view
    return view('booking.on_hold', compact('booking'));
}


    // Display booking success page
    public function bookingSuccessPage()
    {
        return view('booking-success'); // Return the view for the success page
    }
}
