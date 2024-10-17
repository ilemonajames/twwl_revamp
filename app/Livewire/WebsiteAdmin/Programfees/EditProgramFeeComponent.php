<?php

namespace App\Livewire\WebsiteAdmin\Programfees;

use Livewire\Component;
use App\Models\ProgramFee;

class EditProgramFeeComponent extends Component
{

    public $consultation_fees;
    public $session_fees;
    public $program_fees;
    public $duration;
    public $program;
    public $service;
    public $selFee;

    public function mount($id){
        $selFee = ProgramFee::find($id);

        $this->service = $selFee->service_id;
        $this->consultation_fees = $selFee->consultation_fees;
        $this->session_fees = $selFee->session_fees;
        $this->program_fees = $selFee->program_fees;
        $this->duration = $selFee->duration;
        $this->program = $selFee->program_id;
        $this->selFee = $selFee;
    }


    public function updateFees(){
        $this->validate([
            'service' => ['required'],
            'consultation_fees' => ['required'],
            'session_fees' => ['required'],
            'program_fees' => ['required'],
            'duration' => ['required'],
            'program' => ['required'],
        ]);

        $valFees  = ProgramFee::where('Program_id',$this->program)->where('service_id',$this->service)->first();
        if($valFees!=null  && $this->selFee->id!=$valFees->id){
            $this->dispatch('errorfeedback', errorfeedback: "Sorry the select service and program already have a fees setup");
        }else{
            $this->selFee->update([
                'service_id' => $this->service,
                'program_id' => $this->program,
                'session_fees' => $this->session_fees,
                'consultation_fees' => $this->consultation_fees,
                'duration' => $this->duration,
                'program_fees' => $this->program_fees,
            ]);

            return redirect()->route('fees.index')->with('feedback','Program fees successfully updated');
        }


    }

    public function render()
    {
        return view('livewire.website-admin.programfees.edit-program-fee-component')->layout('livewire.website-admin.layouts.app');
    }
}
