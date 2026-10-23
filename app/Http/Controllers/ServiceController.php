<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\ProgramFee;
use App\Models\Service;
use App\Services\BookingService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.service', ['services' => Service::orderBy('service_title')->get()]);
    }

    public function getServices($id)
    {
        return response()->json(ProgramFee::where('program_id', $id)->firstOrFail());
    }

    public function bookingPrice($id)
    {
        return $this->getServices($id);
    }

    public function bookAppointment(Request $request, BookingService $bookings)
    {
        $data = $request->validate([
            'program' => 'required|uuid|exists:programs,id',
            'ap_date' => 'required|date_format:Y-m-d|after:today',
            'ap_time' => 'required|date_format:H:i', 'comment' => 'nullable|string|max:2000',
        ]);
        $bookings->reserve([
            'program_id' => $data['program'], 'appointment_date' => $data['ap_date'],
            'appointment_time' => $data['ap_time'], 'comment' => $data['comment'] ?? null,
        ], $request->user()->id);

        return redirect()->route('client.bookings')->with('feedback', 'Appointment requested. Payment is awaiting confirmation.');
    }

    public function details($id)
    {
        return view('services.service-detials', ['service' => Service::findOrFail($id), 'services' => Service::all()]);
    }

    public function our_services()
    {
        return view('services.our-services', ['services' => Service::all()]);
    }

    public function show(Service $service)
    {
        return view('services.show', ['service' => $service, 'faqs' => Faq::all()]);
    }

    public function create()
    {
        $this->authorize('create', Service::class);

        return redirect()->route('services.create');
    }

    public function edit(Service $service)
    {
        $this->authorize('update', $service);

        return redirect()->route('services.edit', $service);
    }

    private function fields(Request $request): array
    {
        // Retain compatibility with the legacy form while persisting canonical schema fields.
        $request->merge([
            'service_title' => $request->input('service_title', $request->input('name')),
            'service_description' => $request->input('service_description', $request->input('description')),
        ]);

        return $request->validate([
            'service_title' => 'required|string|max:255',
            'service_description' => 'required|string|max:20000',
            'price' => 'required|numeric|min:0|max:999999.99',
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Service::class);
        Service::create($this->fields($request) + ['service_image' => '']);

        return redirect()->route('services.index')->with('feedback', 'Service created.');
    }

    public function update(Request $request, Service $service)
    {
        $this->authorize('update', $service);
        $service->update($this->fields($request));

        return redirect()->route('services.index')->with('feedback', 'Service updated.');
    }

    public function destroy(Service $service)
    {
        $this->authorize('delete', $service);
        app(\App\Services\CatalogDeletionService::class)->service($service->id);

        return redirect()->route('services.index')->with('feedback', 'Service deleted.');
    }
}
