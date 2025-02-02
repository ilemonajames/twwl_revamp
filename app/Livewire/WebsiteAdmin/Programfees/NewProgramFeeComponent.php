<?php

namespace App\Livewire\WebsiteAdmin\Programfees;

use Livewire\Component;
use App\Models\ProgramFee;

class NewProgramFeeComponent extends Component
{

    public $payment_link;
    public $consultation_fees;
    public $session_fees;
    public $program_fees;
    public $duration;
    public $program;


    public function newFees(){
        $this->validate([
            'payment_link' => ['required'],
            'consultation_fees' => ['required'],
            'session_fees' => ['required'],
            'program_fees' => ['required'],
            'duration' => ['required'],
            'program' => ['required'],
        ]);

        $valFees  = ProgramFee::where('Program_id',$this->program)->first();
        if($valFees!=null){
            $this->dispatch('errorfeedback', errorfeedback: "Sorry the select service and program already have a fees setup");
        }else{
            ProgramFee::create([
                'payment_link' => $this->payment_link,
                'program_id' => $this->program,
                'session_fees' => $this->session_fees,
                'consultation_fees' => $this->consultation_fees,
                'duration' => $this->duration,
                'program_fees' => $this->program_fees,
            ]);

            $this->reset();
            $this->dispatch('feedback', feedback: "Fees setup successful");

        }


    }
    public function render()
    {
        return view('livewire.website-admin.programfees.new-program-fee-component')->layout('livewire.website-admin.layouts.app');
    }
}
