<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Service;

class ProgramController extends Controller
{
    public function all_programs()
    {
        $programs = Program::all();
        $services = Service::all();

        return view('programs.our-programs', compact('programs', 'services'));
    }

    public function details($id)
    {
        $program = Program::findOrFail($id);
        $programs = Program::all();
        $services = Service::all();

        return view('programs.program-details', compact('program', 'programs', 'services'));
    }

    public function destroy($id)
    {
        abort_unless(auth()->user()?->status === 'Active'
            && in_array(auth()->user()?->user_type, ['Website Admin', 'Super Admin'], true), 403);
        app(\App\Services\CatalogDeletionService::class)->program($id);

        return redirect()->route('programs.index')->with('feedback', 'Program deleted successfully.');
    }
}
