<?php

namespace App\Livewire\WebsiteAdmin\Booking;

use App\Livewire\WebsiteAdmin\AdminComponent as Component;
use App\Mail\AppointmentConfirmationMail;
use App\Models\Appointment;
use App\Services\BookingService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Livewire\WithPagination;

class AppointmentsComponent extends Component
{
    use WithPagination;

    protected $listeners = ['delete-confirmed' => 'deleteGrowth'];

    protected $paginationTheme = 'bootstrap';

    public $paginate = 10;

    public $actionId;

    public $searchTerm = '';

    public $sn = 0;

    public $booking;

    public $selBooking;

    public $ap_date;

    public $ap_time;

    public $meeting_link;

    public $status;

    public function getBookings()
    {
        return Appointment::with(['user', 'program'])->when($this->searchTerm, function ($query) {
            $term = '%'.$this->searchTerm.'%';
            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)->orWhere('email', 'like', $term)
                    ->orWhereHas('user', fn ($user) => $user->where('surname', 'like', $term)->orWhere('othernames', 'like', $term));
            });
        })->latest()->paginate(min(max((int) $this->paginate, 1), 100));
    }

    public function clearSearch()
    {
        $this->searchTerm = '';
        $this->resetPage();
    }

    public function setActionId($actionId)
    {
        $this->actionId = $actionId;
    }

    private function assertPaymentResolved(Appointment $appointment): void
    {
        if (in_array($appointment->status, ['pending_payment', 'payment_processing', 'payment_review'], true)) {
            throw ValidationException::withMessages(['payment' => 'Resolve this appointment payment before changing its status.']);
        }
    }

    public function deleteGrowth()
    {
        $appointment = Appointment::findOrFail($this->actionId);
        $this->assertPaymentResolved($appointment);
        // Preserve payment references and booking history.
        $appointment->update(['status' => 'cancelled']);
        $this->dispatch('feedback', feedback: 'Appointment cancelled. Any refund must be handled separately.');
    }

    public function setBooking(Appointment $booking)
    {
        $this->selBooking = $booking;
        $this->ap_date = $booking->appointment_date->toDateString();
        $this->ap_time = substr($booking->appointment_time, 0, 5);
        $this->meeting_link = $booking->consulation_link;
        $this->status = $booking->status;
    }

    public function scheduleAppointment()
    {
        abort_unless($this->selBooking, 422);
        $this->validate(['ap_date' => 'required|date_format:Y-m-d', 'ap_time' => 'required|date_format:H:i', 'meeting_link' => 'required|url:http,https|max:2048']);
        $this->selBooking = app(BookingService::class)->reschedule($this->selBooking, [
            'appointment_date' => $this->ap_date, 'appointment_time' => $this->ap_time, 'consulation_link' => $this->meeting_link,
        ]);
        $email = $this->selBooking->user?->email ?? $this->selBooking->email;
        if ($email) {
            Mail::to($email)->queue((new AppointmentConfirmationMail($this->selBooking))->onConnection('database'));
        }
        $this->dispatch('feedback', feedback: 'Appointment scheduled. Confirmation queued.');
    }

    public function updateAppointment()
    {
        abort_unless($this->selBooking, 422);
        $this->validate(['status' => 'required|in:Scheduled,Completed,Closed']);
        if ($this->status === 'Scheduled') {
            return $this->scheduleAppointment();
        }
        $appointment = Appointment::findOrFail($this->selBooking->id);
        $this->assertPaymentResolved($appointment);
        $appointment->update(['status' => $this->status]);
        $this->dispatch('feedback', feedback: 'Appointment updated.');
    }

    public function render()
    {
        return view('livewire.website-admin.booking.appointments-component', ['bookings' => $this->getBookings()])
            ->layout('livewire.website-admin.layouts.app');
    }
}
