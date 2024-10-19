<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Service;

class ProgramController extends Controller
{

    public function all_programs()
    {
        $programs = Program::all();
        $services = Service::all();
        return view('programs.our-programs', compact('programs','services'));
    }

    public function details($id){
        $program = Program::find($id);
        $programs = Program::all();
        $services = Service::all();

        return view('programs.program-details',compact('program','programs', 'services'));
    }
}
