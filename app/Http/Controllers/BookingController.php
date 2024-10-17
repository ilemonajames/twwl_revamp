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
        return view('booking.booking', ['programs' => $programs], ['services' => $services]); // Return the view for the booking form'); // Return the view for the booking form
    }

    // Handle booking as a guest
    public function bookAsGuest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        // Perform necessary actions to save the booking
        

        // For example, saving it to a database or sending a confirmation email
        
        // Redirect to success page
        return redirect()->route('booking.success'); 
    }

    // Display booking success page
    public function bookingSuccessPage()
    {
        return view('booking-success'); // Return the view for the success page
    }
}
