<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ProgramFee;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function getServices($id){
        $programFees = ProgramFee::where('program_id',$id)->get()->pluck('service_id');
        $services = Service::whereIn('id',$programFees)->get();
        return json_encode($services);
    }

    public function bookingPrice($id,$productID){
        $programFees = ProgramFee::where('program_id',$productID)->where('service_id',$id)->first();
        if($programFees!=null){
            return json_encode($programFees);
        }else{
            echo 0;
        }
    }

    function getTimeDiff($startTime, $endTime) {
        $startTime = Carbon::parse($startTime); // Example start time
        $endTime = Carbon::parse($endTime); // Example end time

        // Calculate the difference in hours
        $hoursDifference = $startTime->diffInHours($endTime);

        // Check if the difference is greater than or equal to 2 hours
        if ($hoursDifference >= 2) {
            return true;
        } else {
           return false;
        }
    }

    public function bookAppointment(Request $request){
        $data = $request->validate([
            'program' => ['required'],
            'service' => ['required'],
            'ap_date' => ['required'],
            'ap_time' => ['required'],
            'comment' => ['required'],
        ]);

        $appointment = null;
        $getAppoinetments = Appointment::where('appointment_date',$data['ap_date'])->orderby('appointment_time','ASC')->get();
        foreach($getAppoinetments as $app){
            $getTimeDiff = $this->getTimeDiff($app->appointment_time,$data['ap_time']);
            if($getTimeDiff==false){
                $appointment = $app;
            }
        }

        if(strtotime($data['ap_date'])<=strtotime(date('Y-m-d'))){
            return back()->withInput()->with('errorfeedback','Sorry you cannot book appointment for today or prio to today');
        }elseif($appointment!=null){
            return back()->withInput()->with('errorfeedback','Sorry you cannot book appointment today for the selected time as there is an appointment booked for '.$appointment->appointment_time);
        }else{
            Appointment::create([
                'service_id' => $data['service'],
                'program_id' => $data['program'],
                'appointment_date' => $data['ap_date'],
                'appointment_time' => $data['ap_time'],
                'user_id' => Auth::user()->id
            ]);

            return back()->with('feedback','Appointment Successfully Booking and awaiting confirmaitn');
        }
    }

    public function details($id){
        $service = Service::find($id);
        $services = Service::all();
        return view('services.service-detials',compact('service','services'));
    }

    public function our_services(){
        $services = Service::all();
        return view('services.our-services',compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('services', 'public') : null;

        Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }
    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        // Delete the old image if exists
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $imagePath = $request->file('image')->store('services', 'public');
        $service->image = $imagePath;
    }

    $service->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $service->image,
    ]);

    return redirect()->route('services.index')->with('success', 'Service updated successfully.');
}


    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
