<?php

namespace App\Livewire\Client;

use Livewire\Component;
use App\Models\ProgramFee;
use App\Models\Appointment;
use Square\SquareClient;
use Square\Environment;
use Square\Exceptions\ApiException;
use Square\Models\CreatePaymentRequest;
use Square\Models\Money;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\BookingNotification;

class ConsulationBooking extends Component
{
    public $selApp;
    public $program;
    public $ap_date;
    public $ap_time;
    public $comment;
    public $total_amount;
    protected $listeners = ['processPayment'];
    #[On('processPayment')]


    public function updatedProgram(){
        $this->selApp = ProgramFee::where('program_id',$this->program)->first();
    }

    public function processPayment($token)
    {
        $client = app(SquareClient::class);

        try {
            $paymentsApi = $client->getPaymentsApi();
            $amountMoney = new Money();
            $amountMoney->setAmount(1000); // Amount in cents (e.g., $10.00)
            $amountMoney->setCurrency('USD');

            $createPaymentRequest = new CreatePaymentRequest(
                $token,
                uniqid(),
                $amountMoney
            );

            $response = $paymentsApi->createPayment($createPaymentRequest);

            if ($response->isSuccess()) {
                $this->dispatch('feedback', feedback: 'Payment successful!');
                $message = "There is a new booking kindly login and schedule appointment for the client ";
                $this->sendMail(null,$message);
                $this->completeBooking();
                return redirect()->route('client.bookings');
            } else {
                $this->dispatch('errorfeedback', errorfeedback: 'Payment failed: ' . $response->getErrors()[0]->getDetail());
            }
        } catch (\Exception $e) {
            $this->dispatch('errorfeedback', errorfeedback: 'Error processing payment: ' . $e->getMessage());
        }
    }

    public function completeBooking(){
        Appointment::create([
            'service_id' => "",
            'program_id' => $this->program,
            'appointment_date' => $this->ap_date,
            'appointment_time' => $this->ap_time,
            'user_id' => Auth::user()->id,
            'status' => "Paid"
        ]);

         $bookedProgram = ProgramFee::where('program_id',$this->program)->first();
         return redirect()->to($bookedProgram->payment_link);
        return back()->with('feedback','Appointment Successfully Booking and awaiting confirmaitn');
    }

    public function bookConsulation(){
       $this->validate([
            'program' => ['required'],
            'ap_date' => ['required'],
            'ap_time' => ['required'],
            'comment' => ['required'],
        ]);

        $appointment = null;
        $getAppoinetments = Appointment::where('appointment_date',$this->ap_date)->orderby('appointment_time','ASC')->get();
        foreach($getAppoinetments as $app){
            $getTimeDiff = $this->getTimeDiff($app->appointment_time,$this->ap_time);
            if($getTimeDiff==false){
                $appointment = $app;
            }
        }

        if(strtotime($this->ap_date)<=strtotime(date('Y-m-d'))){
            $this->dispatch('errorfeedback',errorfeedback: 'Sorry you cannot book appointment for today or prio to today');
        }elseif($appointment!=null){
            $this->dispatch('errorfeedback',errorfeedback: 'Sorry you cannot book appointment today for the selected time as there is an appointment booked for '.$appointment->appointment_time);
        }else{
            $bookedProgram = ProgramFee::where('program_id',$this->program)->first();
            $this->total_amount =$bookedProgram->program_fees + $bookedProgram->session_fees + $bookedProgram->consultation_fees;
            $this->dispatch('payment', payment: "payment");
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

    public function sendMail($user,$data){
        try{
            Mail::to("thewaywelove24@gmail.com")->send(new BookingNotification($user,$data));
        }catch (\Exception $e) { }

    }

    public function render()
    {
        return view('livewire.client.consulation-booking');
    }
}
