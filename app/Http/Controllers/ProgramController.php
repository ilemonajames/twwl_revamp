<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;

class ProgramController extends Controller
{

    public function all_programs()
    {
        $programs = Program::all();
        return view('programs.our-programs', compact('programs'));
    }

    public function details($id){
        $program = Program::find($id);
        $programs = Program::all();
        return view('programs.program-details',compact('program','programs'));
    }
}
