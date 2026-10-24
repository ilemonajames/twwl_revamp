<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ClientEnrolmentController extends Controller
{
    public function create(Request $request)
    {
        if (! $request->user()->enrolment_required) {
            return redirect()->route('client-dashboard');
        }
        return view('client.enrolment', [
            'services' => Service::orderBy('service_title')->get(),
            'programs' => Program::orderBy('program_title')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['selection' => ['required', 'string']]);
        [$type, $id] = array_pad(explode(':', $request->input('selection'), 2), 2, null);
        validator(['type' => $type], ['type' => ['required', Rule::in(['service', 'program'])]])->validate();
        validator(['selection' => $id], ['selection' => ['required', 'uuid', Rule::exists($type === 'service' ? 'services' : 'programs', 'id')]])->validate();

        DB::transaction(function () use ($request, $type, $id) {
            $user = User::lockForUpdate()->findOrFail($request->user()->id);
            if ($user->enrolment_required) {
                $user->forceFill([
                    'preferred_service_id' => $type === 'service' ? $id : null,
                    'preferred_program_id' => $type === 'program' ? $id : null,
                    'enrolment_required' => false,
                    'enrolment_selected_at' => now(),
                ])->save();
            }
        });
        return redirect()->route('client-dashboard')->with('feedback', 'Your selection has been saved. You can now book an appointment.');
    }
}
