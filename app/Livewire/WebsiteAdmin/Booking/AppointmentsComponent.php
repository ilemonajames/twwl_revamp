<?php

namespace App\Livewire\WebsiteAdmin\Booking;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\Grow;
use Livewire\WithPagination;
use App\Mail\AppointmentConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingNotification;

class AppointmentsComponent extends Component
{
    protected $listeners = ['delete-confirmed'=>'deleteGrowth'];//listen to emited action

    public $paginate;
    public $actionId;
    protected $paginationTheme = 'bootstrap';
    public $searchTerm = null;
    public $sn;
    public $booking;
    public $selBooking;
    public $ap_date;
    public $ap_time;
    public $meeting_link;
    public $status;

    use WithPagination;


    public function mount(){
        $this->paginate = 10;
    }
       //get record of blogs
       public function getBookings(){
        $bookings = Appointment::query()
            ->where(function($query) {
            if($this->searchTerm) {
                $users = User::where('surname', 'like', '%'.$this->searchTerm.'%' )->orWhere('othernames', 'like', '%'.$this->searchTerm.'%' )->get()->pluck('id');
                $query->wherein('user_id', $users );
            }
        })

        ->latest()->paginate($this->paginate);
        return $bookings;
    }

    public function clearSearch(){
        $this->searchTerm = "";
    }

    //delete Service
    public function deleteGrowth(){
        $grow= Appointment::find($this->actionId);
        $grow->delete();
        $this->dispatch('feedback',feedback:'Appointment Successfully Deleted');
    }

    //set action id
    public function setActionId($actionId){
        $this->actionId = $actionId;
    }

    public function setBooking(Appointment $booking){
        $this->selBooking = $booking;
        $this->ap_date = $booking->appointment_date;
        $this->ap_time = $booking->appointment_time;
        $this->status = $booking->status;
    }


    public function scheduleAppointment(){
        $this->validate([
            'ap_date' => ['required'],
            'ap_time' => ['required'],
            'meeting_link' => ['required'],
        ]);

        $this->selBooking->update([
            'status' => 'scheduled',
            'appointment_date' => $this->ap_date,
            'appointment_time' => $this->ap_time,
            'consulation_link' => $this->meeting_link
        ]);

        try{
            Mail::to($this->selBooking->user->email)->send(new AppointmentConfirmationMail($this->selBooking));
        }catch(\Exception $e){}
        $this->dispatch('feedback', feedback: "Appointment Successfully Scheduled");
    }

    public function updateAppointment(){
        $this->validate([
            'status' => ['required'],
        ]);

        if($this->status=="Scheduled"){
            $this->validate([
                'ap_date' => ['required'],
                'ap_time' => ['required'],
                'meeting_link' => ['required'],
            ]);


            $this->selBooking->update([
                'status' => 'scheduled',
                'appointment_date' => $this->ap_date,
                'appointment_time' => $this->ap_time,
                'consulation_link' => $this->meeting_link
            ]);

            $meetingDate = $this->ap_date->format('d M, Y');

            $message = "
                    <div>
                        <p>Your consultation has been scheduled as follows: </p>
                        <p><strong>Date:</strong> $meetingDate</p>
                        <p><strong>Venue:</strong> $this->ap_time</p>
                        <p><strong>Meeting Link:</strong> <a href=\"$this->meeting_link\" target=\"_blank\">Join Meeting</a></p>
                    </div>
                ";
            $this->sendMail($this->selBooking->user,$message);
        }

        $this->selBooking->update([
            'status' => $this->status,
        ]);

        $this->dispatch('feedback', feedback: "Appointment Successfully Updated");
    }

    public function sendMail($user,$data){
        try{
            Mail::to($user)->send(new BookingNotification($user,$data));
        }catch (\Exception $e) { }

    }

    public function render()
    {
        $bookings = $this->getBookings();
        return view('livewire.website-admin.booking.appointments-component',compact('bookings'))->layout('livewire.website-admin.layouts.app');
    }
}
